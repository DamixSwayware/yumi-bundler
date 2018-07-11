<?php

use PHPUnit\Framework\TestCase;

/**
 * Class RadioButtonElementTest
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 */
class RadioButtonElementTest extends TestCase
{

    /**
     * @test
     */
    public function shouldSetNameAndValue() : void
    {
        $radioButtonElement = new \Yumi\Bundler\View\Shared\Button\RadioButtonElement();

        $radioButtonElement->setName('test');
        $radioButtonElement->setValue('val');

        $this->assertEquals('test', $radioButtonElement->getName());
        $this->assertEquals('val', $radioButtonElement->getValue());

        $renderResult = $radioButtonElement->render();

        $this->assertEquals('test', $renderResult['attributes']['name']);
        $this->assertEquals('val', $renderResult['attributes']['value']);

    }

    /**
     * @test
     */
    public function shouldSetLabel() : void
    {
        $radioButtonElement = new \Yumi\Bundler\View\Shared\Button\RadioButtonElement();

        $radioButtonElement->setLabel('Test');

        $this->assertEquals('Test', $radioButtonElement->getLabel());

        $renderResult = $radioButtonElement->render();

        $this->assertEquals('Test', $renderResult['label']);
    }

}