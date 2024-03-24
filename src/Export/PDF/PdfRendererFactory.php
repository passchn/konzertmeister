<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister\Export\PDF;

use League\Plates\Engine;

class PdfRendererFactory
{
    /**
     * Creates a renderer with a render engine for php templates.
     * @link https://platesphp.com/
     *
     * @param PdfOptions|null $options
     * @return PdfRenderer
     */
    public static function createRenderer(?PdfOptions $options = null): PdfRenderer
    {
        $options = $options ?? PdfOptions::createDefault();

        $engine = new Engine(
            $options->templatesBaseDir,
            $options->templateFileType,
        );

        return new PdfRenderer(
            new DompdfFactory(),
            new PdfView($engine),
            $options,
        );
    }
}