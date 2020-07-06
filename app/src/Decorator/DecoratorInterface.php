<?php

namespace App\Decorator;

interface DecoratorInterface
{
    /**
     *  Apply changes to an object
     */
    public function applyTo(object $object): object;

    /**
     *  Revert changes to an object
     */
    public function revertTo(object $object): object;
}
