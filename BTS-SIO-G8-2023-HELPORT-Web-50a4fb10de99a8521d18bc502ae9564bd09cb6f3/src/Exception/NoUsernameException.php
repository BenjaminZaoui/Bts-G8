<?php

namespace Apps\Exception;

class NoUsernameException extends \Exception
{
    /**
     * @var string
     */
    protected $message = "Veuillez entrer un identifiant";

    protected $code = 1001;
}