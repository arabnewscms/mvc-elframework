<?php

namespace Iliuminates\Database;

use Iliuminates\Database\Drivers\MySQLConnection;
use Iliuminates\Database\Drivers\SQLiteConnection;
use Iliuminates\Logs\Log;
use Iliuminates\Database\Queries\DBCondations;
use Iliuminates\Database\Queries\DBSelector;

class Model extends BaseModel
{
    use DBCondations, DBSelector;
    public function __construct()
    {
        $config = config('database.driver');
        if ($config == 'mysql') {
            parent::__construct(new MySQLConnection());
        } elseif ($config == 'sqlite') {
            parent::__construct(new SQLiteConnection());
        } else {
            throw new Log('Database driver not supported');
        }
    }

    public static function getTable()
    {
        $class = new static;
        if ($class->table == null) {
            $class->table = strtolower((new \ReflectionClass(static::class))->getShortName()) . 's';
        }
        return $class->table;
    }

    public function toArray()
    {
        return (array) static::$attributes;
    }
}
