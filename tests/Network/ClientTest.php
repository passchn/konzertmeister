<?php
declare(strict_types=1);

namespace Passchn\Konzertmeister\Tests\Network;

use Passchn\Konzertmeister\Network\Client;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testSayHello()
    {
        $client = new Client();
        $result = $client->sayHello();

        Assert::assertEquals('hello', $result);
    }
}