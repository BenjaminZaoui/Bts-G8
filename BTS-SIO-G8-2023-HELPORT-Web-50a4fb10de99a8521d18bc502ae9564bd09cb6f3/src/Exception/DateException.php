<?php

namespace Apps\Exception;

class DateException extends \Exception
{
    /**
     * @var string
     */
    protected $message = "Veuillez choisir une date qui n est pas déjà passé";

    protected $code = 1011;
}