<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ActorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ActorRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['actor:read']],
    denormalizationContext: ['groups' => ['actor:write']],
)]
class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['actor:read', 'actor:write'])]
    #[Assert\NotBlank(message: 'Le prénom est obligatoire')]
    #[ApiFilter(SearchFilter::class, strategy: 'partial')]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    #[Groups(['actor:read', 'actor:write'])]
    private ?string $lastName = null;

    #[ORM\ManyToOne(cascade: ['persist'], inversedBy: 'actors')]
    #[Groups(['actor:read','actor:write'])]
    private ?Nationalite $actorOrigine = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): static
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): static
    {
        $this->lastName = $lastName;

        return $this;
    }
    public function getActorOrigine(): ?Nationalite
    {
        return $this->actorOrigine;
    }

    public function setActorOrigine(?Nationalite $nationalite): static
    {
        $this->actorOrigine = $nationalite;

        return $this;
    }
}
