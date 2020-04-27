<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PizzaRepository")
 */
class Pizza
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Topping")
     */
    private $toppings;

    public function __construct($name)
    {
        $this->toppings = new ArrayCollection();
        $this->name = $name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Topping[]
     */
    public function getToppings(): Collection
    {
        return $this->toppings;
    }

    public function addTopping(Topping $topping): self
    {
        if (!$this->toppings->contains($topping)) {
            $this->toppings[] = $topping;
        }

        return $this;
    }

    public function setToppings($toppings): self
    {
        $this->toppings = $toppings;

        return $this;
    }

    public function removeTopping(Topping $topping): self
    {
        if ($this->toppings->contains($topping)) {
            $this->toppings->removeElement($topping);
        }

        return $this;
    }
}
