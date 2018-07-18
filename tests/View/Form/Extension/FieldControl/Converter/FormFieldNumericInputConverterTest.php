<?php

use PHPUnit\Framework\TestCase;

/**
 * Class FormFieldNumericInputConverterTest
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 *
 */
class FormFieldNumericInputConverterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldRenderElementWithoutErrors() : void
    {
        $_GET = array();

        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form{
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldNumericInputConverter;

            public function getConverter() : callable
            {
                return $this->_registerFormFieldNumericInputConverter();
            }
        };

        $converter = $converterObject->getConverter();

        $formField = new \Yumi\Bundler\View\Form\FormField('test_input',
            \Yumi\Bundler\View\Form\FormFieldType::NUMERIC_INPUT,
            (new \Yumi\Bundler\View\Form\FieldOptions\NumericInputFieldOptions())
            ->setMin(10)
            ->setMax(100)
            ->setStep(5)
            ->setPlaceholder('TestPlaceholder')
        );

        /**
         * @var \Yumi\Bundler\View\Shared\Textual\NumericInputElement $control
         */
        $control = $converter($formField);

        $this->assertEquals(10, $control->getMinValue());
        $this->assertEquals(100, $control->getMaxValue());
        $this->assertEquals(5, $control->getStepSize());
        $this->assertEquals('TestPlaceholder', $control->getPlaceholder());

        $formField = new \Yumi\Bundler\View\Form\FormField('test_input',
            \Yumi\Bundler\View\Form\FormFieldType::NUMERIC_INPUT,
            (new \Yumi\Bundler\View\Form\FieldOptions\NumericInputFieldOptions())
        );

        $control = $converter($formField);

        $this->assertNull($control->getMinValue());
        $this->assertNull($control->getMaxValue());
        $this->assertNull($control->getStepSize());
        $this->assertNull($control->getPlaceholder());

        $formField = new \Yumi\Bundler\View\Form\FormField('test_input',
            \Yumi\Bundler\View\Form\FormFieldType::NUMERIC_INPUT,
            (new \Yumi\Bundler\View\Form\FieldOptions\NumericInputFieldOptions())
                ->setMin(10)
        );

        $control = $converter($formField);

        $this->assertNull($control->getMaxValue());
        $this->assertEquals(10, $control->getMinValue());
        $this->assertNull($control->getStepSize());
        $this->assertNull($control->getPlaceholder());
    }

    /**
     * @expectedException \Yumi\Bundler\View\Shared\Textual\Exception\NumericInputElementException
     * @test
     */
    public function shouldThrowAnExceptionOnBrokenConstraints() : void
    {
        $_GET = array();

        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form{
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldNumericInputConverter;

            public function getConverter() : callable
            {
                return $this->_registerFormFieldNumericInputConverter();
            }
        };

        $converter = $converterObject->getConverter();

        $formField = new \Yumi\Bundler\View\Form\FormField('test_input',
            \Yumi\Bundler\View\Form\FormFieldType::NUMERIC_INPUT,
            (new \Yumi\Bundler\View\Form\FieldOptions\NumericInputFieldOptions())
                ->setMin(1000)
                ->setMax(100)
                ->setStep(5)
                ->setPlaceholder('TestPlaceholder')
        );

        /**
         * @var \Yumi\Bundler\View\Shared\Textual\NumericInputElement $control
         */
        $control = $converter($formField);
    }
}