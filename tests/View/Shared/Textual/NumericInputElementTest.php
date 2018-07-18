<?php

use PHPUnit\Framework\TestCase;

/**
 * Class NumericInputElementTest
 * @author Reverze <hawkmedia24@gmail.com>
 *
 */
class NumericInputElementTest extends TestCase
{
    /**
     * Tests the behaviour of getters and setters
     * @test
     */
    public function shouldProperSetAttributes() : void
    {
        $numericInput = new \Yumi\Bundler\View\Shared\Textual\NumericInputElement();

        $numericInput->setMaxValue(100);
        $numericInput->setMinValue(10);

        $numericInput->setStepSize(5);
        $numericInput->setPlaceholder('TestPlaceholder');

        $numericInput->setValue(10);

        $this->assertEquals(100, $numericInput->getMaxValue());
        $this->assertEquals(10, $numericInput->getMinValue());
        $this->assertEquals(5, $numericInput->getStepSize());
        $this->assertEquals('TestPlaceholder', $numericInput->getPlaceholder());
        $this->assertEquals(10, $numericInput->getValue());

        $renderResult = $numericInput->render();

        $this->assertEquals('numeric_input_element', $renderResult['_element_type']);

        $this->assertEquals(100, $renderResult['attributes']['max']);
        $this->assertEquals(10, $renderResult['attributes']['min']);
        $this->assertEquals(5, $renderResult['attributes']['step']);
        $this->assertEquals('TestPlaceholder', $renderResult['attributes']['placeholder']);
        $this->assertEquals(10, $renderResult['attributes']['value']);

        $numericInput = new \Yumi\Bundler\View\Shared\Textual\NumericInputElement();

        $this->assertNull($numericInput->getMaxValue());
        $this->assertNull($numericInput->getMinValue());
        $this->assertNull($numericInput->getStepSize());
        $this->assertNull($numericInput->getPlaceholder());
        $this->assertNull($numericInput->getValue());

        $renderResult = $numericInput->render();

        $this->assertArrayNotHasKey('max', $renderResult['attributes']);
        $this->assertArrayNotHasKey('min', $renderResult['attributes']);
        $this->assertArrayNotHasKey('step', $renderResult['attributes']);
        $this->assertArrayNotHasKey('placeholder', $renderResult['attributes']);
        $this->assertArrayHasKey('value', $renderResult['attributes']);
        $this->assertNull($renderResult['attributes']['value']);
    }

    /**
     * The control should not allow to set the attribute minValue greater than maxValue
     * @expectedException \Yumi\Bundler\View\Shared\Textual\Exception\NumericInputElementException
     * @test
     */
    public function shouldThrowAnExceptionOnGreaterMinValueThanMaxValue() : void
    {
        $numericInput = new \Yumi\Bundler\View\Shared\Textual\NumericInputElement();

        $numericInput->setMaxValue(100);
        $numericInput->setMinValue(5000);
    }

    /**
     * The control should not allow to set the attribute maxValue less than minValue
     * @expectedException \Yumi\Bundler\View\Shared\Textual\Exception\NumericInputElementException
     * @test
     */
    public function shouldThrowAnExceptionOnMaxValueLessThanMinValue() : void
    {
        $numericInput = new \Yumi\Bundler\View\Shared\Textual\NumericInputElement();

        $numericInput->setMinValue(100);
        $numericInput->setMaxValue(10);
    }

    /**
     * The control has constraint to not allow set maxValue less than minValue.
     * This tests behaviour when minValue is not set.
     * @test
     */
    public function shouldNotThrowAnExceptionOnSetMaxValue() : void
    {
        $numericInput = new \Yumi\Bundler\View\Shared\Textual\NumericInputElement();

        $numericInput->setMaxValue(100);

        $this->assertEquals(true, true);
    }

    /**
     * The control has constraint to not allow set minValue greater than maxValue.
     * This tests behaviour when maxValue is not set.
     * @test
     */
    public function shouldNotThrowAnExceptionOnSetMinValue() : void
    {
        $numericInput = new \Yumi\Bundler\View\Shared\Textual\NumericInputElement();

        $numericInput->setMinValue(10);

        $this->assertEquals(true, true);
    }


}