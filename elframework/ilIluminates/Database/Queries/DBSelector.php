<?php

namespace Iliuminates\Database\Queries;

use Iliuminates\Database\Queries\Collection;

trait DBSelector
{

    public static function find(int $id): ?static
    {
        return static::where('id', $id)->first();
    }


    public static function first(): ?static
    {
        $query = static::buildSelectQuery();
        $prepare = parent::$db->prepare($query);
        $prepare->execute(static::getCondationValues());
        $data = $prepare->fetch(static::getDBconf()->FETCH_MODE);
        if ($data) {
            static::setAttributes($data);
            return new static;
        }
        return null;
    }

    public static function get(null|array $columns = []): ?Collection
    {
        $query = static::buildSelectQuery();
        $prepare = parent::$db->prepare($query);
        $prepare->execute(static::getCondationValues());
        $data = $prepare->fetchAll(static::getDBconf()->FETCH_MODE);
        if ($data) {
            return new Collection($data);
        }

        return null;
    }

    public static function all(): null|array
    {
        return static::get();
    }
}
