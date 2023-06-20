<?php

namespace App\Entity;

use App\Repository\FabricanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FabricanteRepository::class)]
class Fabricante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $fabricante = null;

    #[ORM\OneToMany(mappedBy: 'fk_fabricante', targetEntity: Producto::class)]
    private Collection $productos;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFabricante(): ?string
    {
        return $this->fabricante;
    }

    public function setFabricante(string $fabricante): static
    {
        $this->fabricante = $fabricante;

        return $this;
    }

    /**
     * @return Collection<int, Producto>
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(Producto $producto): static
    {
        if (!$this->productos->contains($producto)) {
            $this->productos->add($producto);
            $producto->setFkFabricante($this);
        }

        return $this;
    }

    public function removeProducto(Producto $producto): static
    {
        if ($this->productos->removeElement($producto)) {
            // set the owning side to null (unless already changed)
            if ($producto->getFkFabricante() === $this) {
                $producto->setFkFabricante(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->fabricante;
    }
}
