<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Tests\Network;

use Passchn\Konzertmeister\Event\EventType;
use Passchn\Konzertmeister\Network\ClientOptions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    /**
     * Url can be modified and /json path is added
     *
     * @return void
     */
    public function testClientOptions()
    {
        $options = new ClientOptions(
            new \GuzzleHttp\Client(),
            'https://rest.konzertmeister.app/api/v3/org/OALS_79fsdfd/upcomingappointments?limit=5&display=light&hash=232133&types=1,2'
        );

        $options->withLimit(10);
        $options->withEventTypes([2, EventType::Other]);
        $options->withTags([123, 456]);

        $url = $options->getUrl();
        $url = urldecode($url);

        Assert::assertEquals(
            'https://rest.konzertmeister.app/api/v3/org/OALS_79fsdfd/upcomingappointments/json?limit=10&display=light&hash=232133&types=2,3&tags=123,456',
            $url,
        );
    }
}