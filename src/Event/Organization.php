<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Event;

class Organization
{
    public function __construct(
        public readonly int     $id,
        public readonly string  $name,
        public readonly ?string $parentName,
        public readonly ?string $imageUrl,
    )
    {
    }
}