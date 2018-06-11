<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

use PHPUnit\Framework\TestCase;

require_once('BaseTextFilterControlTestSuite.php');

class EmailTextFilterControlTest extends BaseTextFilterControlTestSuite
{
    /**
     * @test
     */
    public function shouldReturnTrueOnNullValue() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\EmailTextFilterControl();

        $this->shouldReturnTrueOnNullValueTest($filterControl);
    }

    /**
     * @test
     */
    public function shouldReturnTrueOnEmptyValues() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\EmailTextFilterControl();

        $this->shouldReturnTrueOnEmptyValuesTest($filterControl);
    }

    /**
     * @test
     */
    public function shouldReturnFalseOnInvalidEmailAddress() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\EmailTextFilterControl();

        $filterControl->setValue('test');

        $this->assertEquals(false, $filterControl->process());

        $filterControl->setValue('1');
        
        $this->assertEquals(false, $filterControl->process());

        $filterControl->setValue('test@');

        $this->assertEquals(false, $filterControl->process());

        $filterControl->setValue('test@test');

        $this->assertEquals(false, $filterControl->process());
    }

    public function shouldReturnTrueOnValidEmailAddress() : void
    {
        $filterControl = new \Yumi\Bundler\View\Filter\Textual\EmailTextFilterControl();

        $filterControl->setValue('test@example.com');

        $this->assertEquals(true, $filterControl->process());

        $filterControl->setValue('my.user.name@example.com');

        $this->assertEquals(true, $filterControl->process());
    }
    
}