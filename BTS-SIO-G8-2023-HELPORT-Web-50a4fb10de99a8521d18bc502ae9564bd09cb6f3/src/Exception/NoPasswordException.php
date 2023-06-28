<?php

namespace Apps\Exception;

class NoPasswordException extends \Exception
{
    /**
     * @var string
     */
    protected $message = "votre identifiant ou mot de passe est incorrect";

    protected $code = 1003;
}