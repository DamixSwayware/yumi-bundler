<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

require_once('BaseTextFilterControlTestSuite.php');

class UrlTextFilterControlTest extends BaseTextFilterControlTestSuite
{
    /**
     * @test
     */
    public function shouldReturnTrueOnNullValue() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\UrlTextFilterControl();

        $this->shouldReturnTrueOnNullValueTest($filterControl);
    }

    /**
     * @test
     */
    public function shouldReturnTrueOnEmptyValues() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\UrlTextFilterControl();

        $this->shouldReturnTrueOnEmptyValuesTest($filterControl);
    }

    /**
     * @test
     */
    public function shouldReturnFalseOnInvalidUrl() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\UrlTextFilterControl();

        $filterControl->setValue('invalidvalue');

        $this->assertEquals(false, $filterControl->process());

        $filterControl->setValue('example.com?dasd');

        $this->assertEquals(false, $filterControl->process());
    }

    /**
     * @test
     */
    public function shouldReturnTrueOnValidUrl() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\UrlTextFilterControl();

        $filterControl->setValue('http://example.com/my-subpage');

        $this->assertEquals(true, $filterControl->process());
    }

}