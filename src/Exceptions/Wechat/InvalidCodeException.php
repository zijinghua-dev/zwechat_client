<?php
namespace Zijinghua\Zwechat\Client\Exceptions\Wechat;

class InvalidCodeException extends \Exception
{
    public $data = [];

    public function __construct($message = "", $data = [], $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->data;
    }
}
