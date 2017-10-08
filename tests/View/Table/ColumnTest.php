<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

use PHPUnit\Framework\TestCase;

class ColumnTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @test
     */
    public function shouldModifyValues() : void
    {
        $column = new \Yumi\Bundler\View\Table\Column();
        $column->setName('user.id');
        $column->setTitle("ID");
        $column->setSourceName('id');

        $sourceDataRow = [
            'id' => 4,
            'username' => 'John'
        ];

        $column->addModifier(function(&$value, array &$values){
             return $values['username'] . ' ' . strval($value);
        });

        $modifiedValue = $column->executeModifiers($sourceDataRow);

        $this->assertEquals('John 4', $modifiedValue);
    }

    /**
     * @test
     */
    public function shouldRenderWithoutErrors() : void
    {
        $column = new \Yumi\Bundler\View\Table\Column();
        $column->setName('user.id');
        $column->setTitle("ID");
        $column->setSourceName('id');

        $renderResult = $column->render();

        $this->assertArrayHasKey('column_title', $renderResult);
        $this->assertArrayHasKey('column_name', $renderResult);

        $this->assertEquals('ID', $renderResult['column_title']);
        $this->assertEquals('user.id', $renderResult['column_name']);
    }
}