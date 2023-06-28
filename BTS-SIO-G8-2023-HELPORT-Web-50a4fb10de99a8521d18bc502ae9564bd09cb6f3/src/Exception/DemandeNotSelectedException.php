<?php

namespace Apps\Exception;

class DemandeNotSelectedException extends \Exception
{
    /**
     * @var string
     */
    protected $message = "Veuillez selectionner une demande";

    protected $code = 1012;
}