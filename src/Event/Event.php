<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Event;

use DateTimeImmutable;

class Event
{
    /**
     * @param Tag[] $tags
     */
    public function __construct(
        public readonly int               $id,
        public readonly string            $name,
        public readonly ?string           $description,
        public readonly DateTimeImmutable $start,
        public readonly DateTimeImmutable $end,
        public readonly EventType         $type,
        public readonly bool              $isActive,
        public readonly ?Location         $location,
        public readonly ?Organization     $organization,
        public readonly array             $tags,
        public readonly ?string           $externalAppointmentLink,
    ) {
    }

    public function isMultipleDays(): bool
    {
        return $this->start->format('dmY') !== $this->end->format('dmY');
    }

    public function hasTag(string $name): bool
    {
        foreach ($this->tags as $tag) {
            if ($tag->tag === $name) {
                return true;
            }
        }

        return false;
    }
}
