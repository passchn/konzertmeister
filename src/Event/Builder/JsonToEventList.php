<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Event\Builder;

use Closure;
use DateTimeZone;
use Passchn\Konzertmeister\Event\Event;
use Passchn\Konzertmeister\Event\EventType;
use Passchn\Konzertmeister\Event\Location;
use Passchn\Konzertmeister\Event\Organization;
use Passchn\Konzertmeister\Event\Tag;

class JsonToEventList
{
    /**
     * @param string $json
     * @param Closure|null $onConvertError receives the exception and the data that caused the error
     * @return Event[]
     */
    public static function convert(string $json, ?Closure $onConvertError = null): array
    {
        $dataList = json_decode($json, true, flags: JSON_THROW_ON_ERROR);
        unset($json);

        if (!is_array($dataList)) {
            return [];
        }

        $events = [];

        foreach ($dataList as $data) {
            try {
                if (!is_array($data)) {
                    throw new \RuntimeException('Invalid event data format, expected array.');
                }
                if (array_key_exists('name', $data)) {
                    $events[] = self::convertEventData($data);
                    continue;
                }
                throw new \RuntimeException('Invalid event data format, expected "name" key.');
            } catch (\Throwable $throwable) {
                if ($onConvertError !== null) {
                    $onConvertError($throwable, $data);
                }
                continue;
            }
        }

        return $events;
    }

    private static function convertEventData(array $data): Event
    {
        $location = null;
        if (($data['location'] ?? null) !== null) {
            $location = new Location(
                $data['location']['id'],
                $data['location']['name'] ?? null,
                $data['location']['geo'] ?? false,
                $data['location']['formattedAddress'] ?? null,
                $data['location']['latitude'] ?? null,
                $data['location']['longitude'] ?? null,
            );
        }

        $organization = null;
        if (($data['org'] ?? null) !== null) {
            $organization = new Organization(
                $data['org']['id'],
                $data['org']['name'],
                $data['org']['parentName'] ?? null,
                $data['org']['imageUrl'] ?? null,
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

        $timeZone = new DateTimeZone($data['timezoneId'] ?? 'Europe/Berlin');
        $start = $start->setTimezone($timeZone);
        $end = $end->setTimezone($timeZone);

        return new Event(
            $data['id'],
            $data['name'],
            self::nonEmptyStringOrNull($data['description'] ?? null),
            $start,
            $end,
            EventType::from($data['typId']),
            $data['active'],
            $location,
            $organization,
            $tags,
            self::nonEmptyStringOrNull($data['externalAppointmentLink'] ?? null),
        );
    }

    private static function nonEmptyStringOrNull(?string $value): ?string
    {
        return $value === '' ? null : $value;
    }
}