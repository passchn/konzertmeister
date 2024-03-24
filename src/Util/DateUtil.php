<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister\Util;

use DateTimeInterface;
use Nette\Utils\Strings;

class DateUtil
{
    public static function getTranslatedWeekday(DateTimeInterface $dateTime, string $locale = 'de', bool $short = true): string
    {
        $map = [
            'de' => [
                '1' => [
                    'Mo',
                    'Montag',
                ],
                '2' => [
                    'Di',
                    'Dienstag',
                ],
                '3' => [
                    'Mi',
                    'Mittwoch',
                ],
                '4' => [
                    'Do',
                    'Donnerstag',
                ],
                '5' => [
                    'Fr',
                    'Freitag',
                ],
                '6' => [
                    'Sa',
                    'Samstag',
                ],
                '7' => [
                    'So',
                    'Sonntag',
                ],
            ],
        ];

        $langMap = $map[$locale] ?? $map[Strings::before($locale, '-') ?? 'de'];
        $day = $dateTime->format('N');

        return $langMap[$day][$short ? 0 : 1];
    }

    public static function getTranslatedMonth(DateTimeInterface $dateTime, string $locale = 'de', bool $short = true): string
    {
        $map = [
            'de' => [
                '1' => [
                    'Jan',
                    'Januar',
                ],
                '2' => [
                    'Feb',
                    'Februar',
                ],
                '3' => [
                    'Mrz',
                    'März',
                ],
                '4' => [
                    'Apr',
                    'April',
                ],
                '5' => [
                    'Mai',
                    'Mai',
                ],
                '6' => [
                    'Jun',
                    'Juni',
                ],
                '7' => [
                    'Jul',
                    'Juli',
                ],
                '8' => [
                    'Aug',
                    'August',
                ],
                '9' => [
                    'Sep',
                    'September',
                ],
                '10' => [
                    'Okt',
                    'Oktober',
                ],
                '11' => [
                    'Nov',
                    'November',
                ],
                '12' => [
                    'Dez',
                    'Dezember',
                ],
            ],
        ];

        $langMap = $map[$locale] ?? $map[Strings::before($locale, '-') ?? 'de'];
        $day = $dateTime->format('n');

        return $langMap[$day][$short ? 0 : 1];
    }
}