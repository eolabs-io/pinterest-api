<?php

namespace EolabsIo\PinterestApi\Tests\Factories;

use EolabsIo\PinterestApi\Tests\Factories\Contracts\FactoryInterface;

abstract class BaseFactory implements FactoryInterface
{
    public static function new(): self
    {
        return new static();
    }
}
