<?php

namespace Iliuminates\Database\Queries;

trait DBCondations
{

    protected static $condations = [];
    protected static $columns = ['*'];
    protected static ?int $limit = null;
    protected static ?int $offset = null;

    /**
     * set query selector using where
     * @param string $column
     * @param string $operator
     * @param mixed $value
     *
     * @return static
     */
    public static function where(string $column, string $operator, $value = null): static
    {
        $my_operators = in_array($operator, ['=', 'LIKE']);
        static::$condations[] = [
            'column' => $column,
            'operator' =>  $my_operators ? $operator : '=',
            'value' => ! $my_operators ? $operator : $value
        ];
        return new static;
    }

    /**
     * @param int $limit
     *
     * @return static
     */
    public static function limit(int $limit): static
    {
        static::$limit = $limit;
        return new static;
    }


    /**
     * @param int $take
     *
     * @return static
     */
    public static function take(int $take): static
    {
        static::$limit = $take;
        return new static;
    }

    /**
     * @param int $offset
     *
     * @return static
     */
    public static function offset(int $offset): static
    {
        static::$offset = $offset;
        return new static;
    }

    /**
     * to build my query in PDO
     * @return string
     */
    public static function buildSelectQuery(array $columns = [], ?int $limit = null, ?int $offset = null): string
    {
        $table = static::getTable();
        $columns = !empty($columns) && count($columns) > 0 ? implode(',', $columns) : implode(',', static::$columns);
        $query = 'SELECT ' . $columns . ' FROM ' . $table;
        if (static::$condations) {
            $condations = array_map(fn($condation) => "{$condation['column']} {$condation['operator']} ?", static::$condations);
            $query .= ' WHERE ' . implode(' AND ', $condations);
        }

        static::$limit = !empty($limit) && $limit > 0 ? $limit : static::$limit;
        static::$offset = !empty($offset) && $offset > 0 ? $offset : static::$offset;
        
        if (!is_null(static::$limit)) {
            $query .= ' LIMIT ' . static::$limit;
        }

        if (!is_null(static::$offset)) {
            $query .= ' OFFSET ' . static::$offset;
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
