<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Network;

use Nette\Http\Url;
use Passchn\Konzertmeister\Event\EventType;

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

    public function withLimit(int $limit): static
    {
        $this->url->setQueryParameter('limit', $limit);

        return $this;
    }

    /**
     * Set a list of event types to include in the response.
     *
     * @see EventType
     *
     * @param list<EventType|int> $types
     * @return $this
     */
    public function withEventTypes(array $types): static
    {
        $types = array_map(
            static fn(EventType|int $type) => is_int($type) ? $type : $type->value,
            $types
        );

        $this->url->setQueryParameter('types', implode(',', $types));

        return $this;
    }

    /**
     * Set Tag/Category-IDs
     *
     * These are different for each account.
     *
     * @param list<int> $ids
     * @return $this
     */
    public function withTags(array $ids): static
    {
        $this->url->setQueryParameter('tags', implode(',', $ids));

        return $this;
    }
}