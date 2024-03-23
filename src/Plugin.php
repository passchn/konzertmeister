<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister;

class Plugin
{
    public static function rootDir(): string
    {
        return dirname(__DIR__);
    }

    public static function templateDir(): string
    {
        return static::rootDir() . DIRECTORY_SEPARATOR . 'template';
    }
}