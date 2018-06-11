<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Table;

use Yumi\Bundler\View\ViewElement;

class Cell extends ViewElement
{
    /**
     * @var Column
     */
    private $column = null;

    private $sourceRowData = array();

    private $value = null;

    public function __construct(Column $column)
    {
        parent::__construct();

        $this->column = $column;
    }

    /**
     * Sets source row data
     * @param array $sourceRowData
     * @return Cell
     */
    public function setSourceRowData(array &$sourceRowData) : self
    {
        $this->sourceRowData = $sourceRowData;
        return $this;
    }

    /**
     * Generates value using column modifiers
     */
    public function generateValue() : self
    {
        $this->value = $this->column->executeModifiers($this->sourceRowData);
        return $this;
    }

    /**
     * Renders cell
     * @return array
     */
    public function & render() : array
    {
        $result = parent::render();

        if (empty($this->sourceValue)){
            $this->generateValue();
        }

        $result['column_name'] = $this->column->getName();
        $result['cell_value'] = $this->value;

        return $result;
    }
}