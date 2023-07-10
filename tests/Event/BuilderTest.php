<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Tests\Event;

use Passchn\Konzertmeister\Event\Builder\JsonToEventList;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class BuilderTest extends TestCase
{
    public function testBuilder()
    {
        $data = file_get_contents('./files/test-response.json');

        $events = JsonToEventList::convert($data);

        Assert::assertEquals(2, count($events));
        Assert::assertEquals(645353, current($events)->id);
    }
}