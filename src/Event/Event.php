<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Event;

class Event
{
    public function __construct(
        public readonly int                $id,
        public readonly string             $name,
        public readonly ?string            $description,
        public readonly \DateTimeImmutable $start,
        public readonly \DateTimeImmutable $end,
        public readonly EventType          $type,
        public readonly bool               $isActive,
        public readonly ?Location          $location,
        public readonly ?Organization      $organization,
        public readonly array              $tags,
    ) {
    }

    public function isMultipleDays(): bool
    {
        return $this->start->format('dmY') !== $this->end->format('dmY');
    }
}
