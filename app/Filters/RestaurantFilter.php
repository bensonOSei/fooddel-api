<?php

namespace App\Filters;

class RestaurantFilter extends ApiFilter
{
    /**
     * Fields that can be filtered.
     * 
     * @var array
     */
    protected $allowedParams = [
        'name' => ['eq', 'neq'],
        'city' => ['eq', 'neq'],
        'region' => ['eq', 'neq'],
    ];

    /**
     * Map the query parameters to the database columns.
     * 
     * @var array $queryItems 
     */
    protected $columnMap = [
        'name' => 'name',
        'city' => 'city',
        'contact' => 'contact',
    ];

    protected $operatorMap = [
        'eq' => '=',
        'neq' => '!=',
    ];

}