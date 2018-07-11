<?php

use PHPUnit\Framework\TestCase;


class FormFieldCheckboxInputConverterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldSetLabelAndNameAndValue() : void
    {
        $_GET = array();

        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form {
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldCheckboxInputConverter;

            public function getConverter() : callable
            {
                return $this->_registerFormFieldCheckboxInputConverter();
            }

        };

        $converter = $converterObject->getConverter();

        $formField = new \Yumi\Bundler\View\Form\FormField('test_checkbox',
            \Yumi\Bundler\View\Form\FormFieldType::CHECKBOX,
            new \Yumi\Bundler\View\Form\FieldOptions\CheckboxFieldOptions()
        );

        $formField->getOptions()->setLabel('Test');

        $control = $converter($formField);

        $this->assertEquals('Test', $control->getLabel());
        $this->assertEquals('test_checkbox', $control->getName());
        $this->assertEquals('1', $control->getValue());

        $renderResult = $control->render();

        $this->assertEquals('checkbox_element', $renderResult['_element_type']);
        $this->assertNotNull($renderResult['id']);
        $this->assertEquals('Test', $renderResult['label']);
    }

    /**
     * @test
     */
    public function shouldRenderCheckboxAsChecked() : void
    {
        $_GET = array();

        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form {
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldCheckboxInputConverter;

            public $fieldControlConverters = array();

            public function getConverter() : callable
            {
                return $this->_registerFormFieldCheckboxInputConverter();
            }

        };

        $converter = $converterObject->getConverter();

        $formField = new \Yumi\Bundler\View\Form\FormField('test_checkbox',
            \Yumi\Bundler\View\Form\FormFieldType::CHECKBOX,
            (new \Yumi\Bundler\View\Form\FieldOptions\CheckboxFieldOptions())
            ->setAsChecked()
        );

        $formField->getOptions()->setLabel('Test');

        $control = $converter($formField);

        $renderResult = $control->render();

        $this->assertArrayHasKey('checked', $renderResult['attributes']);
        $this->assertEquals('checked', $renderResult['attributes']['checked']);
    }

    /**
     * @test
     */
    public function shouldRenderCheckboxAsNotChecked() : void
    {
        $_GET = array();

        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form {
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldCheckboxInputConverter;

            public $fieldControlConverters = array();

            public function getConverter() : callable
            {
                return $this->_registerFormFieldCheckboxInputConverter();
            }

        };

        $converter = $converterObject->getConverter();

        $formField = new \Yumi\Bundler\View\Form\FormField('test_checkbox',
            \Yumi\Bundler\View\Form\FormFieldType::CHECKBOX,
            (new \Yumi\Bundler\View\Form\FieldOptions\CheckboxFieldOptions())
                ->setAsNotChecked()
        );

        $formField->getOptions()->setLabel('Test');

        $control = $converter($formField);

        $renderResult = $control->render();

        $this->assertArrayNotHasKey('checked', $renderResult['attributes']);
    }

    /**
     * @test
     */
    public function shouldRenderCheckboxAsCheckedDependingOnSubmittedForm() : void
    {
        $_GET = array();

        $_GET['test_checkbox'] = '1';
        $_GET[\Yumi\Bundler\View\Form\FormAbstract::FORM_NAME_FIELD] =
            \Yumi\Bundler\Driver\FormDriverManager::hashFormName('test');

        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form {
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldCheckboxInputConverter;

            public $fieldControlConverters = array();

            public function __construct(string $formName)
            {
                parent::__construct($formName);

                $this->setMethod(\Yumi\Bundler\View\Form\Form::METHOD_GET);
            }

            public function getConverter() : callable
            {
                return $this->_registerFormFieldCheckboxInputConverter();
            }

        };

        $converter = $converterObject->getConverter();

        $formField = new \Yumi\Bundler\View\Form\FormField('test_checkbox',
            \Yumi\Bundler\View\Form\FormFieldType::CHECKBOX,
            (new \Yumi\Bundler\View\Form\FieldOptions\CheckboxFieldOptions())
                ->setAsNotChecked()
        );

        $formField->setValue('1');

        $formField->getOptions()->setLabel('Test');

        $control = $converter($formField);

        $renderResult = $control->render();

        $this->assertArrayHasKey('checked', $renderResult['attributes']);
        $this->assertEquals('checked', $renderResult['attributes']['checked']);

    }

    /**
     * @test
     */
    public function shouldRenderCheckboxAsNotCheckedDependingOnSubmittedForm() : void
    {
        $_GET = array();

        $_GET['test_checkbox'] = '0';
        $_GET[\Yumi\Bundler\View\Form\FormAbstract::FORM_NAME_FIELD] =
            \Yumi\Bundler\Driver\FormDriverManager::hashFormName('test');

        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form {
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldCheckboxInputConverter;

            public $fieldControlConverters = array();

            public function __construct(string $formName)
            {
                parent::__construct($formName);

                $this->setMethod(\Yumi\Bundler\View\Form\Form::METHOD_GET);
            }

            public function getConverter() : callable
            {
                return $this->_registerFormFieldCheckboxInputConverter();
            }

        };

        $converter = $converterObject->getConverter();

        $formField = new \Yumi\Bundler\View\Form\FormField('test_checkbox',
            \Yumi\Bundler\View\Form\FormFieldType::CHECKBOX,
            (new \Yumi\Bundler\View\Form\FieldOptions\CheckboxFieldOptions())
                ->setAsChecked()
        );

        $formField->setValue('0');

        $formField->getOptions()->setLabel('Test');

        $control = $converter($formField);

        $renderResult = $control->render();

        $this->assertArrayHasKey('checked', $renderResult['attributes']);
        $this->assertNull($renderResult['attributes']['checked']);

    }
}