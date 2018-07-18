<?php

namespace Yumi\Bundler\View\Form\FieldOptions;

use Yumi\Bundler\View\Form\FormFieldOptions;

/**
 * Class NumericInputFieldOptions
 * @package Yumi\Bundler\View\Form\FieldOptions
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBunderl
 *
 */
class NumericInputFieldOptions extends FormFieldOptions
{
    /**
     * @var float|null
     */
    public $max = null;

    /**
     * @var float|null
     */
    public $min = null;

    /**
     * @var float|null
     */
    public $step = null;

    /**
     * @var string|null
     */
    public $placeholder = null;

    /**
     * @return float|null
     */
    public function getMax(): ?float
    {
        return $this->max;
    }

    /**
     * @param float|null $max
     * @return self
     */
    public function setMax(?float $max): self
    {
        $this->max = $max;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getMin(): ?float
    {
        return $this->min;
    }

    /**
     * @param float|null $min
     * @return self
     */
    public function setMin(?float $min): self
    {
        $this->min = $min;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getStep(): ?float
    {
        return $this->step;
    }

    /**
     * @param float|null $step
     * @return self
     */
    public function setStep(?float $step): self
    {
        $this->step = $step;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }

    /**
     * @param string|null $placeholder
     * @return self
     */
    public function setPlaceholder(?string $placeholder): self
    {
        $this->placeholder = $placeholder;

        return $this;
    }


}