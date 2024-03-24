<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Event\Builder;

use DateTimeZone;
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
     * @param DateTimeZone|null $timeZone
     * @return list<Event>
     * @throws Exception
     */
    public static function convert(string $json, ?DateTimeZone $timeZone = null): array
    {
        $dataList = json_decode($json, true);
        unset($json);

        if (!is_array($dataList)) {
            return [];
        }

        $events = [];

        foreach ($dataList as $data) {

            $location = null;
            if ($data['location'] !== null) {
                $location = new Location(
                    $data['location']['id'],
                    $data['location']['name'],
                    $data['location']['geo'],
                    $data['location']['formattedAddress'],
                    $data['location']['latitude'],
                    $data['location']['longitude'],
                );
            }

            $organization = null;
            if ($data['org'] !== null) {
                $organization = new Organization(
                    $data['org']['id'],
                    $data['org']['name'],
                    $data['org']['parentName'],
                    $data['org']['imageUrl'],
                );
            }

            $tags = array_map(
                static function (array $tagData) {
                    return new Tag(
                        $tagData['id'],
                        $tagData['tag'],
                        $tagData['color'],
                    );
                },
                $data['tags'] ?? []
            );

            $start = new \DateTimeImmutable($data['start']);
            $end = new \DateTimeImmutable($data['end']);

            if ($timeZone !== null) {
                $start = $start->setTimezone($timeZone);
                $end = $end->setTimezone($timeZone);
            }

            $events[] = new Event(
                $data['id'],
                $data['name'],
                $data['description'],
                $start,
                $end,
                EventType::from($data['typId']),
                $data['active'],
                $location,
                $organization,
                $tags,
            );
        }

        return $events;
    }
}