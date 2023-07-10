<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Event;

class Location
{
    public function __construct(
        public readonly int     $id,
        public readonly ?string $name,
        public readonly bool    $geo,
        public readonly ?string $formattedAddress,
        public readonly ?float  $latitude,
        public readonly ?float  $longitude,
    )
    {
    }
}