<?php

namespace Apps\Controller;

use Apps\Core\Controller\Request;
use Apps\Core\View\TwigCore;
use Apps\Core\Controller\ControllerInterface;
use Apps\Entity\Etudiant;
use Apps\Exception\IncorrectPasswordException;
use Apps\Exception\NoPasswordException;
use Apps\Model\HomeModel;
use http\Exception\InvalidArgumentException;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use function PHPUnit\Framework\throwException;

class HomeController implements ControllerInterface
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function execute(Request $request)
    {
    }
}