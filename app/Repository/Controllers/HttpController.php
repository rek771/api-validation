<?php

namespace Coolcigarets\ApiValidation\Repository\Controllers;

use Coolcigarets\ApiValidation\Entities\Exceptions\ValidateException;
use Coolcigarets\ApiValidation\UseCases\Rules\ClosedParentheses;
use Coolcigarets\ApiValidation\UseCases\Rules\EmptyString;
use Coolcigarets\ApiValidation\UseCases\ValidatorFactories\CheckEmailsFactory;
use Coolcigarets\ApiValidation\UseCases\ValidatorFactories\CheckParenthesesFactory;

class HttpController
{
    private string $callableName;
    private array $request;

    public function __construct()
    {
        // Take only the first part of the url as a postfix of the controller method
        $uri = ucwords(mb_strtolower(explode('/', $_SERVER['REQUEST_URI'])[1]));
        // REQUEST_METHOD controller method prefix
        $method = mb_strtolower($_SERVER['REQUEST_METHOD']);

        // Save callable and request
        $this->callableName = $method . $uri;
        $this->request = $_REQUEST;
    }

    /**
     * Запускает обработку запроса
     */
    public function run()
    {
        if (!in_array($this->callableName, get_class_methods($this))) {
            header('HTTP/1.1 404 Not Found');
            echo 'Not Found';
            exit;
        }

        try {
            $this->{$this->callableName}();
        } catch (ValidateException $exception) {
            header('HTTP/1.1 400 Bad Request');
            echo $exception->getMessage();
            exit;
        }
    }


    /**
     * Closed Parentheses Validation Page Method
     * @throws ValidateException
     */
    public function getHelp()
    {
        header('HTTP/1.1 200 OK');
        echo "You can make some operations:\n";
        echo "POST \\parentheses\n";
        echo "Params:\n";
        echo "text - text for check\n";
        echo "POST \\emails\n";
        echo "Params:\n";
        echo "text - json array of emails\n";
        exit;
    }

    /**
     * Closed Parentheses Validation Page Method
     * @throws ValidateException
     */
    public function postParentheses()
    {
        if (!in_array('text', array_keys($this->request))) {
            throw new ValidateException("Has no param 'text' in request");
        }

        try {
            $factory = new CheckParenthesesFactory($this->request['text']);
            $validator = $factory->make();
            $validator->validate();
        } catch (ValidateException $e) {
            header('HTTP/1.1 400 Bad Request');
            echo $e->getMessage();
            exit;
        }

        header('HTTP/1.1 200 OK');
        echo 'OK';
        exit;
    }

    /**
     * Closed Parentheses Validation Page Method
     * @throws ValidateException
     */
    public function postEmails()
    {
        if (!in_array('text', array_keys($this->request))) {
            throw new ValidateException("Has no param 'text' in request");
        }

        $emails = json_decode($this->request['text']);

        try {
            foreach ($emails as $email) {
                $factory = new CheckEmailsFactory($email);
                $validator = $factory->make();
                $validator->validate();
            }
        } catch (ValidateException $e) {
            header('HTTP/1.1 400 Bad Request');
            echo $e->getMessage();
            exit;
        }

        header('HTTP/1.1 200 OK');
        echo 'OK';
        exit;
    }
}