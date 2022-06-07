<?php

namespace Recruitment\Entity;

use \Recruitment\Entity\Exception\InvalidUnitPriceException;
use Recruitment\Exception\InvalidArgumentException;

class Product
{
    private $id = 0;
    private $unitPrice;
    private $name;
    private $minimumQuantity = 1;


    /**
     * @param int $id
     * @return void
     */
    public function setId(int $id): Product
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $price
     * @return void
     */
    public function setUnitPrice(int $price): Product
    {
        if (empty($price)) {
            throw new InvalidUnitPriceException('Price must be greater than zero.');
        }
        $this->unitPrice = $price;
        return $this;
    }

    /**
     * @return int
     */
    public function getUnitPrice(): int
    {
        return $this->unitPrice;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName(string $name): Product
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param int $minimumQuantity
     * @return void
     */
    public function setMinimumQuantity(int $minimumQuantity): Product
    {
        if ($minimumQuantity < 1) {
            throw new InvalidArgumentException('Minimum quantity must be greater than zero.');
        }
        $this->minimumQuantity = $minimumQuantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getMinimumQuantity(): int
    {
        return $this->minimumQuantity;
    }
}
