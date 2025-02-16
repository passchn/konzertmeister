<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister\Export;

use Passchn\Konzertmeister\Event\Event;

class DefaultFormatter implements FormatterInterface
{
    public function formattedAddress(Event $event): ?string
    {
        return $event->location?->formattedAddress;
    }
}