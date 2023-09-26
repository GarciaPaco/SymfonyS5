<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\NationaliteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: NationaliteRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['nationalite:read']],
)]
class Nationalite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['nationalite:read'])]
    private ?string $Origine = null;

    #[ORM\OneToMany(mappedBy: 'actorOrigine', targetEntity: Actor::class)]
    private ?Actor $Actors = null;
    private ArrayCollection $actors;

    public function __construct()
    {
        $this->actors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrigine(): ?string
    {
        return $this->Origine;
    }

    public function setOrigine(?string $Origine): static
    {
        $this->Origine = $Origine;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getActors(): ArrayCollection
    {
        return $this->actors;
    }

    public function addActor(Actor $actor): static
    {
        if (!$this->actors->contains($actor)) {
            $this->actors->add($actor);
            $actor->setActorOrigine($this);
        }

        return $this;
    }

    public function removeActor(Actor $actor): static
    {
        if ($this->actors->removeElement($actor)) {
            // set the owning side to null (unless already changed)
            if ($actor->getActorOrigine() === $this) {
                $actor->setActorOrigine(null);
            }
        }

        return $this;
    }


}

