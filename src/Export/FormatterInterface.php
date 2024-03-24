<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister\Export;

use Passchn\Konzertmeister\Event\Event;

interface FormatterInterface
{
    public function formattedAddress(Event $event): ?string;
}