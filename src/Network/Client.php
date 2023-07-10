<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Network;

use Psr\Http\Message\ResponseInterface;

class Client
{
    public function __construct(
        protected readonly ClientOptions $options,
    )
    {
    }

    public function fetch(): ResponseInterface
    {
        return $this->options->getClient()->get($this->options->getUrl());
    }
}