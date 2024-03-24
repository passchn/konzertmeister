<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister\Export\PDF;

use League\Plates\Engine;
use Passchn\Konzertmeister\Export\DefaultFormatter;
use Passchn\Konzertmeister\Export\FormatterInterface;

class PdfRendererFactory
{
    /**
     * Creates a renderer with a render engine for php templates.
     * @link https://platesphp.com/
     *
     * @param PdfOptions|null $options
     * @param FormatterInterface|null $formatter
     * @return PdfRenderer
     */
    public static function createRenderer(?PdfOptions $options = null, ?FormatterInterface $formatter = null): PdfRenderer
    {
        $options = $options ?? PdfOptions::createDefault();

        $engine = new Engine(
            $options->templatesBaseDir,
            $options->templateFileType,
        );

        return new PdfRenderer(
            new DompdfFactory(),
            new PdfView($engine, $formatter ?? new DefaultFormatter()),
            $options,
        );
    }
}