<?php

declare(strict_types=1);

namespace Setono\SyliusBulkSpecialsPlugin\Model;

use DateTime;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\ChannelsAwareInterface;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;

interface SpecialInterface extends ChannelsAwareInterface, CodeAwareInterface, TimestampableInterface, ResourceInterface
{
    public function __toString(): string;

    public function getMultiplier(): float;

    public function isSpecialActiveAt(DateTime $now): bool;

    /**
     * @return string[]
     */
    public function getChannelCodes(): array;

    public function getName(): ?string;

    public function setName(?string $name): void;

    public function getDescription(): ?string;

    public function setDescription(?string $description): void;

    public function getPriority(): int;

    public function setPriority(?int $priority): void;

    public function isExclusive(): bool;

    public function setExclusive(bool $exclusive): void;

    public function getStartsAt(): ?DateTimeInterface;

    public function setStartsAt(?DateTimeInterface $startsAt): void;

    public function getEndsAt(): ?DateTimeInterface;

    public function setEndsAt(?DateTimeInterface $endsAt): void;

    public function isEnabled(): bool;

    public function setEnabled(bool $enabled): void;

    /**
     * @return Collection|SpecialRuleInterface[]
     */
    public function getRules(): Collection;

    public function hasRules(): bool;

    public function hasRule(SpecialRuleInterface $rule): bool;

    public function addRule(SpecialRuleInterface $rule): void;

    public function removeRule(SpecialRuleInterface $rule): void;

    public function getActionType(): string;

    public function setActionType(string $actionType): void;

    public function getActionPercent(): float;

    public function setActionPercent(float $actionPercent): void;
}
