<?php

namespace Iliuminates\Database;

use Iliuminates\Database\Contracts\DatabaseConnectionInterface;

use PDO;

abstract class BaseModel
{

    protected static PDO $db;
    protected $table;
    protected $attributes = [];
    
    public function __construct(DatabaseConnectionInterface $connect)
    {
        self::$db = $connect->getPDO();

        if ($this->table == null) {
            $this->table = strtolower((new \ReflectionClass(static::class))->getShortName()) . 's';
        }
    }

    /**
     * get database driver settings
     * @return object 
     */
    public static function getDBConf():object{
        $driver = config('database.driver');
        return (object) config('database.drivers')[$driver];
    }

    public static function setAttributes($attributes){
        self::$attributes = $attributes;
    }

    // public static function getTable(){
    //     $class = new self;
    //     return $class->table;
    // }

    /**
     * to get a current property from table in database
     * @param mixed $name
     *
     * @return mixed
     */
    public function __get($name): mixed
    {
        return $this->attributes[$name] ?? null;
    }

    /**
     * to set a new dynamic property
     * @param string $name
     * @param mixed $value
     *
     * @return void
     */
    public function __set(string $name, $value): void
    {
        $this->attributes[$name] = $value;
    }
}
