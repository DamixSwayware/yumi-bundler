<?php

namespace Yumi\Bundler\Driver;

use Yumi\Bundler\View\Form\Form;

class FormDriverManager
{
    private static $formDriverManager =  null;

    /**
     * @var string|null
     */
    private $defaultFormDriverClass = null;

    private function __construct()
    {
        $this->setDefaultFormDriver(SimpleFormDriver::class);
    }

    public static function getManager() : FormDriverManager
    {
        if (self::$formDriverManager === null){
            self::$formDriverManager = new FormDriverManager();
        }

        return self::$formDriverManager;
    }

    public function setDefaultFormDriver(string $formDriverClass) : self
    {
        $this->defaultFormDriverClass = $formDriverClass;

        return $this;
    }

    public function createFromDefaultFromDriver(Form $form) : FormDriverInterface
    {
        return new $this->defaultFormDriverClass($form);
    }
}