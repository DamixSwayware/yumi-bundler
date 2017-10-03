<?php

/**
 * @Author Reverze <hawkmedia24@gmail.com>
 */

use PHPUnit\Framework\TestCase;

class MenuHeaderTest extends TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * @test
     */
    public function shouldRenderValidElement() : void
    {
        $menuHeader = new \Yumi\Bundler\View\Menu\MenuHeader();
        $menuHeader->setTitle(' example title ');
        $menuHeader->setSubTitle(' das');

        $header = $menuHeader->render();

        $this->assertArrayHasKey('title', $header);
        $this->assertArrayHasKey('subTitle', $header);

        $this->assertEquals('example title', $header['title']);
        $this->assertEquals('das', $header['subTitle']);
    }

}