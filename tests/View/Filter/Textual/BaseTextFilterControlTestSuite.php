<?php

/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

use PHPUnit\Framework\TestCase;

class BaseTextFilterControlTestSuite extends TestCase
{
    protected function shouldReturnTrueOnNullValueTest(\Yumi\Bundler\View\Filter\FilterControl $filterControl) : void
    {
        $filterControl->setValue(null);

        $processResult = $filterControl->process();

        $this->assertEquals(true, $processResult);
    }

    protected function shouldReturnTrueOnEmptyValuesTest(\Yumi\Bundler\View\Filter\FilterControl $filterControl) : void
    {
        $filterControl->setValue(null);

        $this->assertEquals(true, $filterControl->process());

        $filterControl->setValue('');

        $this->assertEquals(true, $filterControl->process());

        $filterControl->setValue(false);

        $this->assertEquals(true, $filterControl->process());
    }

}