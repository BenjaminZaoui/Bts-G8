<?php

namespace Apps\Exception;

class fieldsNotFilledException extends \Exception
{
    /**
     * @var string
     */
    protected $message = "Tout les champs doivent être rempli";

    protected $code = 1010;
}