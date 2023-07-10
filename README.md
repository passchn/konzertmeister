# Konzertmeister plugin for PHP

## Installation

Install the package via composer:

```sh
composer require passchn/konzertmeister
```

**Dependencies:**

* php ^8.1
* guzzlehttp/guzzle ^7
* nette/http ^3

## Usage

```php
// Copy the "Terminlisten-Link" with your filters (tags, types, ...) from this url:
// https://web.konzertmeister.app/export/list
// Note: Don't change the params as the hash will be invalid! 
$url = 'https://rest.konzertmeister.app/api/v3/org/OALS_4dad../upcomingappointments?types=1,2&limit=5&display=light&tags=22351,2024&hash=93af9...'

$guzzle = new GuzzleHttp\Client();
$options = new Passchn\Konzertmeister\Network\ClientOptions($guzzle, $url);

$client = new Passchn\Konzertmeister\Network\Client($options);

/** @var list<Passchn\Konzertmeister\Event\Event> **/
$events = $client->fetch();
```

If everything worked, `$events` will be an array of `Passchn\Konzertmeister\Event\Event`.

```php
$event = current($events);
$eventName = $event->name;
$dateFrom = $event->start->format('d.m.Y');

echo "$eventName wird am $dateFrom stattfinden. Wir freuen uns auf Deinen Besuch!";
```

### Contribution

Feel free to open a ticket or a pull request.
