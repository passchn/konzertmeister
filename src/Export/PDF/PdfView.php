<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister\Export\PDF;

use League\Plates\Engine;
use Passchn\Konzertmeister\Export\FormatterInterface;
use Passchn\Konzertmeister\View\ViewInterface;

class PdfView implements ViewInterface
{
    public function __construct(
        protected readonly Engine $engine,
        protected readonly FormatterInterface $formatter,
    ) {
    }

    public function render(string $template, array $variables = []): string
    {
        $variables += ['_formatter' => $this->formatter];
        return $this->engine->render($template, $variables);
    }
}