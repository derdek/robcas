<?php

namespace App\Entity;

use App\Repository\CardRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Index(name: 'card_type_index', columns: ['card_type'],flags: ['btree'])]
#[ORM\Entity(repositoryClass: CardRepository::class)]
class Card
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 63)]
    private ?string $title = null;

    // treasure or room
    #[ORM\Column(length: 31)]
    private ?string $card_type = null;

    // monster, change class/race, weapon, armor, curse
    #[ORM\Column(length: 31)]
    private ?string $card_action = null;

    // description of the card
    #[ORM\Column(length: 255)]
    private ?string $description = null;

    // field with monster level
    #[ORM\Column(type: 'integer')]
    private ?int $level = null;

    //field with monster level reward
    #[ORM\Column(type: 'integer')]
    private ?int $level_reward = null;

    //field with monster treasure reward
    #[ORM\Column(type: 'integer')]
    private ?int $treasure_reward = null;

    //field with monster description when you lose fight with monster
    #[ORM\Column(length: 255)]
    private ?string $lose_description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCardType(): ?string
    {
        return $this->card_type;
    }

    public function setCardType(string $card_type): static
    {
        $this->card_type = $card_type;

        return $this;
    }

    public function getCardAction(): ?string
    {
        return $this->card_action;
    }

    public function setCardAction(string $card_action): static
    {
        $this->card_action = $card_action;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getLevelReward(): ?int
    {
        return $this->level_reward;
    }

    public function setLevelReward(int $level_reward): static
    {
        $this->level_reward = $level_reward;

        return $this;
    }

    public function getTreasureReward(): ?int
    {
        return $this->treasure_reward;
    }

    public function setTreasureReward(int $treasure_reward): static
    {
        $this->treasure_reward = $treasure_reward;

        return $this;
    }

    public function getLoseDescription(): ?string
    {
        return $this->lose_description;
    }

    public function setLoseDescription(string $lose_description): static
    {
        $this->lose_description = $lose_description;

        return $this;
    }
}
