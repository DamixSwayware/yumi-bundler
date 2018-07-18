<?php

namespace Yumi\Bundler\View\Shared\Textual;

use Yumi\Bundler\View\Shared\Textual\Exception\NumericInputElementException;
use Yumi\Bundler\View\ViewElement;

/**
 * Class NumericInputElementAbstract
 * @package Yumi\Bundler\View\Shared\Textual
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
abstract class NumericInputElementAbstract extends ViewElement
{
    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'numeric_input_element';

        $this->setValue(null);
    }

    /**
     * Sets the max value
     * @param float|null $maxValue
     * @return NumericInputElementAbstract
     * @throws NumericInputElementException
     */
    public function setMaxValue(?float $maxValue) : self
    {
        if ($maxValue === null){
            $this->deleteAttribute('max');
        }
        else{
            if (!empty($this->getMinValue()) && $maxValue < $this->getMinValue()){
                throw new NumericInputElementException('The max value can not be less than min value');
            }

            $this->addAttribute('max', $maxValue);
        }

        return $this;
    }

    /**
     * Gets the max value
     * @return float|null
     */
    public function getMaxValue() : ?float
    {
        $maxValue = $this->getAttribute('max');

        return $maxValue === null ? null : (float) $maxValue;
    }

    /**
     * Sets the min value
     * @param float|null $minValue
     * @return NumericInputElementAbstract
     * @throws NumericInputElementException
     */
    public function setMinValue(?float $minValue) : self
    {
        if ($minValue === null){
            $this->deleteAttribute('min');
        }
        else{
            if (!empty($this->getMaxValue()) && $minValue > $this->getMaxValue()){
                throw new NumericInputElementException('The min value can not be greater than max value');
            }

            $this->addAttribute('min', $minValue);
        }

        return $this;
    }

    /**
     * Gets the min value
     * @return float|null
     */
    public function getMinValue() : ?float
    {
        $minValue = $this->getAttribute('min');

        return $minValue === null ? null : (float) $minValue;
    }

    /**
     * Sets the value
     * @param float|null $value
     * @return NumericInputElementAbstract
     */
    public function setValue(?float $value) : self
    {
        $this->addAttribute('value', $value);

        return $this;
    }

    /**
     * Gets the value
     * @return float|null
     */
    public function getValue() : ?float
    {
        $value = $this->getAttribute('value');

        return $value === null ? null : (float) $value;
    }

    /**
     * Sets the step size
     * @param float|null $stepSize
     * @return NumericInputElementAbstract
     */
    public function setStepSize(?float $stepSize) : self
    {
        if ($stepSize === null){
            $this->deleteAttribute('step');
        }
        else{
            $this->addAttribute('step', $stepSize);
        }

        return $this;
    }

    /**
     * Gets the step size
     * @return float|null
     */
    public function getStepSize() : ?float
    {
        $stepSize = $this->getAttribute('step');

        return $stepSize === null  ? null : (float) $stepSize;
    }

    /**
     * Sets the placeholder
     * @param null|string $placeholder
     * @return NumericInputElementAbstract
     */
    public function setPlaceholder(?string $placeholder) : self
    {
        if ($placeholder === null){
            $this->deleteAttribute('placeholder');
        }
        else{
            $this->addAttribute('placeholder', $placeholder);
        }

        return $this;
    }

    /**
     * Gets the placeholder
     * @return null|string
     */
    public function getPlaceholder() : ?string
    {
        return $this->getAttribute('placeholder');
    }

    public function & render() : array
    {
        $result = parent::render();

        return $result;
    }
}