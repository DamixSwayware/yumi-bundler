<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\Constraint\Input\Model;

class InputModel
{
    private $viewElementsParameters = array();

    public function __construct()
    {

    }

    /**
     * Adds a new filter
     * @param string $viewElementIdentifier
     * @param string $fieldName
     * @param array $values
     * @return InputModel
     */
    public function addFilter(string $viewElementIdentifier, string $fieldName, array $values = array()) : self
    {
        if (!isset($this->viewElementsParameters[$viewElementIdentifier])){
            $this->viewElementsParameters[$viewElementIdentifier] = [
                'filters' => array(),
            ];
        }

        $this->viewElementsParameters[$viewElementIdentifier]['filters'][$fieldName] = $values;
        return $this;
    }

    /**
     * Adds a new pagination criteria
     * @param string $viewElementIdentifier
     * @param int $limit
     * @param int $offset
     * @return InputModel
     * @throws \Yumi\Bundler\Constraint\Exception\PaginationException
     */
    public function addPagination(string $viewElementIdentifier, int $limit, int $offset) : self
    {
        if ($limit < 0){
            throw new \Yumi\Bundler\Constraint\Exception\PaginationException("Limit can not be less than zero");
        }

        if ($offset < 0){
            throw new \Yumi\Bundler\Constraint\Exception\PaginationException("Offset can not be less than zero");
        }

        if (!isset($this->viewElementsParameters[$viewElementIdentifier])){
            $this->viewElementsParameters[$viewElementIdentifier] = [
                'pagination' => array(),
            ];
        }

        $this->viewElementsParameters[$viewElementIdentifier]['pagination'] = [
            'limit' => $limit,
            'offset' => $offset,
        ];

        return $this;
    }

    /**
     * Adds a new sorting pagination
     * @param string $viewElementIdentifier
     * @param string $orderByField
     * @param $parameters
     * @return InputModel
     */
    public function addSorting(string $viewElementIdentifier, string $orderByField, $parameters) : self
    {
        if (!isset($this->viewElementsParameters[$viewElementIdentifier])){
            $this->viewElementsParameters[$viewElementIdentifier] = [
                'sorting' => array(),
            ];
        }

        $this->viewElementsParameters[$viewElementIdentifier]['sorting'][$orderByField] = $parameters;

        return $this;
    }

    /**
     * Gets filters criteria
     * @param string $viewElementIdentifier
     * @return array
     */
    public function getFilters(string $viewElementIdentifier) :? array
    {
        if (isset($this->viewElementsParameters[$viewElementIdentifier])){
            return $this->viewElementsParameters[$viewElementIdentifier]['filters'];
        }

        return null;
    }

    /**
     * Gets pagination criteria
     * @param string $viewElementIdentifier
     * @return array
     */
    public function getPagination(string $viewElementIdentifier) :? array
    {
        if (isset($this->viewElementsParameters[$viewElementIdentifier])){
            return $this->viewElementsParameters[$viewElementIdentifier]['pagination'];
        }

        return null;
    }

    /**
     * Gets sorting criteria
     * @param string $viewElementIdentifier
     * @return array
     */
    public function getSorting(string $viewElementIdentifier) :? array
    {
        if (isset($this->viewElementsParameters[$viewElementIdentifier])){
            return $this->viewElementsParameters[$viewElementIdentifier]['sorting'];
        }

        return null;
    }

}