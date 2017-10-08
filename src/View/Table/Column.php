<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Table;

use Yumi\Bundler\View\Table\Exception\ColumnException;
use Yumi\Bundler\View\Table\Sequence\ColumnModifierSequence;
use Yumi\Bundler\View\ViewElement;

class Column extends ViewElement
{
    /**
     * Unique name of the column in table
     * @var string|null
     */
    private $columnName = null;

    /**
     * Name of the column on the source data
     * @var string|null
     */
    private $sourceName = null;

    /**
     * Title of the column
     * @var string|null
     */
    private $columnTitle = null;

    /**
     * Modifiers sequence
     * @var ColumnModifierSequence
     */
    private $modifiers = null;


    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'table_column_element';
        $this->modifiers = new ColumnModifierSequence();
    }

    /**
     * Sets name of the column
     * @param string $columnName
     * @return Column
     */
    public function setName(string $columnName) : self
    {
        $this->columnName = trim($columnName);
        return $this;
    }

    /**
     * Gets name of the column
     * @return null|string
     */
    public function getName() :? string
    {
        return $this->columnName;
    }

    /**
     * Sets name of the column on the source data
     * @param string|null $sourceName
     * @return Column
     */
    public function setSourceName(?string $sourceName) : self
    {
        $this->sourceName = empty($sourceName) ? null : trim($sourceName);
        return $this;
    }

    /**
     * Gets name of column on the source data
     * @return null|string
     */
    public function getSourceName() :? string
    {
        return $this->sourceName;
    }

    /**
     * Sets title of the column
     * @param string $columnTitle
     * @return Column
     */
    public function setTitle(string $columnTitle) : self
    {
        $this->columnTitle = trim($columnTitle);
        return $this;
    }

    /**
     * Gets title of the column
     * @return null|string
     */
    public function getTitle() :? string
    {
        return $this->columnTitle;
    }

    /**
     * Adds modifier
     * @param callable $modifier
     * @return Column
     */
    public function addModifier(callable $modifier) : self
    {
        $this->modifiers->addModifier($modifier);
        return $this;
    }

    /**
     * Executes modifers
     * @param array $values
     * @return mixed
     */
    public function & executeModifiers(array &$values)
    {
        $this->modifiers->setSourceName($this->getSourceName());
        $this->modifiers->setSourceData($values);
        $modifiedValue = $this->modifiers->execute();
        return $modifiedValue;
    }

    /**
     * Renders column
     * @throws ColumnException
     * @return array
     */
    public function & render() : array
    {
        $renderResult = parent::render();

        if (empty($this->getTitle())){
            throw new ColumnException("Title of column was not specified");
        }

        if (empty($this->getName())){
            throw new ColumnException("Name of column was not specified");
        }

        $renderResult['column_title'] = $this->getTitle();
        $renderResult['column_name'] = $this->getName();

        return $renderResult;
    }
}