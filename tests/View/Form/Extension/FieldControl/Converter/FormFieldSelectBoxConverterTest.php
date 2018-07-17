<?php

use PHPUnit\Framework\TestCase;

/**
 * Class FormFieldSelectBoxConverterTest
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
class FormFieldSelectBoxConverterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldProperRenderSingleSelectElement() : void
    {
        $_GET = array();

        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form {
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldSelectBoxConverter;

            public $fieldControlConverters = array();

            public function getConverter() : callable
            {
                return $this->_registerFormFieldSelectBoxConverter();
            }
        };

        $converter = $converterObject->getConverter();

        $selectBoxField = new \Yumi\Bundler\View\Form\FormField\SelectBox\SelectBoxFormField(
            'test_select', \Yumi\Bundler\View\Form\FormFieldType::SELECT_BOX
        );

        $selectBoxField->setOptionValues([
            1 => [
                'label' => 'Test1',
                'selected' => true,
            ],
            2 => [
                'label' => 'Test2',
            ]
        ]);

        /**
         * @var \Yumi\Bundler\View\Shared\Clickable\SelectBoxElement $control
         */
        $control = $converter($selectBoxField);

        $renderResult = $control->render();

        $this->assertEquals('select_box_element', $renderResult['_element_type']);

        $this->assertArrayHasKey('name', $renderResult['attributes']);
        $this->assertEquals('test_select', $renderResult['attributes']['name']);

        $this->assertNotNull($renderResult['items']);

        $this->assertCount(2, $renderResult['items']);

        $this->assertEquals('select_box_option_element', $renderResult['items'][0]['_element_type']);
        $this->assertEquals('select_box_option_element', $renderResult['items'][1]['_element_type']);

        $this->assertNotNull($renderResult['items'][0]['id']);
        $this->assertNotNull($renderResult['items'][1]['id']);

        $this->assertArrayHasKey('selected', $renderResult['items'][0]['attributes']);
        $this->assertEquals('selected', $renderResult['items'][0]['attributes']['selected']);
        $this->assertEquals('1', $renderResult['items'][0]['attributes']['value']);
        $this->assertEquals('Test1', $renderResult['items'][0]['simpleValue']);

        $this->assertArrayNotHasKey('selected', $renderResult['items'][1]['attributes']);
        $this->assertEquals('2', $renderResult['items'][1]['attributes']['value']);
        $this->assertEquals('Test2', $renderResult['items'][1]['simpleValue']);
    }

    /**
     * @test
     */
    public function shouldProperRenderMultipleSelectElement() : void
    {
        $_GET = array();

        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form {
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldSelectBoxConverter;

            public $fieldControlConverters = array();

            public function getConverter() : callable
            {
                return $this->_registerFormFieldSelectBoxConverter();
            }
        };

        $converter = $converterObject->getConverter();

        $selectBoxField = new \Yumi\Bundler\View\Form\FormField\SelectBox\SelectBoxFormField(
            'test_select', \Yumi\Bundler\View\Form\FormFieldType::SELECT_BOX
        );

        $selectBoxField->setOptionValues([
            1 => [
                'label' => 'Test1',
                'selected' => true,
            ],
            2 => [
                'label' => 'Test2',
            ]
        ]);

        $selectBoxField->multipleSelect(true);

        /**
         * @var \Yumi\Bundler\View\Shared\Clickable\SelectBoxElement $control
         */
        $control = $converter($selectBoxField);

        $renderResult = $control->render();

        $this->assertEquals('select_box_element', $renderResult['_element_type']);

        $this->assertArrayHasKey('name', $renderResult['attributes']);
        $this->assertEquals('test_select[]', $renderResult['attributes']['name']);

        $this->assertNotNull($renderResult['items']);

        $this->assertCount(2, $renderResult['items']);

        $this->assertEquals('select_box_option_element', $renderResult['items'][0]['_element_type']);
        $this->assertEquals('select_box_option_element', $renderResult['items'][1]['_element_type']);

        $this->assertNotNull($renderResult['items'][0]['id']);
        $this->assertNotNull($renderResult['items'][1]['id']);

        $this->assertArrayHasKey('selected', $renderResult['items'][0]['attributes']);
        $this->assertEquals('selected', $renderResult['items'][0]['attributes']['selected']);
        $this->assertEquals('1', $renderResult['items'][0]['attributes']['value']);
        $this->assertEquals('Test1', $renderResult['items'][0]['simpleValue']);

        $this->assertArrayNotHasKey('selected', $renderResult['items'][1]['attributes']);
        $this->assertEquals('2', $renderResult['items'][1]['attributes']['value']);
        $this->assertEquals('Test2', $renderResult['items'][1]['simpleValue']);
    }

    /**
     * @test
     */
    public function shouldProperRenderSingleSelectElementOnSubmittedForm() : void
    {
        $_GET = array();

        $_GET[\Yumi\Bundler\View\Form\FormAbstract::FORM_NAME_FIELD] =
            \Yumi\Bundler\Driver\FormDriverManager::hashFormName('test');

        $_GET['test_select'] = '2';

        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form {
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldSelectBoxConverter;

            public $fieldControlConverters = array();

            public function __construct(string $formName)
            {
                parent::__construct($formName);

                $this->setMethod(\Yumi\Bundler\View\Form\Form::METHOD_GET);
            }

            public function getConverter() : callable
            {
                return $this->_registerFormFieldSelectBoxConverter();
            }
        };

        $converter = $converterObject->getConverter();

        $selectBoxField = new \Yumi\Bundler\View\Form\FormField\SelectBox\SelectBoxFormField(
            'test_select', \Yumi\Bundler\View\Form\FormFieldType::SELECT_BOX
        );

        $selectBoxField->setValue('2');

        $selectBoxField->setOptionValues([
            1 => [
                'label' => 'Test1',
                'selected' => true,
            ],
            2 => [
                'label' => 'Test2',
            ]
        ]);

        /**
         * @var \Yumi\Bundler\View\Shared\Clickable\SelectBoxElement $control
         */
        $control = $converter($selectBoxField);

        $renderResult = $control->render();

        $this->assertEquals('select_box_element', $renderResult['_element_type']);

        $this->assertArrayHasKey('name', $renderResult['attributes']);
        $this->assertEquals('test_select', $renderResult['attributes']['name']);

        $this->assertNotNull($renderResult['items']);

        $this->assertCount(2, $renderResult['items']);

        $this->assertEquals('select_box_option_element', $renderResult['items'][0]['_element_type']);
        $this->assertEquals('select_box_option_element', $renderResult['items'][1]['_element_type']);

        $this->assertNotNull($renderResult['items'][0]['id']);
        $this->assertNotNull($renderResult['items'][1]['id']);

        $this->assertArrayNotHasKey('selected', $renderResult['items'][0]['attributes']);
        $this->assertEquals('1', $renderResult['items'][0]['attributes']['value']);
        $this->assertEquals('Test1', $renderResult['items'][0]['simpleValue']);

        $this->assertArrayHasKey('selected', $renderResult['items'][1]['attributes']);
        $this->assertEquals('selected', $renderResult['items']['1']['attributes']['selected']);
        $this->assertEquals('2', $renderResult['items'][1]['attributes']['value']);
        $this->assertEquals('Test2', $renderResult['items'][1]['simpleValue']);
    }

    /**
     * @test
     */
    public function shouldProperRenderSingleSelectElementOnSubmittedFormNothingSelected() : void
    {
        $_GET = array();

        $_GET[\Yumi\Bundler\View\Form\FormAbstract::FORM_NAME_FIELD] =
            \Yumi\Bundler\Driver\FormDriverManager::hashFormName('test');

        $_GET['test_select'] = '2';

        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form {
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldSelectBoxConverter;

            public $fieldControlConverters = array();

            public function __construct(string $formName)
            {
                parent::__construct($formName);

                $this->setMethod(\Yumi\Bundler\View\Form\Form::METHOD_GET);
            }

            public function getConverter() : callable
            {
                return $this->_registerFormFieldSelectBoxConverter();
            }
        };

        $converter = $converterObject->getConverter();

        $selectBoxField = new \Yumi\Bundler\View\Form\FormField\SelectBox\SelectBoxFormField(
            'test_select', \Yumi\Bundler\View\Form\FormFieldType::SELECT_BOX
        );

        $selectBoxField->setValue(null);

        $selectBoxField->setOptionValues([
            1 => [
                'label' => 'Test1',
                'selected' => true,
            ],
            2 => [
                'label' => 'Test2',
            ]
        ]);

        /**
         * @var \Yumi\Bundler\View\Shared\Clickable\SelectBoxElement $control
         */
        $control = $converter($selectBoxField);

        $renderResult = $control->render();

        $this->assertEquals('select_box_element', $renderResult['_element_type']);

        $this->assertArrayHasKey('name', $renderResult['attributes']);
        $this->assertEquals('test_select', $renderResult['attributes']['name']);

        $this->assertNotNull($renderResult['items']);

        $this->assertCount(2, $renderResult['items']);

        $this->assertEquals('select_box_option_element', $renderResult['items'][0]['_element_type']);
        $this->assertEquals('select_box_option_element', $renderResult['items'][1]['_element_type']);

        $this->assertNotNull($renderResult['items'][0]['id']);
        $this->assertNotNull($renderResult['items'][1]['id']);

        $this->assertArrayNotHasKey('selected', $renderResult['items'][0]['attributes']);
        $this->assertEquals('1', $renderResult['items'][0]['attributes']['value']);
        $this->assertEquals('Test1', $renderResult['items'][0]['simpleValue']);

        $this->assertArrayNotHasKey('selected', $renderResult['items'][1]['attributes']);
        $this->assertEquals('2', $renderResult['items'][1]['attributes']['value']);
        $this->assertEquals('Test2', $renderResult['items'][1]['simpleValue']);
    }

    /**
     * @test
     */
    public function shouldProperRenderMultipleSelectElementOnSubmittedForm() : void
    {
        $_GET = array();

        $_GET[\Yumi\Bundler\View\Form\FormAbstract::FORM_NAME_FIELD] =
            \Yumi\Bundler\Driver\FormDriverManager::hashFormName('test');


        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form {
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldSelectBoxConverter;

            public $fieldControlConverters = array();

            public function __construct(string $formName)
            {
                parent::__construct($formName);

                $this->setMethod(\Yumi\Bundler\View\Form\Form::METHOD_GET);
            }

            public function getConverter() : callable
            {
                return $this->_registerFormFieldSelectBoxConverter();
            }
        };

        $converter = $converterObject->getConverter();

        $selectBoxField = new \Yumi\Bundler\View\Form\FormField\SelectBox\SelectBoxFormField(
            'test_select', \Yumi\Bundler\View\Form\FormFieldType::SELECT_BOX
        );

        $selectBoxField->setValue([ '1', '2' ]);

        $selectBoxField->setOptionValues([
            1 => [
                'label' => 'Test1',
                'selected' => true,
            ],
            2 => [
                'label' => 'Test2',
            ]
        ]);

        /**
         * @var \Yumi\Bundler\View\Shared\Clickable\SelectBoxElement $control
         */
        $control = $converter($selectBoxField);

        $renderResult = $control->render();

        $this->assertEquals('select_box_element', $renderResult['_element_type']);

        $this->assertArrayHasKey('name', $renderResult['attributes']);
        $this->assertEquals('test_select', $renderResult['attributes']['name']);

        $this->assertNotNull($renderResult['items']);

        $this->assertCount(2, $renderResult['items']);

        $this->assertEquals('select_box_option_element', $renderResult['items'][0]['_element_type']);
        $this->assertEquals('select_box_option_element', $renderResult['items'][1]['_element_type']);

        $this->assertNotNull($renderResult['items'][0]['id']);
        $this->assertNotNull($renderResult['items'][1]['id']);

        $this->assertArrayHasKey('selected', $renderResult['items'][0]['attributes']);
        $this->assertEquals('selected', $renderResult['items'][0]['attributes']['selected']);
        $this->assertEquals('1', $renderResult['items'][0]['attributes']['value']);
        $this->assertEquals('Test1', $renderResult['items'][0]['simpleValue']);

        $this->assertArrayHasKey('selected', $renderResult['items'][1]['attributes']);
        $this->assertEquals('selected', $renderResult['items']['1']['attributes']['selected']);
        $this->assertEquals('2', $renderResult['items'][1]['attributes']['value']);
        $this->assertEquals('Test2', $renderResult['items'][1]['simpleValue']);
    }

    /**
     * @test
     */
    public function shouldProperRenderMultipleSelectElementOnSubmittedFormNothingSelected() : void
    {
        $_GET = array();

        $_GET[\Yumi\Bundler\View\Form\FormAbstract::FORM_NAME_FIELD] =
            \Yumi\Bundler\Driver\FormDriverManager::hashFormName('test');


        $converterObject = new class('test') extends \Yumi\Bundler\View\Form\Form {
            use \Yumi\Bundler\View\Form\Extension\FieldControl\Converter\FormFieldSelectBoxConverter;

            public $fieldControlConverters = array();

            public function __construct(string $formName)
            {
                parent::__construct($formName);

                $this->setMethod(\Yumi\Bundler\View\Form\Form::METHOD_GET);
            }

            public function getConverter() : callable
            {
                return $this->_registerFormFieldSelectBoxConverter();
            }
        };

        $converter = $converterObject->getConverter();

        $selectBoxField = new \Yumi\Bundler\View\Form\FormField\SelectBox\SelectBoxFormField(
            'test_select', \Yumi\Bundler\View\Form\FormFieldType::SELECT_BOX
        );

        $selectBoxField->setValue([ ]);

        $selectBoxField->setOptionValues([
            1 => [
                'label' => 'Test1',
                'selected' => true,
            ],
            2 => [
                'label' => 'Test2',
            ]
        ]);

        /**
         * @var \Yumi\Bundler\View\Shared\Clickable\SelectBoxElement $control
         */
        $control = $converter($selectBoxField);

        $renderResult = $control->render();

        $this->assertEquals('select_box_element', $renderResult['_element_type']);

        $this->assertArrayHasKey('name', $renderResult['attributes']);
        $this->assertEquals('test_select', $renderResult['attributes']['name']);

        $this->assertNotNull($renderResult['items']);

        $this->assertCount(2, $renderResult['items']);

        $this->assertEquals('select_box_option_element', $renderResult['items'][0]['_element_type']);
        $this->assertEquals('select_box_option_element', $renderResult['items'][1]['_element_type']);

        $this->assertNotNull($renderResult['items'][0]['id']);
        $this->assertNotNull($renderResult['items'][1]['id']);

        $this->assertArrayNotHasKey('selected', $renderResult['items'][0]['attributes']);
        $this->assertEquals('1', $renderResult['items'][0]['attributes']['value']);
        $this->assertEquals('Test1', $renderResult['items'][0]['simpleValue']);

        $this->assertArrayNotHasKey('selected', $renderResult['items'][1]['attributes']);
        $this->assertEquals('2', $renderResult['items'][1]['attributes']['value']);
        $this->assertEquals('Test2', $renderResult['items'][1]['simpleValue']);
    }

}
