<?php

declare(strict_types=1);

/**
 * @var list<\Passchn\Konzertmeister\Event\Event> $events
 * @var League\Plates\Template\Template $this
 */

use Passchn\Konzertmeister\Event\Tag;
use Passchn\Konzertmeister\Util\DateUtil;

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

        table th {
            font-size: .75rem;
            text-align: left;
            color: darkslategray;
        }

        table td, table th {
            border-bottom: 1px solid darkslategray;
            padding: .35rem .25rem;
        }

        .muted {
            color: darkslategray;
        }

        .current-month {
            text-align: center;
            background-color: #f7f7f7;
        }

        .current-month h2 {
            font-size: .85rem;
            color: darkslategray;
            margin: .25rem 0 0 0;
        }

        .current-month td {
            padding: .45rem .25rem;
        }

        .tags {
            display: flex;
            flex-wrap: wrap;
            max-width: 12rem;
            margin-top: .35rem;;
        }

        .tag {
            padding: .2rem .45rem;
            font-size: .65rem;
            border-radius: .45rem;
        }

        .tag.--event-type {
            background-color: darkslategray;
            color: #fff;
        }

        .creation-time {
            float: right;
        }
    </style>
</head>
<body>
<main>
    <small class="creation-time muted">
        Stand: <?= (new DateTimeImmutable())->format('d.m.Y') ?>
    </small>
    <h1><?= $title ?></h1>
    <table>
        <thead>
        <tr>
            <th>
                Datum / Uhrzeit
            </th>
            <th>
                Termin
            </th>
            <th>
                Ort
            </th>
            <th>
                Info
            </th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($events as $event) : ?>
            <?php if ($currentMonth !== $event->start->format('m')) : ?>
                <tr class="current-month">
                    <td colspan="5">
                        <h2>
                            <?= DateUtil::getTranslatedMonth($event->start, short: false) ?>
                            <?= $event->start->format('Y') ?>
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
                        : sprintf(
                            '%s,&nbsp;%s',
                            DateUtil::getTranslatedWeekday($event->start),
                            $event->start->format('d.m.'),
                        )
                    ?>
                    <br>
                    <small class="muted">
                        <?= sprintf(
                            '%s&nbsp;–&nbsp;%s',
                            $event->start->format('H:i'),
                            $event->end->format('H:i')
                        ) ?>
                    </small>
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
                    <?= $this->insert('partials/location', [
                        'location' => $event->location,
                    ]) ?>
                </td>
                <td>
                    <div class="tags">
                        <span class="tag --event-type"><?= $event->type->getLocalName() ?></span>
                        <?php
                        /** @var Tag $tag */
                        foreach ($event->tags as $tag):
                            ?>
                            <span class="tag" style="background-color:<?= $tag->color ?>;"><?= $tag->tag ?></span>
                        <?php endforeach; ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</main>
</body>
</html>
