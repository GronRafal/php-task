<?php

declare(strict_types=1);

namespace Recruitment\Tests\Entity;

use PHPUnit\Framework\TestCase;
use Recruitment\Entity\Product;
use Recruitment\Entity\Exception\InvalidUnitPriceException;
use Recruitment\Exception\InvalidArgumentException;

class ProductTest extends TestCase
{
    /**
     * @test
     */
    public function itThrowsExceptionForInvalidUnitPrice(): void
    {
        $this->expectException(InvalidUnitPriceException::class);
        $product = new Product();
        $product->setUnitPrice(0);
    }

    /**
     * @test
     */
    public function itThrowsExceptionForInvalidMinimumQuantity(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $product = new Product();
        $product->setMinimumQuantity(0);
    }
}
