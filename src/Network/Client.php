<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Network;

use Closure;
use GuzzleHttp\Exception\GuzzleException;
use Passchn\Konzertmeister\Event\Builder\JsonToEventList;
use Passchn\Konzertmeister\Event\Event;

class Client
{
    public function __construct(
        protected readonly ClientOptions $options,
    ) {
    }

    /**
     * @return list<Event>
     * @throws GuzzleException
     */
    public function fetch(?Closure $onConvertError = null): array
    {
        $response = $this->options->getClient()->get($this->options->getUrl());

        return JsonToEventList::convert(
            json: $response->getBody()->getContents(),
            onConvertError: $onConvertError,
        );
    }
}