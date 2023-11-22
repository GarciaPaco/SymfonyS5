<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\NationaliteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NationaliteRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['actor:read']],
)]
class Nationalite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['actor:read', 'actor:write'])]
    private ?string $Origine = null;

    #[ORM\OneToMany(mappedBy: 'actorOrigine', targetEntity: Actor::class)]
    private Collection $actors;

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
