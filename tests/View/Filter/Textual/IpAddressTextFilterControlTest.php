<?php

/**
 * This file is a part of YumiBundler
 *
 * @Author Reverze <hawkmedia24@gmail.com>
 */

require_once('BaseTextFilterControlTestSuite.php');

class IpAddressTextFilterControlTest extends BaseTextFilterControlTestSuite
{
    /**
     * @test
     */
    public function shouldReturnTrueOnNullValue() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\IpAddressTextFilterControl();

        $this->shouldReturnTrueOnNullValueTest($filterControl);
    }

    /**
     * @test
     */
    public function shouldReturnTrueOnEmptyValues() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\IpAddressTextFilterControl();

        $this->shouldReturnTrueOnEmptyValuesTest($filterControl);
    }

    /**
     * @test
     */
    public function shouldReturnFalseOnInvalidIpAddress() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\IpAddressTextFilterControl();

        $filterControl->setValue('test.23');

        $this->assertEquals(false, $filterControl->process());

        $filterControl->setValue('422.212.211.211');

        $this->assertEquals(false, $filterControl->process());

        $filterControl->setValue('0.0.0.256');

        $this->assertEquals(false, $filterControl->process());
    }

    /**
     * @test
     */
    public function shouldReturnTrueOnValidIpAddress() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\IpAddressTextFilterControl();

        $filterControl->setValue('192.168.1.1');

        $this->assertEquals(true, $filterControl->process());

        $filterControl->setValue('0.0.0.0');

        $this->assertEquals(true, $filterControl->process());

        $filterControl->setValue('255.255.255.255');

        $this->assertEquals(true, $filterControl->process());
    }

}