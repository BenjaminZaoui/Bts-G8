<?php

namespace Apps\Exception;

class IncorrectPasswordException extends \Exception
{
    /**
     * @var string
     */
    protected $message = "Vos deux mots de passes doivent être identiques";

    protected $code = 1004;
}