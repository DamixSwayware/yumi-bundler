<?php
/**
 * @author Reverze <hawkmedia24@gmail.com>
 */

namespace Yumi\Bundler\Constraint\Input;

class Base64EncodedJsonInputDriver extends InputDriver
{
    private $parameters = array();

    private $onGetMethodParameterName = null;

    private $onPostMethodParameterName = null;

    public function __construct(array $parameters = array())
    {
        parent::__construct();

        $this->parseParameters($parameters);
    }

    private function parseParameters(array &$parameters = array()) : void
    {
        if (isset($parameters['GET'])){
            $this->onGetMethodParameterName = trim($parameters['GET']);
        }

        if (isset($parameters['POST'])){
            $this->onPostMethodParameterName = trim($parameters['POST']);
        }
    }

    private function loadInput()
    {

    }


    public function & fetch() : array
    {

    }

}
