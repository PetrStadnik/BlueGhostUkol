<?php


class DB // třída obsahující metody pro práci s databází
{
    private static $connection;

    private static $settings = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_EMULATE_PREPARES => false,
    );

    public static function connect($host, $user, $password, $database) // připojení k databázi
    {
        if (!isset(self::$connection))
        {
            self::$connection = @new PDO(
                "mysql:host=$host;dbname=$database",
                $user,
                $password,
                self::$settings
            );
        }
    }

    public static function getAll()
    {
        $data = self::$connection->prepare('
            SELECT name, tel, mail, note, id
            FROM contacts
            ORDER BY id DESC
        ');
        $data->execute();
        return $data->fetchAll();
    }

    public static function insert($data = array()) { // vložení nového kontaktu
        $sql = "INSERT INTO contacts (name, tel, mail, note) VALUES (?,?,?,?)";
        self::$connection->prepare($sql)->execute($data);
    }

    public static function edit($data = array()) { // upravení již existujícího kontaktu
        $sql = "UPDATE contacts SET name=?, tel=?, mail=?, note=? WHERE id=?";
        self::$connection->prepare($sql)->execute($data);
    }

    public static function delete($id) { // vymazání kontaktu z databáze
        $sql = "DELETE FROM contacts WHERE id = :id";
        self::$connection->prepare($sql)->execute([':id' => $id]);
    }
}