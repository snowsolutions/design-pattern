<?php
namespace Domains\Exception;

class UserEmailAlreadyExistException extends \Exception
{
    protected $code = 422;

    protected $message = 'User Email Already Exists';
}