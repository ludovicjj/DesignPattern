<?php


namespace App\DependencyInjection\Exception;

use Exception;
use Psr\Container\ContainerExceptionInterface;

class ContainerException extends Exception implements ContainerExceptionInterface
{

}