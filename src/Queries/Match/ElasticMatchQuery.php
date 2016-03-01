<?php

namespace Neokike\LaravelElasticsearch\Queries\Match;

use Neokike\LaravelElasticsearch\Exceptions\InvalidArgumentException;
use Neokike\LaravelElasticsearch\Interfaces\QueryInterface;

class ElasticMatchQuery implements QueryInterface
{

    protected $field;
    protected $value;
    /**
     * @var string
     */
    protected $operator;
    /**
     * @var string
     */
    protected $zero_terms_query;
    /**
     * @var null
     */
    protected $cutoff_frequency;
    /**
     * @var null
     */
    protected $fuzziness;
    /**
     * @var array
     */
    protected $params;

    function __construct($field, $value, $params = [])
    {

        $this->field = $field;
        $this->value = $value;
        $this->params = $params;
    }

    public function toArray()
    {
        $query = [
            'match' =>
                [
                    $this->field => [
                        'query' => $this->value,
                    ]
                ]
        ];
        if (count($this->params)) {
            foreach ($this->params as $param => $value) {
                $query['match'][$this->field][$param] = $value;
            }
        }

        return $query;
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
