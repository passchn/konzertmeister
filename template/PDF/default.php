<?php

declare(strict_types=1);

/**
 * @var list<\Passchn\Konzertmeister\Event\Event> $events
 */

?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Termine</title>
    <style>
        main {
            font-family: sans-serif;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table td, table th {
            border-bottom: 1px solid slategray;
            padding: .5rem;
        }
    </style>
</head>
<body>
<main>
    <h1>
        Termine
    </h1>
    <table>
        <thead>
        <tr>
            <th>
                Datum
            </th>
            <th>
                Termin
            </th>
            <th>
                Ort
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($events as $event) : ?>
            <tr>
                <td>
                    <?= $event->start->format('d.m.Y') ?>
                </td>
                <td>
                    <?= $event->name ?>
                </td>
                <td>
                    <?= $event->location->formattedAddress ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
</body>
</html>