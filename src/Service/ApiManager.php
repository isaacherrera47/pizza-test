<?php

namespace App\Service;

use App\Entity\Order;
use App\Entity\Pizza;
use App\Entity\Topping;
use Doctrine\ORM\EntityManagerInterface;

class ApiManager
{

    /** @var EntityManagerInterface */
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        //TODO: Add validator class to validate asserts on entities.
        $this->manager = $manager;
    }

    /**
     * @param string $name
     *
     * @return Topping
     */
    public function storeTopping($name): Topping
    {
        $topping = new Topping($name);

        $this->manager->persist($topping);
        $this->manager->flush();

        return $topping;
    }

    /**
     * @param string $name
     * @param array $toppings
     *
     * @return Pizza
     */
    public function storePizza($name, $toppings): Pizza
    {
        $validToppings = $this->manager
                ->getRepository(Topping::class)
                ->findBy(['id' => $toppings]) ?? [];

        $pizza = new Pizza($name);
        $pizza->setToppings($validToppings);

        $this->manager->persist($pizza);
        $this->manager->flush();

        return $pizza;
    }

    /**
     * @param string $customer
     * @param array $pizzas
     * @param string|null $phone
     * @param int|null $id
     *
     * @return Order
     */
    public function storeOrder($customer, $pizzas, $phone = null, $id = null): Order
    {
        $validPizzas = $this->manager
            ->getRepository(Pizza::class)
            ->findBy(['id' => $pizzas]) ?? [];

        $isUpdate = !is_null($id);

        $order = $isUpdate ? $this->manager->getRepository(Order::class)->find($id) : new Order();
        $order->setCustomer($customer)->setPhone($phone)->setPizzas($validPizzas);

        if (!$isUpdate) {
            $this->manager->persist($order);
        }

        $this->manager->flush();

        return $order;
    }
}