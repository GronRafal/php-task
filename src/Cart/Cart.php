<?php

namespace Recruitment\Cart;

use Recruitment\Entity\Order;
use Recruitment\Entity\Product;
use Recruitment\Exception\OutOfBoundsException;

class Cart implements \Countable
{
    private $items;
    private $item;

    /**
     * @param Product $product
     * @param int $quantity
     * @return $this
     */
    public function addProduct(Product $product, int $quantity = 1): Cart
    {
        $existingItem = false;
        if ($this->items) {
            foreach ($this->items as $item) {
                if ($item->getProduct()->getId() == $product->getId()) {
                    $existingItem = $item;
                }
            }
        }
        if ($existingItem) {
            $quantity += $existingItem->getQuantity();
            $existingItem->setQuantity($quantity);
        } else {
            $item = new Item($product, $quantity);
            $this->items[] = $item;
        }
        return $this;
    }

    /**
     * @param Product $product
     * @return $this
     */
    public function removeProduct(Product $product): Cart
    {
        if (empty($product)) {
            return $this;
        }

        foreach ($this->items as $key => $item) {
            if ($item->getProduct()->getId() == $product->getId()) {
                unset($this->items[$key]);
            }
        }
        $this->items = array_values($this->items);
        return $this;
    }

    public function setQuantity(Product $product, int $quantity): Cart
    {
        if ($this->items) {
            foreach ($this->items as $item) {
                if ($item->getProduct()->getId() == $product->getId()) {
                    $item->setQuantity($quantity);
                }
            }
        } else {
            $this->addProduct($product, $quantity);
        }
        return $this;
    }

    /**
     * @return \Countable
     */
    public function getItems(): array
    {
        return $this->count();
    }

    public function getItem(int $num): Item
    {
        if (!isset($this->items[$num])) {
            throw new OutOfBoundsException("Not existing item");
        }
        return $this->items[$num];
    }

    public function getTotalPrice(): int
    {
        $totalPrice = 0;
        if ($this->items) {
            foreach ($this->items as $item) {
                $totalPrice += $item->getTotalPrice();
            }
        }
        return $totalPrice;
    }

    public function count()
    {
        return $this->items;
    }

    public function checkout(int $num): Order
    {
        $order = new Order();
        $totalPrice = $this->getTotalPrice();
        foreach ($this->items as $item) {
            $items[] = array('id' => $item->getProduct()->getId(), 'quantity' => $item->getQuantity(),
                'total_price' => $item->getTotalPrice());
            $this->removeProduct($item->getProduct());
        }
        $array = array('id' => $num, 'items' => $items, 'total_price' => $totalPrice);
        $order->setData($array);
        return $order;
    }
}
