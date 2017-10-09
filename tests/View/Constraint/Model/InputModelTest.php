<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

use PHPUnit\Framework\TestCase;

class InputModelTest extends TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    /**
     * @test
     * @expectedException \Yumi\Bundler\Constraint\Exception\PaginationException
     */
    public function shouldThrowExceptionOnNegativeLimitPagination(): void
    {
        $inputModel = new \Yumi\Bundler\Constraint\Input\Model\InputModel();
        $inputModel->addPagination('table-2322', -1, 2);
    }

    /**
     * @test
     * @expectedException \Yumi\Bundler\Constraint\Exception\PaginationException
     */
    public function shouldThrowExceptionOnNegativeOffsetPagination() : void
    {
        $inputModel = new \Yumi\Bundler\Constraint\Input\Model\InputModel();
        $inputModel->addPagination('table-2323', 5, -1);
    }

    /**
     * @test
     */
    public function shouldReturnNullOnNotExistingFiltersForObject() : void
    {
        $inputModel = new \Yumi\Bundler\Constraint\Input\Model\InputModel();

        $returnedValue = $inputModel->getFilters('dd');

        $this->assertEquals(null, $returnedValue);
    }

    /**
     * @test
     */
    public function shouldAddPaginationCriteriaWithoutExceptions() : void
    {
        $inputModel = new \Yumi\Bundler\Constraint\Input\Model\InputModel();
        $inputModel->addPagination('table-2334', 5, 5);

        $paginationCriteria = $inputModel->getPagination('table-2334');

        $this->assertArrayHasKey('limit', $paginationCriteria);
        $this->assertArrayHasKey('offset', $paginationCriteria);

        $this->assertEquals(5, $paginationCriteria['limit']);
        $this->assertEquals(5, $paginationCriteria['offset']);
    }


    /**
     * @test
     */
    public function shouldAddSortingCriteriaWithoutExceptions() : void
    {
        $inputModel = new \Yumi\Bundler\Constraint\Input\Model\InputModel();
        $inputModel->addSorting('table-2323', 'id', false);

        $sortingCriteria = $inputModel->getSorting('table-2323');

        $this->assertArrayHasKey('id', $sortingCriteria);
        $this->assertEquals(false, $sortingCriteria['id']);
    }

}