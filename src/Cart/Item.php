<?php

namespace Recruitment\Cart;

use Recruitment\Entity\Product;
use Recruitment\Cart\Exception\QuantityTooLowException;
use Recruitment\Exception\InvalidArgumentException;

class Item
{
    private $product;
    private $quantity;

    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        try {
            $this->setQuantity($quantity);
        } catch (QuantityTooLowException $e) {
            throw new InvalidArgumentException("Quantity Too Low");
        }
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return $this
     */
    public function setQuantity(int $quantity): Item
    {
        if ($quantity < $this->product->getMinimumQuantity()) {
            throw new QuantityTooLowException("Quantity Too Low");
        }
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPrice(): int
    {
        return $this->quantity * $this->product->getUnitPrice();
    }
}
