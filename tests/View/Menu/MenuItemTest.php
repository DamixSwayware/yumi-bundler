<?php

/**
 * @Author Reverze <hawkmedia24@gmail.com>
 */

use \PHPUnit\Framework\TestCase;

class MenuItemTest extends TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * @test
     */
    public function shouldRenderValidItem()
    {
        $menuItem = new \Yumi\Bundler\View\Menu\MenuItem();

        $menuItem->setTitle('Example link');
        $menuItem->setUri('/');
        $menuItem->setTooltipText('Example tooltip');

        $item = $menuItem->render();

        $this->assertArrayHasKey('title', $item);
        $this->assertArrayHasKey('uri', $item);
        $this->assertArrayHasKey('tooltipText', $item);
    }

}