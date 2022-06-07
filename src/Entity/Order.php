<?php

namespace Recruitment\Entity;

use Recruitment\Cart\Cart;

class Order
{
    private $data = array();

    /**
     * @param mixed $data
     */
    public function setData($data): Order
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function getDataForView(): array
    {
        return $this->data;
    }
}
