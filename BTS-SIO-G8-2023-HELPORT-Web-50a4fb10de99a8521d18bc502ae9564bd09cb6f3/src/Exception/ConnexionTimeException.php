<?php

namespace Apps\Exception;

class ConnexionTimeException extends \Exception
{
    /**
     * @var string
     */
    protected $message = "Vous êtes restez trop longtemps inactif";

    protected $code = 1008;
}