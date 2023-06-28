<?php

namespace Apps\Exception;

class ConnexionException extends \Exception
{
    /**
     * @var string
     */
    protected $message = "Veuillez d'abors vous connecter";

    protected $code = 1007;
}