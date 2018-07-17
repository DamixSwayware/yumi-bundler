<?php

use PHPUnit\Framework\TestCase;

/**
 * Class OptionElementTest
 * @author Reverze <hawkmedia24@gmail.com>
 *
 */
class OptionElementTest extends TestCase
{
    /**
     * @test
     */
    public function shouldSetValueAndLabel() : void
    {
        $optionElement = new \Yumi\Bundler\View\Shared\Clickable\SelectBox\OptionElement();
        $optionElement->setValue('vol');
        $optionElement->setLabel('Test');

        $this->assertEquals('vol', $optionElement->getValue());
        $this->assertEquals('Test', $optionElement->getLabel());


        $renderResult = $optionElement->render();

        $this->assertArrayHasKey('value', $renderResult['attributes']);
        $this->assertEquals('vol', $renderResult['attributes']['value']);

        $this->assertEquals('Test', $renderResult['simpleValue']);
    }


}