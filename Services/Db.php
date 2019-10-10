<?php

namespace Services;

class Db
{
    private $pdo;
    private static $db;
    public static function getDbInstance() {
        if (self::$db ===  null ) {
            self::$db = new Db();
        }
        return self::$db;
    }

    private function __construct()
    {
        $dbOptions = (require __DIR__ . '/../settings.php')['db'];
             $this->pdo = new \PDO(
                'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
                $dbOptions['user'],
                $dbOptions['password']
            );
            $this->pdo->exec('SET NAMES UTF8');
    }

    public function query(string $sql, array $params = [], string $className = 'stdClass') {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    public function queryOld(string $sql, $params = []): array
    {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);

        if (false === $result) {
            return null;
        }

        return $sth->fetchAll();
    }

    public function getLastInsertId($name = ''): int
    {
        return (int) $this->pdo->lastInsertId($name);
    }
}