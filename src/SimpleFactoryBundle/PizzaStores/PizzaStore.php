<?php

namespace SimpleFactoryBundle\PizzaStores;


use SimpleFactoryBundle\Pizzas\Pizza;

abstract class PizzaStore
{
    public function orderPizza(string $type)
    {
        $pizza = $this->createPizza($type);

        $pizza->prepare();
        $pizza->bake();
        $pizza->cut();
        $pizza->box();

        return $pizza;
    }

    abstract protected function createPizza(string $type): Pizza;
}