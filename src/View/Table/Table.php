<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Table;

use Yumi\Bundler\View\Table\Exception\TableException;
use Yumi\Bundler\View\ViewElement;

class Table extends ViewElement
{
    /**
     * @var \Yumi\Bundler\View\Table\Column[]
     */
    private $columnContainer = array();

    /**
     * Total amount of rows (sum of the rows on all pages)
     * @var int
     */
    private $totalAmountOfRows = 0;

    /**
     * Source data
     * @var array
     */
    private $sourceData = array();

    /**
     * @var Row[]
     */
    private $rows = array();

    public function __construct()
    {
        $this->elementType = 'table_element';
    }

    /**
     * Declares a new column
     * @param string $columnName
     * @param string $columnTitle
     * @param null|string $sourceColumnName
     * @return Column
     * @throws TableException
     */
    public function declareColumn(string $columnName, string $columnTitle, ?string $sourceColumnName) : Column
    {
        $columnName = trim($columnName);

        if (empty($columnName)){
            throw new TableException("Column name can not be empty");
        }

        $columnTitle = trim($columnTitle);

        if (empty($columnTitle)){
            throw new TableException("Column title can not be empty");
        }

        $sourceColumnName = !empty($sourceColumnName) ? trim($sourceColumnName) : null;

        $column = new Column();
        $column->setName($columnName);
        $column->setTitle($columnTitle);
        $column->setSourceName($sourceColumnName);

        $this->addColumn($column);

        return $column;
    }

    /**
     * Adds a new column
     * @param Column $column
     * @throws TableException
     * @return Table
     */
    public function addColumn(Column $column) : self
    {
        $columnName = $column->getName();
        $columnTitle  = $column->getTitle();

        if (empty($columnName)){
            throw new TableException("Name of the column was not declared");
        }

        if (empty($columnTitle)){
            throw new TableException("Title of the column '$columnName' was not defined");
        }

        unset($columnTitle);

        $columnName = trim($columnName);

        if (isset($this->columnContainer[$columnName])){
            throw new TableException("Column '$columnName' is already declared");
        }

        $this->columnContainer[$columnName] = $column;
        return $this;
    }

    /**
     * Adds column modifier
     * @param string $columnName
     * @param callable $modifier
     * @throws TableException
     * @return Table
     */
    public function addColumnModifier(string $columnName, callable $modifier) : self
    {
        $columnName = trim($columnName);

        if (!isset($this->columnContainer[$columnName])){
            throw new TableException("Column '$columnName' was not found");
        }

        $this->columnContainer[$columnName]->addModifier($modifier);

        return $this;
    }

    /**
     * Sets total amount of rows (sum of the rows on all pages)
     * @param int $totalAmountOfRows
     * @return Table
     */
    public function setTotalAmountOfRows(int $totalAmountOfRows) : self
    {
        $this->totalAmountOfRows = $totalAmountOfRows;
        return $this;
    }

    /**
     * Gets total amount of rows (sum of the rows on all pages)
     * @return int
     */
    public function getTotalAmountOfRows() : int
    {
        return $this->totalAmountOfRows;
    }

    /**
     * Adds a new row
     * @param Row $row
     * @return Table
     */
    public function addRow(Row $row) : self
    {
        $this->rows[] = $row;
        return $this;
    }

    /**
     * Sets source data
     * @param array $sourceData
     * @return Table
     */
    public function setSourceData(array &$sourceData) : self
    {
        $this->sourceData = $sourceData;

        for($rowIndex = 0; $rowIndex < sizeof($this->sourceData); $rowIndex++){
            $row = new Row($rowIndex + 1, $this->columnContainer,
                $this->sourceData[$rowIndex], $this->sourceData);
            $this->addRow($row);
        }

        return $this;
    }

    /**
     * Gets source data
     * @return array
     */
    public function & getSourceData() : array
    {
        return $this->sourceData;
    }

    /**
     * Renders table
     * @return array
     */
    public function & render() : array
    {
        $renderResult = parent::render();

        $renderResult['columns'] = $this->renderColumns();
        $renderResult['rows'] = $this->renderRows();

        return $renderResult;
    }

    /**
     * Renders columns
     * @return array
     */
    private function & renderColumns() : array
    {
        $renderedColumns = array();

        foreach($this->columnContainer as $columnName => $column){
            $renderedColumns[] = $column->render();
        }

        return $renderedColumns;
    }

    /**
     * Renders rows
     * @return array
     */
    private function & renderRows() : array
    {
        $renderedRows = array();

        foreach($this->rows as &$row){
            $renderedRows[] = $row->render();
        }

        return $renderedRows;
    }
}