<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

use PHPUnit\Framework\TestCase;

class CellTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();
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

        $sourceDataRow = [
            'id' => 4,
            'username' => 'John'
        ];

        $column->addModifier(function(&$value, array &$values){
            return $values['username'] . ' ' . strval($value);
        });

        $cell = new \Yumi\Bundler\View\Table\Cell($column);

        $cell->setSourceRowData($sourceDataRow);
        $cell->generateValue();

        $renderResult = $cell->render();

        $this->assertArrayHasKey('column_name', $renderResult);
        $this->assertArrayHasKey('cell_value', $renderResult);

        $this->assertEquals('user.id', $renderResult['column_name']);
        $this->assertEquals('John 4', $renderResult['cell_value']);
    }
}

