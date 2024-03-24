<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister\View;

interface ViewInterface
{
    public function render(string $template, array $variables = []): string;
}