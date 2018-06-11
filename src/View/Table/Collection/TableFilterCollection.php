<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Table\Collection;

use Yumi\Bundler\Table\Exception\TableFilterCollectionException;
use Yumi\Bundler\View\Filter\FilterControl;

class TableFilterCollection
{
    /**
     * @var array
     *
     * column_name => array( filter1, filter2, ... )
     */
    private $filters = array();

    public function __construct()
    {
    }

    /**
     * Assigns filter to column
     * @param string $columnName
     * @param FilterControl $filterControl
     * @return TableFilterCollection
     * @throws TableFilterCollectionException
     */
    public function addColumnFilter(string $columnName, FilterControl $filterControl) : self
    {
        $columnName = \trim($columnName);

        if (\strlen($columnName) <= 0){
            throw new TableFilterCollectionException('The column name is empty');
        }

        $columnName = \mb_strtolower($columnName);

        if (!\array_key_exists($columnName, $this->filters)){
            $this->filters[$columnName] = array();
        }

        $this->filters[$columnName][] = $filterControl;

        return $this;
    }

    /**
     * Gets filters assigned to column
     * @param string $columnName
     * @return TableFilterCollection
     * @throws TableFilterCollectionException
     */
    public function getColumnFilters(string $columnName) : array
    {
        $columnName = \trim($columnName);

        if (\strlen($columnName) <= 0){
            throw new TableFilterCollectionException('The column name is empty');
        }

        $columnName = \mb_strtolower($columnName);

        return $this->filters[$columnName] ?? array();
    }

}