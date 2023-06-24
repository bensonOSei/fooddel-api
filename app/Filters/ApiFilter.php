<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter
{
    /**
     * Fields that can be filtered.
     * 
     * @var array
     */
    protected $allowedParams = [];

    /**
     * Map the query parameters to the database columns.
     * 
     * @var array $queryItems 
     */
    protected $columnMap = [];


    protected $operatorMap = [];

    /**
     * Transform the query parameters to the database columns.
     * 
     * @param Request $request
     * @return array
     */
    public function transform(Request $request)
    {
        $queryItems = [];

        // Loop through each allowed parameter
        foreach ($this->allowedParams as $param => $operators) {
            // Get the query for that parameter
            $query = $request->get($param);

            // If there's no query, skip
            if (!isset($query)) continue;

            // Get the column name for that parameter
            $column = $this->columnMap[$param] ?? $param;

            // For each operator, see if it's present in the query
            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    // If so, add it to the queryItems array
                    $queryItems[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }
        return $queryItems;
    }
}
