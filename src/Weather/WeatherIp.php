<?php
namespace Aisa\Weather;
// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;
use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * Model class witch main responsability is handeling data for /vader
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
 class WeatherIp implements ContainerInjectableInterface
 {
     use ContainerInjectableTrait;
     public function validateIp($ipAddress)
     {
         if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
             return $ipAddress;
         }
         return null;
     }
 }
