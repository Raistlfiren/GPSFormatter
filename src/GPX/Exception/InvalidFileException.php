<?php

namespace Raistlfiren\GPS\GPX\Exception;


class InvalidFileException extends \Exception
{

    const FileDoesntExist = 0;
    const FileExtensionIncorrect = 1;
    const FileXMLInvalid = 2;

    public function __construct($message = '', $code = 0)
    {
        parent::__construct($message, $code);
    }

}