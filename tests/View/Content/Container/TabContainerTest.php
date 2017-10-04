<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

use PHPUnit\Framework\TestCase;

class TabContainerTest extends TestCase
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
        $tabContainer = new \Yumi\Bundler\View\Content\Container\TabContainer();

        $tabItemOne = $tabContainer->createTabItem();
        $tabItemOne->setId('tab1');
        $tabItemTwo = $tabContainer->createTabItem();
        $tabItemTwo->setId('tab2');

        $gridContainer = new \Yumi\Bundler\View\Content\Container\GridContainer();

        $tabItemOne->setTitle('My first tab');
        $tabItemOne->setContainer($gridContainer);

        $tabItemTwo->setTitle('My second tab');
        $tabItemTwo->setContainer($gridContainer);

        $renderResult = $tabContainer->render();

        $this->assertArrayHasKey('items', $renderResult);
        $this->assertArrayHasKey('orderedItems', $renderResult);

        $this->assertEmpty($renderResult['orderedItems']);
        $this->assertNotEmpty($renderResult['items']);

        $tabContainer->itemOrder([
            'tab2', 'tab1'
        ]);

        $renderResult = $tabContainer->render();

        $this->assertNotEmpty($renderResult['orderedItems']);
        $this->assertEmpty($renderResult['items']);
    }
}