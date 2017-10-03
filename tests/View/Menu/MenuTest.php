<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

use PHPUnit\Framework\TestCase;

class MenuTest extends TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * @test
     */
    public function shouldRenderEmptyMenu() : void
    {
        $menu = new \Yumi\Bundler\View\Menu\Menu();

        $menuRenderResult = $menu->render();

        $this->assertArrayHasKey('position', $menuRenderResult);
        $this->assertArrayHasKey('header', $menuRenderResult);
        $this->assertArrayHasKey('items', $menuRenderResult);

        $this->assertEquals(Yumi\Bundler\View\Menu\Menu::POSITION_LEFT, $menuRenderResult['position']);
        $this->assertNull($menuRenderResult['header']);
        $this->assertEmpty($menuRenderResult['items']);
    }

    /**
     * @test
     */
    public function shouldRenderMenuWithHeader() : void
    {
        $menu = new \Yumi\Bundler\View\Menu\Menu();

        $header = $menu->createHeader();
        $header->setTitle('Example header');

        $menuRenderResult = $menu->render();
        $this->assertNotNull($menuRenderResult['header']);
    }

    /**
     * @test
     */
    public function shouldRenderMenuWithHeaderAndItems() : void
    {
        $menu = new \Yumi\Bundler\View\Menu\Menu();

        $header = $menu->createHeader();
        $header->setTitle('Example header');

        for($i = 0; $i <= 3; $i++){
            $item = $menu->createItem();
            $item->setTitle('Menu Item #' . strval($i));
        }

        $menuRenderResult = $menu->render();

        $this->assertNotNull($menuRenderResult['header']);
        $this->assertNotEmpty($menuRenderResult['items']);

    }
}