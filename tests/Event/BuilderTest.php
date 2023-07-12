<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Tests\Event;

use Passchn\Konzertmeister\Event\Builder\JsonToEventList;
use Passchn\Konzertmeister\Event\Event;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    public function testBuilder()
    {
        $events = $this->getEvents();
        Assert::assertEquals(2, count($events));

        /**
         * @var Event $testEvent
         */
        $testEvent = current($events);
        Assert::assertEquals(645353, $testEvent->id);
    }

    public function testTimeZones()
    {
        $timezones = [
            'Z' => '18:30',
            'GMT' => '18:30',
            'GMT+2' => '20:30',
            '-4:00' => '14:30',
        ];

        foreach ($timezones as $tz => $expectedTime) {
            $event = current($this->getEvents($tz));
            Assert::assertEquals($expectedTime, $event->start->format('H:i'));
        }
    }

    private function getEvents(?string $timezone = null): array
    {
        if ($timezone !== null) {
            $timezone = new \DateTimeZone($timezone);
        }

        return JsonToEventList::convert($this->getTestJson(), $timezone);
    }

    private function getTestJson(): string
    {
        $cwd = getcwd();
        $part = '/tests/Event';
        if (!str_contains($cwd, $part)) {
            $cwd .= $part;
        }
        $path = $cwd . '/files/test-response.json';
        $data = file_get_contents($path);
        if ($data === false) {
            throw new \Exception(sprintf(
                'test data not found at "%s".',
                $path,
            ));
        }

        return $data;
    }
}