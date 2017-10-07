<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\View\Table\Sequence;

class ColumnModifierSequence extends ModifierSequence
{
    /**
     * Name of the source column
     * @var string|null
     */
    private $sourceName = null;

    /**
     * Source data
     * @var array
     */
    private $sourceData = array();

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Sets name of the source column
     * @param string $sourceName
     * @return ColumnModifierSequence
     */
    public function setSourceName(string $sourceName) : self
    {
        $this->sourceName = trim($sourceName);
        return $this;
    }

    /**
     * Gets name of the source column
     * @return null|string
     */
    public function getSourceName() :? string
    {
        return $this->sourceName;
    }

    /**
     * Sets source data
     * @param array $sourceData
     * @return ColumnModifierSequence
     */
    public function setSourceData(array &$sourceData) : self
    {
        $this->sourceData = $sourceData;
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
     * Executues as column modifiers sequence
     * @return mixed|null
     */
    public function execute()
    {
        $value = null;

        if (isset($this->sourceData[$this->sourceName])){
            $value = & $this->sourceData[$this->sourceName];
        }
        else{
            $this->sourceData[$this->sourceName] = null;
            $value = & $this->sourceData[$this->sourceName];
        }

        $values = & $this->sourceData;

        foreach($this->modifiers as &$modifier){
            $val = &$value;
            $modifiedValue = $modifier($val, $values);
            $value = &$modifiedValue;
        }

        return $value;
    }
}