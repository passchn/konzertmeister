<?php

declare(strict_types=1);

/**
 * @var list<\Passchn\Konzertmeister\Event\Event> $events
 */

use Passchn\Konzertmeister\Event\Tag;

$startYear = ($events[0] ?? null)?->start->format('Y');
$endYear = ($events[0] ?? null)?->end->format('Y');
$currentMonth = null;

$title = sprintf(
    'Termine %s',
    $startYear === $endYear ? $startYear : sprintf('%s bis %s', $startYear, $endYear),
);


?>

<!doctype html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
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

        .muted {
            color: slategray;
        }
    </style>
</head>
<body>
<main>
    <h1><?= $title ?></h1>
    <table>
        <thead>
        <tr>
            <th>
                Datum
            </th>
            <th>
                Uhrzeit
            </th>
            <th>
                Termin
            </th>
            <th>
                Ort
            </th>
            <th>
                Tags
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($events as $event) : ?>
            <?php if ($currentMonth !== $event->start->format('m')) : ?>
                <tr>
                    <td colspan="5">
                        <h2>
                            <?= $event->start->format('F Y') ?>
                        </h2>
                    </td>
                </tr>
            <?php endif; ?>
            <?php
            $currentMonth = $event->start->format('m');
            ?>
            <tr>
                <td>
                    <?= $event->isMultipleDays() ?
                        sprintf('%s bis %s', $event->start->format('d.m'), $event->end->format('d.m'))
                        : $event->start->format('d.m.')
                    ?>
                </td>
                <td>
                    <?= $event->start->format('H:i') ?> -
                    <?= $event->end->format('H:i') ?>
                </td>
                <td>
                    <?= $event->name ?>
                    <?php if ($event->description) : ?>
                        <br>
                        <small class="muted">
                            <?= $event->description ?>
                        </small>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($event->location->name) : ?>
                        <?= $event->location->name ?>
                    <?php endif; ?>
                    <?php if ($event->location->name && $event->location->formattedAddress) : ?>
                        <br>
                    <?php endif; ?>
                    <?php if ($event->location->formattedAddress) : ?>
                        <?= $event->location->formattedAddress ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php
                    /** @var Tag $tag */
                    foreach ($event->tags as $tag):
                        ?>
                        <span class="tag" style="color:<?= $tag->color ?>;"><?= $tag->tag ?></span>
                    <?php endforeach; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
</body>
</html>
