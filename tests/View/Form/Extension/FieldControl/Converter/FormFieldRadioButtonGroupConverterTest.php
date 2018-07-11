<?php

use PHPUnit\Framework\TestCase;

/**
 * Class FormFieldRadioButtonGroupConverterTest
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
class FormFieldRadioButtonGroupConverterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldProperRenderButtons() : void
    {
        $_GET = array();

        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form {
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldRadioButtonGroupConverter;

            public $fieldControlConverters = array();

            public function getConverter() : callable
            {
                return $this->_registerFormFieldRadioButtonGroupConverter();
            }
        };

        $converter = $converterObject->getConverter();

        $groupFormField = new \Yumi\Bundler\View\Form\FormField\RadioButtonGroup\RadioButtonGroupFormField('gender',
            \Yumi\Bundler\View\Form\FormFieldType::RADIO_BUTTON_GROUP);

        $groupFormField->setDefinition([
            'male' => [
                'label' => 'Male',
            ],
            'female' => [
                'label' => 'Female',
            ],
        ]);

        /**
         * @var \Yumi\Bundler\View\Form\FormField\RadioButtonGroup\RadioButtonGroupFormField $control
         */
        $control = $converter($groupFormField);

        $renderResult = $control->render();

        $this->assertEquals('radio_button_group_element', $renderResult['_element_type']);
        $this->assertNotNull($renderResult['id']);

        $this->assertNotNull($renderResult['items']);

        $this->assertCount(2, $renderResult['items']);

        $this->assertEquals('radio_button_element', $renderResult['items'][0]['_element_type']);
        $this->assertEquals('radio_button_element', $renderResult['items'][1]['_element_type']);

        $this->assertNotNull($renderResult['items'][0]['id']);
        $this->assertNotNull($renderResult['items'][1]['id']);

        $this->assertEquals('gender', $renderResult['items'][0]['attributes']['name']);
        $this->assertEquals('male', $renderResult['items'][0]['attributes']['value']);
        $this->assertArrayNotHasKey('checked', $renderResult['items'][0]['attributes']);
        $this->assertEquals('Male', $renderResult['items'][0]['label']);

        $this->assertEquals('gender', $renderResult['items'][1]['attributes']['name']);
        $this->assertEquals('female', $renderResult['items'][1]['attributes']['value']);
        $this->assertArrayNotHasKey('checked', $renderResult['items'][1]['attributes']);
        $this->assertEquals('Female', $renderResult['items'][1]['label']);

    }

    /**
     * @test
     */
    public function shouldProperRenderButtonsWithDefault() : void
    {
        $_GET = array();

        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form {
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldRadioButtonGroupConverter;

            public $fieldControlConverters = array();

            public function getConverter() : callable
            {
                return $this->_registerFormFieldRadioButtonGroupConverter();
            }
        };

        $converter = $converterObject->getConverter();

        $groupFormField = new \Yumi\Bundler\View\Form\FormField\RadioButtonGroup\RadioButtonGroupFormField('gender',
            \Yumi\Bundler\View\Form\FormFieldType::RADIO_BUTTON_GROUP);

        $groupFormField->setDefinition([
            'male' => [
                'label' => 'Male',
                'default' => true,
            ],
            'female' => [
                'label' => 'Female',
            ],
        ]);

        /**
         * @var \Yumi\Bundler\View\Form\FormField\RadioButtonGroup\RadioButtonGroupFormField $control
         */
        $control = $converter($groupFormField);

        $renderResult = $control->render();


        $this->assertEquals('radio_button_group_element', $renderResult['_element_type']);
        $this->assertNotNull($renderResult['id']);

        $this->assertNotNull($renderResult['items']);

        $this->assertCount(2, $renderResult['items']);

        $this->assertEquals('radio_button_element', $renderResult['items'][0]['_element_type']);
        $this->assertEquals('radio_button_element', $renderResult['items'][1]['_element_type']);

        $this->assertNotNull($renderResult['items'][0]['id']);
        $this->assertNotNull($renderResult['items'][1]['id']);

        $this->assertEquals('gender', $renderResult['items'][0]['attributes']['name']);
        $this->assertEquals('male', $renderResult['items'][0]['attributes']['value']);
        $this->assertArrayHasKey('checked', $renderResult['items'][0]['attributes']);
        $this->assertEquals('checked', $renderResult['items'][0]['attributes']['checked']);
        $this->assertEquals('Male', $renderResult['items'][0]['label']);

        $this->assertEquals('gender', $renderResult['items'][1]['attributes']['name']);
        $this->assertEquals('female', $renderResult['items'][1]['attributes']['value']);
        $this->assertArrayNotHasKey('checked', $renderResult['items'][1]['attributes']);
        $this->assertEquals('Female', $renderResult['items'][1]['label']);
    }

    /**
     * @test
     */
    public function shouldTargetFirstRadioButtonAsDefault() : void
    {
        $_GET = array();

        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form {
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldRadioButtonGroupConverter;

            public $fieldControlConverters = array();

            public function getConverter() : callable
            {
                return $this->_registerFormFieldRadioButtonGroupConverter();
            }
        };

        $converter = $converterObject->getConverter();

        $groupFormField = new \Yumi\Bundler\View\Form\FormField\RadioButtonGroup\RadioButtonGroupFormField('gender',
            \Yumi\Bundler\View\Form\FormFieldType::RADIO_BUTTON_GROUP);

        $groupFormField->setDefinition([
            'male' => [
                'label' => 'Male',
                'default' => true,
            ],
            'female' => [
                'label' => 'Female',
                'default' => true,
            ],
        ]);

        /**
         * @var \Yumi\Bundler\View\Form\FormField\RadioButtonGroup\RadioButtonGroupFormField $control
         */
        $control = $converter($groupFormField);

        $renderResult = $control->render();


        $this->assertEquals('radio_button_group_element', $renderResult['_element_type']);
        $this->assertNotNull($renderResult['id']);

        $this->assertNotNull($renderResult['items']);

        $this->assertCount(2, $renderResult['items']);

        $this->assertEquals('radio_button_element', $renderResult['items'][0]['_element_type']);
        $this->assertEquals('radio_button_element', $renderResult['items'][1]['_element_type']);

        $this->assertNotNull($renderResult['items'][0]['id']);
        $this->assertNotNull($renderResult['items'][1]['id']);

        $this->assertEquals('gender', $renderResult['items'][0]['attributes']['name']);
        $this->assertEquals('male', $renderResult['items'][0]['attributes']['value']);
        $this->assertArrayHasKey('checked', $renderResult['items'][0]['attributes']);
        $this->assertEquals('checked', $renderResult['items'][0]['attributes']['checked']);
        $this->assertEquals('Male', $renderResult['items'][0]['label']);

        $this->assertEquals('gender', $renderResult['items'][1]['attributes']['name']);
        $this->assertEquals('female', $renderResult['items'][1]['attributes']['value']);
        $this->assertArrayNotHasKey('checked', $renderResult['items'][1]['attributes']);
        $this->assertEquals('Female', $renderResult['items'][1]['label']);
    }

    /**
     * @test
     */
    public function shouldCheckRadioButtonDependingOnSubmittedForm() : void
    {
        $_GET = array();

        $_GET['gender'] = 'female';
        $_GET[\Yumi\Bundler\View\Form\FormAbstract::FORM_NAME_FIELD] = \Yumi\Bundler\Driver\FormDriverManager::hashFormName('test');

        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form {
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldRadioButtonGroupConverter;

            public $fieldControlConverters = array();

            public function __construct(string $formName)
            {
                parent::__construct($formName);

                $this->setMethod(\Yumi\Bundler\View\Form\Form::METHOD_GET);
            }

            public function getConverter() : callable
            {
                return $this->_registerFormFieldRadioButtonGroupConverter();
            }
        };

        $converter = $converterObject->getConverter();

        $groupFormField = new \Yumi\Bundler\View\Form\FormField\RadioButtonGroup\RadioButtonGroupFormField('gender',
            \Yumi\Bundler\View\Form\FormFieldType::RADIO_BUTTON_GROUP);

        $groupFormField->setValue('female');

        $groupFormField->setDefinition([
            'male' => [
                'label' => 'Male',
                'default' => true,
            ],
            'female' => [
                'label' => 'Female',
            ],
        ]);

        /**
         * @var \Yumi\Bundler\View\Form\FormField\RadioButtonGroup\RadioButtonGroupFormField $control
         */
        $control = $converter($groupFormField);

        $renderResult = $control->render();

        $this->assertEquals('radio_button_group_element', $renderResult['_element_type']);
        $this->assertNotNull($renderResult['id']);

        $this->assertNotNull($renderResult['items']);

        $this->assertCount(2, $renderResult['items']);

        $this->assertEquals('radio_button_element', $renderResult['items'][0]['_element_type']);
        $this->assertEquals('radio_button_element', $renderResult['items'][1]['_element_type']);

        $this->assertNotNull($renderResult['items'][0]['id']);
        $this->assertNotNull($renderResult['items'][1]['id']);

        $this->assertEquals('gender', $renderResult['items'][0]['attributes']['name']);
        $this->assertEquals('male', $renderResult['items'][0]['attributes']['value']);
        $this->assertNull( $renderResult['items'][0]['attributes']['checked']);
        $this->assertEquals('Male', $renderResult['items'][0]['label']);

        $this->assertEquals('gender', $renderResult['items'][1]['attributes']['name']);
        $this->assertEquals('female', $renderResult['items'][1]['attributes']['value']);
        $this->assertArrayHasKey('checked', $renderResult['items'][1]['attributes']);
        $this->assertEquals('checked', $renderResult['items'][1]['attributes']['checked']);
        $this->assertEquals('Female', $renderResult['items'][1]['label']);
    }
}
