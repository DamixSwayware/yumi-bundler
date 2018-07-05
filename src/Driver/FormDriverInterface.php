<?php

namespace Yumi\Bundler\Driver;

interface FormDriverInterface
{
    public function getFieldValue(string $fieldName);

    public function setFieldValue(string $fieldName, $value);

    public function hasFieldValue(string $fieldName);
}
