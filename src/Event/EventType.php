<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Event;

use InvalidArgumentException;

enum EventType: int
{
    case Rehearsal = 1;
    case Gig = 2;
    case Other = 3;
    case RehearsalInPreparation = 4;
    case GigInPreparation = 5;
    case Information = 6;

    public function getLocalName(string $lang = 'de'): string
    {
        return match ($lang) {
            'de' => match ($this) {
                EventType::Rehearsal => 'Probe',
                EventType::Gig => 'Auftritt',
                EventType::Other => 'Anderes',
                EventType::RehearsalInPreparation => 'Probenanfrage',
                EventType::GigInPreparation => 'Auftrittsanfrage',
                EventType::Information => 'Information',
            },
            default => throw new InvalidArgumentException('unknown language'),
        };
    }
}
