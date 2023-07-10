<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Event\Builder;

use Exception;
use Passchn\Konzertmeister\Event\Event;
use Passchn\Konzertmeister\Event\EventType;
use Passchn\Konzertmeister\Event\Location;
use Passchn\Konzertmeister\Event\Organization;
use Passchn\Konzertmeister\Event\Tag;

class JsonToEventList
{
    /**
     * @param string $json
     * @return list<Event>
     * @throws Exception
     */
    public static function convert(string $json): array
    {
        $dataList = json_decode($json, true);
        unset($json);

        $events = [];

        foreach ($dataList as $data) {

            $location = new Location(
                $data['location']['id'],
                $data['location']['name'],
                $data['location']['geo'],
                $data['location']['formattedAddress'],
                $data['location']['latitude'],
                $data['location']['longitude'],
            );

            $organization = new Organization(
                $data['org']['id'],
                $data['org']['name'],
                $data['org']['parentName'],
                $data['org']['imageUrl'],
            );

            $tags = array_map(
                static function (array $tagData) {
                    return new Tag(
                        $tagData['id'],
                        $tagData['tag'],
                        $tagData['color'],
                    );
                },
                $data['tags']
            );

            $events[] = new Event(
                $data['id'],
                $data['name'],
                new \DateTimeImmutable($data['start']),
                new \DateTimeImmutable($data['end']),
                EventType::fromId($data['typId']),
                $data['active'],
                $location,
                $organization,
                $tags,
            );
        }
        
        return $events;
    }
}