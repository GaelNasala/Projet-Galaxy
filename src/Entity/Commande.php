<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="float")
     */
    private $montant_total;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Adresse_de_livraison;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMontant(): ?float
    {
        return $this->montant_total;
    }

    public function setMontant(float $montant_total): self
    {
        $this->montant_total = $montant_total;

        return $this;
    }

    public function getAdresseDeLivraison(): ?string
    {
        return $this->Adresse_de_livraison;
    }

    public function setAdresseDeLivraison(string $Adresse_de_livraison): self
    {
        $this->Adresse_de_livraison = $Adresse_de_livraison;

        return $this;
    }
}
