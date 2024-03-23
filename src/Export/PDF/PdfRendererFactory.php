<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister\Export\PDF;

use League\Plates\Engine;
use Passchn\Konzertmeister\Plugin;

class PdfRendererFactory
{
    public static function createRenderer(): PdfRenderer
    {
        return new PdfRenderer(
            new DompdfFactory(),
            new Engine(Plugin::templateDir() . DIRECTORY_SEPARATOR . 'PDF'),
        );
    }
}