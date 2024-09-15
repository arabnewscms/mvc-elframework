<?php

namespace Iliuminates\Database\Queries;

trait DBCondations
{

    protected static $condations = [];
    protected static $columns = ['*'];

    /**
     * set query selector using where
     * @param string $column
     * @param string $operator
     * @param mixed $value
     * 
     * @return self
     */
    public static function where(string $column, string $operator, $value): self
    {
        self::$condations[] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value
        ];
        return new self;
    }

    /**
     * to build my query in PDO
     * @return string
     */
    public static function buildSelectQuery(): string
    {
        $class = new self;
        $columns = implode(',', static::$columns);
        $query = 'SELECT ' . $columns . ' FROM ' . $class->table;
        if (static::$condations) {
            $condations = array_map(fn($condation) => "{$condation['column']} {$condation['operator']} ?", static::$condations);
            $query .= 'WHERE ' . implode(' AND ', $condations);
        }
        return $query;
    }

    /**
     * to prepare my values to bind in PDO
     * @return array
     */
    public static function getCondationValues(): array
    {
        return  array_map(fn($condation) => $condation['value'], static::$condations);
    }
}
