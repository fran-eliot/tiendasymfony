<?php

namespace App\Entity;

use App\Repository\PedidoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PedidoRepository::class)]
class Pedido
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\ManyToOne(inversedBy: 'pedidos')]
    #[ORM\JoinColumn(name: 'fk_cliente_id', referencedColumnName: 'id', nullable: false)]
    private ?Cliente $fk_cliente = null;

    #[ORM\ManyToMany(targetEntity: Producto::class,inversedBy:'pedidos')]
    private Collection $fk_producto;

    public function __construct()
    {
        $this->fk_producto = new ArrayCollection();
        $this->fecha =new \DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getFkCliente(): ?Cliente
    {
        return $this->fk_cliente;
    }

    public function setFkCliente(?Cliente $fk_cliente): static
    {
        $this->fk_cliente = $fk_cliente;

        return $this;
    }

    /**
     * @return Collection<int, Producto>
     */
    public function getFkProducto(): Collection
    {
        return $this->fk_producto;
    }

    public function addFkProducto(Producto $fkProducto): static
    {
        if (!$this->fk_producto->contains($fkProducto)) {
            $this->fk_producto->add($fkProducto);
        }

        return $this;
    }

    public function removeFkProducto(Producto $fkProducto): static
    {
        $this->fk_producto->removeElement($fkProducto);

        return $this;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
