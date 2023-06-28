<?php

namespace Apps\Exception;

class SameUsernameException extends \Exception
{
    /**
     * @var string
     */
    protected $message = "un compte a déjà été crée a partir de votre identifiant ecole directe";

    protected $code = 1005;
}