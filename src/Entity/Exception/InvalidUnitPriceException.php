<?php

namespace Recruitment\Entity\Exception;

class InvalidUnitPriceException extends \Exception
{
    public function message(): string
    {
        return "error : " . $this->getMessage() . " in line no " . $this->getLine();
    }
}
