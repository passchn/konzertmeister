<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister\Export\PDF;

use Passchn\Konzertmeister\Plugin;

class PdfOptions
{
    final public function __construct(
        public readonly string $templatesBaseDir,
        public readonly string $defaultTemplate = 'default',
        public readonly string $templateFileType = 'php',
    ) {
    }

    public static function createDefault(): static
    {
        return new static(
            Plugin::templateDir() . DIRECTORY_SEPARATOR . 'PDF',
        );
    }
}