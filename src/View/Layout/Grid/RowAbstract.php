<?php

namespace Yumi\Bundler\View\Layout\Grid;

use Yumi\Bundler\View\Layout\Grid\Enum\ColumnType;
use Yumi\Bundler\View\ViewElement;

/**
 * Class RowAbstract
 * @package Yumi\Bundler\View\Layout\Grid
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
abstract class RowAbstract extends ViewElement
{
    /**
     * @var ColumnAbstract[]
     */
    protected $columns = array();

    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'row_element';
    }

    /**
     * Adds column to row
     * @param ColumnAbstract $column
     * @return RowAbstract
     */
    public function addColumn(ColumnAbstract $column) : self
    {
        $this->columns[] = $column;

        return $this;
    }

    /**
     * Adds columns to row
     * @param ColumnAbstract[] $columns
     * @return RowAbstract
     */
    public function addColumns(array $columns) : self
    {
        foreach($columns as $column){
            $this->columns[] = $column;
        }

        return $this;
    }

    /**
     * Gets columns at row
     * @return ColumnAbstract[]
     */
    public function getColumns() : array
    {
        return $this->columns;
    }

    public function & render() : array
    {
        $result = parent::render();

        $result['columns'] = array();

        $this->calculateColumnSizes();

        return $result;
    }

    protected function calculateColumnSizes() : void
    {
        $availableColumnTypes = ColumnType::getAllTypes();

        $columnCount = \count($this->columns);

        $sumRowSizes = array();
        $sumColWithSizes = array();

        foreach($availableColumnTypes as $type){
            $sumRowSizes[$type] = 0;
            $sumColWithSizes[$type] = 0;
        }



        foreach($this->columns as $column){
            $sizes = $column->getSizes();

            foreach($sizes as $type => $s){

                if (!empty($s)){
                    $sumColWithSizes[$type]++;
                }

                $sumRowSizes[$type] += (int) $s;
            }
        }

        foreach($this->columns as $column){

            $sizes = $column->getSizes();

            foreach($availableColumnTypes as $type){

                $leftSize = 12 - $sumRowSizes[$type];

                $targetSize = floor($leftSize / ($columnCount - $sumColWithSizes[$type]));

                $sizes[$type] = $targetSize;
            }

            $column->setSizes($sizes);
        }
    }

    /**
     * Decreases the size of the widest column
     * @param string $columnType
     * @param int $takeSizeAmount
     * @throws Exception\ColumnException
     */
    protected function decreaseSizeOfTheWidestColumn(string $columnType, int $takeSizeAmount) : void
    {
        $widestSize = 0;
        $widestColumn = null;

        foreach($this->columns as $column){
            $sizes = $column->getSizes();

            $size = (int) $sizes[$columnType];

            if ($size > $widestSize){
                $widestSize = $size;
                $widestColumn = $column;
            }
        }

        if (!empty($widestColumn)){
            $t = $widestSize - $takeSizeAmount;
            $widestColumn->setSize($columnType, $t >= 1 ? $t : $widestSize );
        }
    }
}