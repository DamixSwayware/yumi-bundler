<?php

spl_autoload_register(function(string $className){
   $className = str_replace('Yumi\Bundler\\', '', $className);
   $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);
   $className = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR .
       'src' . DIRECTORY_SEPARATOR . $className . '.php';

   if (file_exists($className)){
       require_once($className);
       return true;
   }

   return false;
});