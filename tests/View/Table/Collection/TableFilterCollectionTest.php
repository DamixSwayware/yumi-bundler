<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

use PHPUnit\Framework\TestCase;

class TableFilterCollectionTest extends TestCase
{
    /**
     * @test
     */
    public function shouldReturnsEmptyArrayOnNonDefinedFilters() : void
    {
        $collection = new \Yumi\Bundler\View\Table\Collection\TableFilterCollection();

        $filters = $collection->getColumnFilters('column');

        $this->assertCount(0, $filters);
    }

    /**
     * @test
     */
    public function shouldReturnsAllDefinedFilters() : void
    {
        $collection = new \Yumi\Bundler\View\Table\Collection\TableFilterCollection();

        $collection->addColumnFilter('column', new \Yumi\Bundler\View\Filter\Textual\PrimaryTextFilterControl());
        $collection->addColumnFilter('column', new \Yumi\Bundler\View\Filter\Textual\EmailTextFilterControl());

        $filters = $collection->getColumnFilters('column');

        $this->assertCount(2, $filters);

        $this->assertInstanceOf(\Yumi\Bundler\View\Filter\Textual\PrimaryTextFilterControl::class, \array_shift($filters));
        $this->assertInstanceOf(\Yumi\Bundler\View\Filter\Textual\EmailTextFilterControl::class, \array_shift($filters));
    }
}