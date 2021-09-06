<?php


namespace app\modules\api\services;

use Throwable;

class ValidateException extends \Exception
{
    private $validateErrors;

    public function __construct($errors = [], $code = 0, Throwable $previous = null)
    {
        $this->validateErrors = $errors;
        parent::__construct('', $code, $previous);
    }

    public function getValidateErrors()
    {
        $errors = [];
        foreach ($this->validateErrors as $key => $error) {
            $errors[$key] = reset($error);
        }
        return $errors;
    }
}