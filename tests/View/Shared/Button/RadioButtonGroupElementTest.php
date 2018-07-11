<?php

use PHPUnit\Framework\TestCase;

/**
 * Class RadioButtonGroupElementTest
 * @author Reverze <hawkmedia24@gmail.com>
 *
 * This file is a part of YumiBundler
 *
 */
class RadioButtonGroupElementTest extends TestCase
{
    /**
     * @test
     */
    public function shouldProperRenderAddedButtons() : void
    {
        $groupElement = new \Yumi\Bundler\View\Shared\Button\RadioButtonGroupElement();

        $radioButtonElementOne = new \Yumi\Bundler\View\Shared\Button\RadioButtonElement();
        $radioButtonElementOne->setLabel('Male');
        $radioButtonElementOne->setName('gender');
        $radioButtonElementOne->setValue('m');

        $radioButtonElementTwo = new \Yumi\Bundler\View\Shared\Button\RadioButtonElement();
        $radioButtonElementTwo->setLabel('Female');
        $radioButtonElementTwo->setName('gender');
        $radioButtonElementTwo->setValue('f');

        $groupElement->addItem($radioButtonElementOne)->addItem($radioButtonElementTwo);

        $this->assertCount(2, $groupElement->getItems());

        $renderResult = $groupElement->render();

        $this->assertArrayHasKey('items', $renderResult);

        $this->assertEquals('Male', $renderResult['items'][0]['label']);
        $this->assertEquals('Female', $renderResult['items'][1]['label']);

        $this->assertEquals('gender', $renderResult['items'][0]['attributes']['name']);
        $this->assertEquals('gender', $renderResult['items'][1]['attributes']['name']);

        $this->assertEquals('m', $renderResult['items'][0]['attributes']['value']);
        $this->assertEquals('f', $renderResult['items'][1]['attributes']['value']);

    }

    /**
     * @test
     */
    public function shouldProperRenderGeneratedButtons() : void
    {
        $groupElement = new \Yumi\Bundler\View\Shared\Button\RadioButtonGroupElement();

        $groupElement->createItems('gender', [
            'm' => [
                'label' => 'Male',
            ],
            'f' => [
                'label' => 'Female',
            ],
        ]);


        $this->assertCount(2, $groupElement->getItems());

        $renderResult = $groupElement->render();

        $this->assertArrayHasKey('items', $renderResult);

        $this->assertEquals('Male', $renderResult['items'][0]['label']);
        $this->assertEquals('Female', $renderResult['items'][1]['label']);

        $this->assertEquals('gender', $renderResult['items'][0]['attributes']['name']);
        $this->assertEquals('gender', $renderResult['items'][1]['attributes']['name']);

        $this->assertEquals('m', $renderResult['items'][0]['attributes']['value']);
        $this->assertEquals('f', $renderResult['items'][1]['attributes']['value']);
    }
}