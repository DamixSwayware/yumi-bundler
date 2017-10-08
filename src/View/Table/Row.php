<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Table;

use Yumi\Bundler\View\Table\Exception\RowException;
use Yumi\Bundler\View\ViewElement;

class Row extends ViewElement
{
    private $rowNumber = 0;

    private $columnContainer = array();

    private $sourceRowData = array();

    private $sourceData = array();

    /**
     * @var Cell[]
     */
    private $cells = array();

    public function __construct(?int $rowNumber = null, array &$columnContainer = array(),
        array &$sourceRowData = array(), array &$sourceData = array())
    {
        parent::__construct();

        $this->setRowNumber($rowNumber);
        $this->setColumnContainer($columnContainer);
        $this->setSourceRow($sourceRowData);
        $this->setSourceData($sourceData);
        $this->createCells();
    }

    /**
     * Sets number of row
     * @param int|null $rowNumber
     * @return void
     */
    private function setRowNumber(?int $rowNumber = null) : void
    {
        $this->rowNumber = empty($rowNumber) ? null : abs($rowNumber);
    }

    /**
     * Sets column container
     * @param array $columnContainer
     * @return void
     */
    private function setColumnContainer(array &$columnContainer) : self
    {
        $this->columnContainer = $columnContainer;
        return $this;
    }

    /**
     * Ustawia pojedyczny wiersz zrodlowy
     * @param array $sourceRowData
     * @return Row
     */
    private function setSourceRow(array &$sourceRowData) : self
    {
        $this->sourceRowData = $this->validateSourceRowData($sourceRowData);
        return $this;
    }

    /**
     * Sets source data
     * @param array $sourceData
     * @return Row
     */
    private function setSourceData(array &$sourceData) : self
    {
        $this->sourceData = $sourceData;
        return $this;
    }

    /**
     * @return Cell[]
     */
    public function & getCells() : array
    {
        return $this->cells;
    }

    /**
     * Sprawdza czy wszystkie wymagane kolumny w wierszu zrodlowym istnieja
     * @param array $sourceRowData
     * @return array
     * @throws RowException
     */
    private function & validateSourceRowData(array & $sourceRowData) : array
    {
        if (!empty($sourceRowData)){
            /* @var $column Column */
            foreach($this->columnContainer as $columnName => $column){
                $sourceColumnName = $column->getSourceName();

                if (!empty($sourceColumnName) && !array_key_exists($sourceColumnName, $sourceRowData)){
                    throw new RowException("Missed source column '$sourceColumnName' at source data");
                }
            }
        }

        return $sourceRowData;
    }

    /**
     * Creates a new cell
     * @param string $columnName
     * @return Cell
     * @throws RowException
     */
    public function createCell(string $columnName) : Cell
    {
        $columnName = trim($columnName);

        if (!isset($this->columnContainer[$columnName])){
            throw new RowException("Column '$columnName' was not specified");
        }

        $cell = new Cell($this->columnContainer[$columnName]);
        $cell->setSourceRowData($this->sourceRowData);
        $cell->generateValue();

        return $cell;
    }

    /**
     * Adds a new cell
     * @param Cell $cell
     * @return Row
     */
    public function addCell(Cell $cell) : self
    {
        $this->cells[] = $cell;
        return $this;
    }

    /**
     * Creates cells
     */
    private function createCells() : void
    {
        foreach($this->columnContainer as $columnName => $column){
            $cell = new Cell($column);
            $cell->setSourceRowData($this->sourceRowData);
            $cell->generateValue();
            $this->cells[] = $cell;
        }
    }

    /**
     * Gets number of row
     * @return int|null
     */
    public function getRowNumber() :? int
    {
        return $this->rowNumber;
    }

    /**
     * Renders row
     * @return array
     */
    public function & render() : array
    {
        $result = parent::render();

        $result['row_number'] = $this->getRowNumber();
        $result['cells'] = $this->renderCells();

        return $result;
    }

    /**
     * Renders cells
     * @return array
     */
    private function & renderCells() : array
    {
        $renderedCells = array();

        foreach($this->cells as &$cell){
            $renderedCells[] = $cell->render();
        }

        return $renderedCells;
    }
}