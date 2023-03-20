<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
* Error Handle calss
*/
class |UNIQUESTRING|ErrorHandle
{

    /**
    * Error name
    */
    // public $|uniquestring|_error_name = '';    

    /**
    * has error
    */
    public $errorInstance = true;
    
    public function classAttributesError( $className, $method )
    {

        // if class not exists display an error
        if( class_exists( $className ) ) {

            // check if method exists
            $classInstance = new $className();

            // if method not exists display an error
            if( ! method_exists( $classInstance, $method ) ) {

                // notice of error
                $errorNotice = "The <b>\"{$className}\"</b> class doesn't contain the <b>\"{$method}\"</b> method.";

                // show an error
                $errorMethodInstance = new |UNIQUESTRING|DisplayError( $errorNotice );

                $errorMethodInstance->showError();

                $this->errorInstance = $errorNotice;

            }

        } else {

            // notice of error
            $errorNotice = "The <b>\"{$className}\"</b> class not exists.";

            // show an error
            $errorClassInstance = new |UNIQUESTRING|DisplayError( $errorNotice );

            $errorClassInstance->showError();

            $this->errorInstance = $errorNotice;

        }
    
        // 
        return $this->errorInstance;

    }
    
}
