<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Event;

enum EventType: int
{
    case Rehearsal = 1;
    case Gig = 2;
    case Other = 3;
    case RehearsalInPreparation = 4;
    case GigInPreparation = 5;
    case Information = 6;
}
