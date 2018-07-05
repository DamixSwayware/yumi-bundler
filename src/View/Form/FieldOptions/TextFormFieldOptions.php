<?php

namespace Yumi\Bundler\View\Form\FieldOptions;

use Yumi\Bundler\View\Form\FormFieldOptions;

class TextFormFieldOptions extends FormFieldOptions
{
    public $placeholder = null;

    public function setPlaceholder(?string $placeholder) : self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function getPlaceholder() : ?string
    {
        return $this->placeholder;
    }
}
