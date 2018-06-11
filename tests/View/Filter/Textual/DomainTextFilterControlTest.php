<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

require_once('BaseTextFilterControlTestSuite.php');

class DomainTextFilterControlTest extends BaseTextFilterControlTestSuite
{
    /**
     * @test
     */
    public function shouldReturnTrueOnNullValue() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\DomainTextFilterControl();

        $this->shouldReturnTrueOnNullValueTest($filterControl);
    }

    /**
     * @test
     */
    public function shouldReturnTrueOnEmptyValues() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\DomainTextFilterControl();

        $this->shouldReturnTrueOnEmptyValuesTest($filterControl);
    }

    public function shouldReturnFalseOnInvalidDomain() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\DomainTextFilterControl();

        $filterControl->setValue('dasdas');

        $this->assertEquals(false, $filterControl->process());

        $filterControl->setValue('dasd@das');

        $this->assertEquals(false, $filterControl->process());
    }

    public function shouldReturnTrueOnValidDomain() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\DomainTextFilterControl();

        $filterControl->setValue('example.com');

        $this->assertEquals(true, $filterControl->process());

        $filterControl->setValue('subdomain1.example.com');

        $this->assertEquals(true, $filterControl->process());
    }
}