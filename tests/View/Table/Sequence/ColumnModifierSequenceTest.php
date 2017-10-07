<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

use PHPUnit\Framework\TestCase;

class ColumnModifierSequenceTest extends TestCase
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @test
     */
    public function shouldReturnModifiedValue()
    {
        $columnModifierSequence = new \Yumi\Bundler\View\Table\Sequence\ColumnModifierSequence();

        $sourceData = [
            'id' => 1,
            'username' => 'john'
        ];

        $columnModifierSequence->setSourceName('username');
        $columnModifierSequence->setSourceData($sourceData);

        $self = $this;

        $columnModifierSequence->addModifier(function(?string &$value, array $sourceData) use($self){
            $value = ucfirst($value);
            return $value;
        });

        $modifiedValue = $columnModifierSequence->execute();

        $this->assertEquals('John', $modifiedValue);
    }


}