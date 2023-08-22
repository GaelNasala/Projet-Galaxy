<?php
// src/Entity/Panier.php
namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Panier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Jeux")
     */
    private $jeux;

    // ... Autres propriétés et méthodes

    public function __construct()
    {
        $this->jeux = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJeux(): Collection
    {
        return $this->jeux;
    }

    public function addJeu(Jeux $jeu): self
    {
        if (!$this->jeux->contains($jeu)) {
            $this->jeux[] = $jeu;
        }

        return $this;
    }

    public function removeJeu(Jeux $jeu): self
    {
        $this->jeux->removeElement($jeu);

        return $this;
    }
}
