<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

use PHPUnit\Framework\TestCase;

class RowTest extends TestCase
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
        $columnUserId = new \Yumi\Bundler\View\Table\Column();
        $columnUserId->setName('user.id');
        $columnUserId->setTitle("ID");
        $columnUserId->setSourceName('id');

        $columnUserName = new \Yumi\Bundler\View\Table\Column();
        $columnUserName->setName('user.username');
        $columnUserName->setTitle('Nazwa użytkownika');
        $columnUserName->setSourceName('username');

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

        $columnContainer = [
            'user.id' => $columnUserId,
            'user.username' => $columnUserName,
        ];

        $row = new \Yumi\Bundler\View\Table\Row(
            1, $columnContainer, $sourceData[0], $sourceData
        );

        $renderResult = $row->render();

        $this->assertArrayHasKey('row_number', $renderResult);
        $this->assertArrayHasKey('cells', $renderResult);
        $this->assertCount(2, $renderResult['cells']);


        foreach($renderResult['cells'] as &$cell){
            $this->assertArrayHasKey('column_name', $cell);
            $this->assertArrayHasKey('cell_value', $cell);
        }

    }
}
