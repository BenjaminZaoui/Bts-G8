<?php

namespace Apps\Exception;

class FullDemandeException extends \Exception
{
    /**
     * @var string
     */
    protected $message = "Vous avez le droit a 5 demande au maximum";

    protected $code = 1009;
}