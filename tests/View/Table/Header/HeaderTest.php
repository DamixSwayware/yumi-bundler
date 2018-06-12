<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

class HeaderTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function shouldRenderHeaderWithSimpleText() : void
    {
        $tableHeader = new Yumi\Bundler\View\Table\Header\Header();

        $tableHeader->setTitle('example');

        $renderResult = $tableHeader->render();

        $this->assertEquals('example', $renderResult['innerElement']['elements'][0]['simpleValue']);
        $this->assertEquals('example', $tableHeader->getTitle());
    }

    /**
     * The header element should reset the title if
     * custom inner element was set
     * @test
     */
    public function shouldClearTitleOnSetCustomInnerElement() : void
    {
        $tableHeader = new \Yumi\Bundler\View\Table\Header\Header();

        $tableHeader->setTitle('example');

        $this->assertEquals('example', $tableHeader->getTitle());

        $tableHeader->setInnerElement(
            (new \Yumi\Bundler\View\Shared\Textual\TextElement())->setSimpleValue('test')
        );

        $this->assertNull($tableHeader->getTitle());
    }

    /**
     * @test
     */
    public function shouldRenderHeaderWithTextAndImage() : void
    {
        $tableHeader = new \Yumi\Bundler\View\Table\Header\Header();

        $tableHeader->setTitleWithImage('example', 'example.com/example.png');

        $renderResult = $tableHeader->render();

        $this->assertEquals('example.com/example.png',
            $renderResult['innerElement']['elements'][0]['imageSource']
        );
        $this->assertNull($renderResult['innerElement']['elements'][0]['imageDescription']);
        $this->assertEquals('example',
            $renderResult['innerElement']['elements'][1]['simpleValue']
        );

        unset($tableHeader);

        $tableHeader = new \Yumi\Bundler\View\Table\Header\Header();

        $tableHeader->setTitleWithImage('example', 'example.com/example.png', 'exampleDesc');

        $renderResult = $tableHeader->render();

        $this->assertEquals('example.com/example.png',
            $renderResult['innerElement']['elements'][0]['imageSource']
        );
        $this->assertEquals('exampleDesc', $renderResult['innerElement']['elements'][0]['imageDescription']);
        $this->assertEquals('example',
            $renderResult['innerElement']['elements'][1]['simpleValue']
        );

    }

    /**
     * The header should reset the title, image source url and image description
     * if custom inner element was set
     * @test
     */
    public function shouldClearTitleAndImageOptionsOnSetCustomInnerElement() : void
    {
        $tableHeader = new \Yumi\Bundler\View\Table\Header\Header();

        $tableHeader->setTitleWithImage('example', 'example.com/example.png');

        $this->assertEquals('example', $tableHeader->getTitle());
        $this->assertEquals('example.com/example.png', $tableHeader->getImageSource());
        $this->assertNull($tableHeader->getImageDescription());

        $tableHeader->setInnerElement(
            (new \Yumi\Bundler\View\Shared\Textual\TextElement())
            ->setSimpleValue('test')
        );

        $this->assertNull($tableHeader->getTitle());
        $this->assertNull($tableHeader->getImageSource());
        $this->assertNull($tableHeader->getImageDescription());
    }
}