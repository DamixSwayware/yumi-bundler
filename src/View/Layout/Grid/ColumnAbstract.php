<?php

namespace Yumi\Bundler\View\Layout\Grid;

use Yumi\Bundler\View\Layout\Grid\Enum\ColumnType;
use Yumi\Bundler\View\Layout\Grid\Exception\ColumnException;
use Yumi\Bundler\View\ViewElement;

/**
 * Class ColumnAbstract
 * @package Yumi\Bundler\View\Layout\Grid
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
abstract class ColumnAbstract extends ViewElement
{
    /**
     * The types of column
     *  column_type => size
     * @var array
     */
    protected $columnTypes = array();


    public function __construct(array $sizes = array())
    {
        parent::__construct();

        $this->elementType = 'column_element';

        $availableSizes = ColumnType::getAllTypes();

        foreach($availableSizes as $availableSize){
            if (!isset($sizes[$availableSize])){
                $sizes[$availableSize] = null;
            }
        }

        $this->setSizes($sizes);
    }

    /**
     * Adds column type
     * @param string $columnType
     * @param int $size
     * @return ColumnAbstract
     * @throws ColumnException
     */
    public function setSize(string $columnType, int $size) : self
    {
        if ($size < 1 || $size > 12){
            throw new ColumnException('The column size can not be less than 0 and greater than 12');
        }

        $columnType = strtolower(trim($columnType));

        if (!ColumnType::isTypeValid($columnType)){
            throw new ColumnException('The column type is not valid. [\'' . $columnType . '\']');
        }

        $this->columnTypes[$columnType] = $size;

        return $this;
    }

    /**
     * Adds column types
     * @param array $columnTypes
     * @return ColumnAbstract
     * @throws ColumnException
     */
    public function setSizes(array $columnTypes) : self
    {
        foreach($columnTypes as $columnType => $size){

            if (!\is_string($columnType)){
                throw new ColumnException('The value (column type) is not a string');
            }

            $this->addColumnType($columnType, $size);
        }

        return $this;
    }

    public function getSizeForType(string $type) : ?int
    {
        return $this->columnTypes[$type] ?? null;
    }

    /**
     * Gets allowed types of column
     * @return array
     */
    public function getSizes() : array
    {
        return $this->columnTypes;
    }


    public function & render() : array
    {
        $result = parent::render();

        foreach($this->columnTypes as $columnType => $size){
            $this->addClass('col-' . $columnType . '-' . $size);
        }

        return $result;
    }
}