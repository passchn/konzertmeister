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

        $events = JsonToEventList::convert($data);

        Assert::assertEquals(2, count($events));
        Assert::assertEquals(645353, current($events)->id);
    }
}