<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Network;

use Nette\Http\Url;

class ClientOptions
{
    protected Url $url;

    public function __construct(
        protected readonly \GuzzleHttp\Client $client,
        string                                $url,
    )
    {
        $this->url = new Url($url);
    }

    public function getClient(): \GuzzleHttp\Client
    {
        return $this->client;
    }

    public function getUrl(): string
    {
        $path = $this->url->getPath();

        if (!str_ends_with($path, '/json')) {
            $path = rtrim($path, '/');
            $path = $path . '/json';
        }

        $this->url->setPath($path);

        return $this->url->getAbsoluteUrl();
    }
}