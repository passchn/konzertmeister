<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Event;

class Tag
{
    public function __construct(
        public readonly int $id,
        public readonly string $tag,
        public readonly string $color,
    ) {
    }
}