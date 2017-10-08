<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

use PHPUnit\Framework\TestCase;

class TableTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @test
     */
    public function shouldRenderWithoutErrors()
    {
        $sourceData = [
            [
                'id' => 4,
                'username' => 'John'
            ],
            [
                'id' => 5,
                'username' => 'Johny'
            ]
        ];

        $table = new \Yumi\Bundler\View\Table\Table();

        $table->declareColumn('user.id','ID', 'id');
        $table->declareColumn('user.username', 'Nazwa uzytkownika', 'username');

        $table->addColumnModifier('user.id', function(&$value, array &$values = array()){
            return $values['username'] . ' ' . strval($value);
        });

        $table->setTotalAmountOfRows(sizeof($sourceData));
        $table->setSourceData($sourceData);

        $renderResult = $table->render();

        $this->assertArrayHasKey('total_rows', $renderResult);
        $this->assertArrayHasKey('columns', $renderResult);
        $this->assertArrayHasKey('rows', $renderResult);

        $this->assertEquals(2, $renderResult['total_rows']);
        $this->assertCount(2, $renderResult['rows']);
        $this->assertCount(2, $renderResult['columns']);

    }

    /**
     * @test
     * @expectedException \Yumi\Bundler\View\Table\Exception\TableException
     */
    public function shouldThrowExceptionOnEmptyColumnName()
    {
        $table = new \Yumi\Bundler\View\Table\Table();

        $table->declareColumn('', 'ID', null);
    }

    /**
     * @test
     * @expectedException \Yumi\Bundler\View\Table\Exception\TableException
     */
    public function shouldThrowExceptionOnEmptyColumnTitle()
    {
        $table = new \Yumi\Bundler\View\Table\Table();

        $table->declareColumn('user.id', '', null);
    }

    /**
     * @test
     * @expectedException \Yumi\Bundler\View\Table\Exception\TableException
     */
    public function shouldThrowExceptionWhenColumnObjectDoesNotHaveDefinedColumnName()
    {
        $column = new \Yumi\Bundler\View\Table\Column();
        $column->setTitle('ID');

        $table = new \Yumi\Bundler\View\Table\Table();
        $table->addColumn($column);
    }

    /**
     * @test
     * @expectedException \Yumi\Bundler\View\Table\Exception\TableException
     */
    public function shouldThrowExceptionWhenColumnObjectDoesNotHaveDefinedColumnTitle()
    {
        $column = new \Yumi\Bundler\View\Table\Column();
        $column->setName('user.id');

        $table = new \Yumi\Bundler\View\Table\Table();
        $table->addColumn($column);
    }
}