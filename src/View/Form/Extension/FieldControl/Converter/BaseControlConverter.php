<?php

namespace Yumi\Bundler\View\Form\Extension\FieldControl\Converter;

use Yumi\Bundler\View\Form\FormField;
use Yumi\Bundler\View\ViewElement;

class BaseControlConverter
{
    public static function convert(ViewElement $viewElement, FormField $formField) : void
    {
        if (!empty($formField->getName())){
            $viewElement->addAttribute('name', $formField->getName());
        }

        if ($formField->getOptions()){
            $viewElement->addAttributes($formField->getOptions()->castAsArray());
        }

        $viewElement->addAttribute('events', $formField->getListenedEvents());
    }
}