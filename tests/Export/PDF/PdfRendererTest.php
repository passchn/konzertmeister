<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister\Tests\Export\PDF;

use Nette\Utils\FileSystem;
use Passchn\Konzertmeister\Event\Builder\JsonToEventList;
use Passchn\Konzertmeister\Export\PDF\PdfRendererFactory;
use PHPUnit\Framework\TestCase;

class PdfRendererTest extends TestCase
{
    public function testRenderToString(): void
    {
        $renderer = PdfRendererFactory::createRenderer();
        $pdfBlob = $renderer->render([])->toBlob();

        static::assertStringContainsString('%PDF', $pdfBlob);
    }

    public function testSavePdf(): void
    {
        $events = JsonToEventList::convert(
            file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'test-response.json'),
        );

        $filename = 'test-events.pdf';
        $renderer = PdfRendererFactory::createRenderer();
        $renderer->render($events)->saveFile($filename);

        static::assertStringContainsString('%PDF', FileSystem::read($filename));

        FileSystem::delete($filename);
    }
}
