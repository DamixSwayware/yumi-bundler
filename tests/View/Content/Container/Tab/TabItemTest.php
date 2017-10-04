<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

use PHPUnit\Framework\TestCase;

class TabItemTest extends TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * @test
     */
    public function shouldRenderWithoutErrors() : void
    {
        $tabItem = new \Yumi\Bundler\View\Content\Container\Tab\TabItem();
        $tabItem->setTitle('  My first tab');
        $tabItem->setTooltipText('Tooltop for my first tab');

        $gridContainer = new \Yumi\Bundler\View\Content\Container\GridContainer();
        $tabItem->setContainer($gridContainer);

        $tabItem->setIsActiveState(true);

        $renderResult = $tabItem->render();

        $this->assertArrayHasKey('title', $renderResult);
        $this->assertArrayHasKey('tooltipText', $renderResult);
        $this->assertArrayHasKey('container', $renderResult);
        $this->assertArrayHasKey('is_active', $renderResult);

        $this->assertNotNull('container', $renderResult['container']);
        $this->assertEquals('My first tab', $renderResult['title']);
        $this->assertEquals('Tooltop for my first tab', $renderResult['tooltipText']);
        $this->assertEquals(true, $renderResult['is_active']);
    }
}