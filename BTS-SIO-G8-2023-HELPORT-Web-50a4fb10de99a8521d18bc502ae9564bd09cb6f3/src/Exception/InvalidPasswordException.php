<?php

namespace Apps\Exception;

class InvalidPasswordException extends \Exception
{
    /**
     * @var string
     */
    protected $message = "Votre mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial";

    protected $code = 1006;
}