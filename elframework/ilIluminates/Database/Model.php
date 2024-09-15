<?php
namespace Iliuminates\Database;

use Iliuminates\Database\Drivers\MySQLConnection;
use Iliuminates\Database\Drivers\SQLiteConnection;
use Iliuminates\Logs\Log;
use Iliuminates\Database\Queries\DBCondations;
use Iliuminates\Database\Queries\Selector;

class Model extends BaseModel
{
    use DBCondations,Selector;
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

}
