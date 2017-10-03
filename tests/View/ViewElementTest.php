<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

use PHPUnit\Framework\TestCase;

class ExampleViewElement extends \Yumi\Bundler\View\ViewElement
{

}

class ViewElementTest extends TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * @test
     */
    public function shouldValidRenderElement() : void
    {
        $element = new \ExampleViewElement();

        $element->setId('das');
        $element->addClass('hover-link');
        $element->addStyle('color', 'black');
        $element->addAttribute('href', '/');
        $element->addDataAttribute('id', 'test');

        $item = $element->render();

        $this->assertArrayHasKey('id', $item);
        $this->assertArrayHasKey('classes', $item);
        $this->assertArrayHasKey('styles', $item);
        $this->assertArrayHasKey('attributes', $item);
        $this->assertArrayHasKey('dataAttributes', $item);

        $this->assertEquals('das', $item['id']);
        $this->assertArraySubset(['hover-link'], $item['classes']);
        $this->assertArraySubset([ 'color' => 'black' ], $item['styles']);
        $this->assertArraySubset([ 'href' => '/'], $item['attributes']);
        $this->assertArraySubset([ 'id' => 'test'], $item['dataAttributes']);
    }
}