<?php

namespace App\Entity;


use App\Repository\ProductoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ProductoRepository::class)]
class Producto
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $producto = null;

    #[ORM\Column]
    private ?float $precio = null;

    #[ORM\ManyToOne(inversedBy: 'productos')]
    #[ORM\JoinColumn(name: 'fk_fabricante_id', referencedColumnName: 'id', nullable: false)]
    private ?Fabricante $fk_fabricante = null;

    #[ORM\ManyToMany(targetEntity: Pedido::class, mappedBy: 'producto')]
    private Collection $pedidos;

    public function __construct()
    {
        $this->pedidos = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProducto(): ?string
    {
        return $this->producto;
    }

    public function setProducto(string $producto): static
    {
        $this->producto = $producto;

        return $this;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): static
    {
        $this->precio = $precio;

        return $this;
    }

    public function getFkFabricante(): ?Fabricante
    {
        return $this->fk_fabricante;
    }

    public function setFkFabricante(?Fabricante $fk_fabricante): static
    {
        $this->fk_fabricante = $fk_fabricante;

        return $this;
    }

    public function __toString(): string
    {
        return $this->fk_fabricante." ".$this->producto;
    }
    //añadidos por mi 
    /**
     * @return Collection<int, Pedido>
     */
    
}
