<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Tests\Network;

use Passchn\Konzertmeister\Network\Client;
use Passchn\Konzertmeister\Network\ClientOptions;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    protected bool $areNetworkTestsEnabled = false;

    /**
     * Url can be modified and /json path is added
     *
     * @return void
     */
    public function testClientOptions()
    {
        $options = $this->getOptions();

        $url = $options->getUrl();
        $url = urldecode($url);

        Assert::assertEquals(
            'https://rest.konzertmeister.app/api/v3/org/OALS_79fsdfd/upcomingappointments/json?limit=10&display=light&hash=232133&types=1,2&tags=123,456',
            $url,
        );
    }

    public function testClient()
    {
        if (!$this->areNetworkTestsEnabled) {
            $this->markTestSkipped('Http testing not active.');
        }

        $options = $this->getOptions();
        $client = new Client($options);
        $events = $client->fetch();

        Assert::assertIsArray($events);
    }

    protected function getOptions(): ClientOptions
    {
        return new ClientOptions(
            new \GuzzleHttp\Client(),
            'https://rest.konzertmeister.app/api/v3/org/OALS_79fsdfd/upcomingappointments?limit=10&display=light&hash=232133&types=1,2&tags=123,456',
        );
    }
}