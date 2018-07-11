<?php

namespace Yumi\Bundler\View\Shared\Button;

use Yumi\Bundler\View\ViewElement;

/**
 * Class RadioButtonGroupElementAbstract
 * @package Yumi\Bundler\View\Shared\Button
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
abstract class RadioButtonGroupElementAbstract extends ViewElement
{
    /**
     * @var RadioButtonElementAbstract[]
     */
    private $radioButtons = array();

    public function __construct()
    {
        parent::__construct();

        $this->elementType = 'radio_button_group_element';
    }

    /**
     * Adds radio button into group
     *
     * @param RadioButtonElementAbstract $radioButtonElement
     * @return RadioButtonGroupElementAbstract
     */
    public function addItem(RadioButtonElementAbstract $radioButtonElement) : self
    {
        $this->radioButtons[] = $radioButtonElement;

        return $this;
    }

    /**
     * Gets assigned radio buttons
     *
     * @return RadioButtonElementAbstract[]
     */
    public function getItems() : array
    {
        return $this->radioButtons;
    }

    public function createItems(string $groupName, array $definition) : self
    {
        foreach($definition as $buttonValue => &$buttonDescription){
            $radioButton = new RadioButtonElement();
            $radioButton->setName($groupName);
            $radioButton->setValue($buttonValue);

            if (isset($buttonDescription['label'])){
                $radioButton->setLabel($buttonDescription['label']);
            }

            $this->addItem($radioButton);
        }

        return $this;
    }

    public function & render() : array
    {
        $result = parent::render();

        $result['items'] = array();

        foreach($this->radioButtons as $radioButton){
            $result['items'][] = $radioButton->render();
        }

        return $result;
    }

}