<?php

use PHPUnit\Framework\TestCase;

class SelectBoxElementTest extends TestCase
{
    /**
     * @test
     */
    public function shouldAddOptionElementWithoutException() : void
    {
        $selectBoxElement = new \Yumi\Bundler\View\Shared\Clickable\SelectBoxElement();

        $selectBoxElement->addOption((new \Yumi\Bundler\View\Shared\Clickable\SelectBox\OptionElement())
            ->setValue('volv')
            ->setLabel('Test')
        );

        $box = $selectBoxElement->getOption('volv');

        $this->assertEquals('Test', $box->getLabel());
    }

    /**
     * @test
     * @expectedException \Yumi\Bundler\View\Shared\Clickable\Exception\SelectBoxElementException
     */
    public function shouldThrowExceptionDuringAddingOptionElement() : void
    {
        $selectBoxElement = new \Yumi\Bundler\View\Shared\Clickable\SelectBoxElement();

        $selectBoxElement->addOption(new \Yumi\Bundler\View\Shared\Clickable\SelectBox\OptionElement());
    }

    /**
     * @test
     */
    public function shouldProperGenerateOptionElementsBasedOnArrayDefinition() : void
    {
        $selectBoxElement = new \Yumi\Bundler\View\Shared\Clickable\SelectBoxElement();

        $selectBoxElement->createOptions([
            'volv' => [
                'label' => 'Volv',
            ],
            'volks' => [
                'label' => 'Volks',
            ],
        ]);

        $box = $selectBoxElement->getOption('volv');

        $this->assertNotNull($box);
        $this->assertEquals('volv', $box->getValue());
        $this->assertEquals('Volv', $box->getLabel());

        $box = $selectBoxElement->getOption('volks');

        $this->assertNotNull($box);
        $this->assertEquals('volks', $box->getValue());
        $this->assertEquals('Volks', $box->getLabel());

    }
}