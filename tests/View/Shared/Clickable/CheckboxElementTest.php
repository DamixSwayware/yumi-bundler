<?php

use PHPUnit\Framework\TestCase;

class CheckboxElementTest extends TestCase
{
    /**
     * @test
     */
    public function shouldSetNameAndValue() : void
    {
        $checkbox = new \Yumi\Bundler\View\Shared\Clickable\CheckboxElement();

        $checkbox->setName('test');
        $checkbox->setValue('val');

        $this->assertEquals('test', $checkbox->getName());
        $this->assertEquals('val', $checkbox->getValue());

        $renderResult = $checkbox->render();

        $this->assertEquals('test', $renderResult['attributes']['name']);
        $this->assertEquals('val', $renderResult['attributes']['value']);

    }

    /**
     * @test
     */
    public function shouldSetLabel() : void
    {
        $checkbox = new \Yumi\Bundler\View\Shared\Clickable\CheckboxElement();

        $checkbox->setLabel('Test');

        $this->assertEquals('Test', $checkbox->getLabel());

        $renderResult = $checkbox->render();

        $this->assertEquals('Test', $renderResult['label']);
    }
}