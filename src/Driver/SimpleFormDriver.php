<?php

namespace Yumi\Bundler\Driver;

class SimpleFormDriver extends FormDriverAbstract
{
    /**
     * Gets field value
     * @param string $fieldName
     */
    public function getFieldValue(string $fieldName)
    {
        if (isset($_GET[$fieldName])){
            return $_GET[$fieldName];
        }

        return null;
    }

    public function setFieldValue(string $fieldName, $value): self
    {
        $_GET[$fieldName] = $fieldName;

        return $this;
    }

    public function hasFieldValue(string $fieldName)
    {
        return isset($_POST[$fieldName]);
    }

}