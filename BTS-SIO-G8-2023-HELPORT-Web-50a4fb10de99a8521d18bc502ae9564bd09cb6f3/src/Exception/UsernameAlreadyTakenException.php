<?php

namespace Apps\Exception;

class UsernameAlreadyTakenException extends \Exception
{
    /**
     * @var string
     */
    protected $message = "Identifiant non disponible, veuillez en choisir un autre";

    protected $code = 1002;
}