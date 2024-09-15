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
     * @return static
     */
    public static function where(string $column, string $operator, $value=null): static
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
     * to build my query in PDO
     * @return string
     */
    public static function buildSelectQuery(): string
    {
        $table = static::getTable();
        $columns = implode(',', static::$columns);
        $query = 'SELECT ' . $columns . ' FROM ' . $table;
        if (static::$condations) {
            $condations = array_map(fn($condation) => "{$condation['column']} {$condation['operator']} ?", static::$condations);
            $query .= ' WHERE ' . implode(' AND ', $condations);
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
