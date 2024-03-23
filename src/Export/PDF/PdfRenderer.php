<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister\Export\PDF;

use League\Plates\Engine;
use Passchn\Konzertmeister\Event\Event;

class PdfRenderer
{
    public function __construct(
        protected readonly DompdfFactoryInterface $dompdfFactory,
        protected readonly Engine $templateEngine,
    ) {
    }

    public function render(array $events, string $template = 'default'): PdfFacade
    {
        $html = $this->renderHtml($template, $events);
        $pdf = $this->dompdfFactory->createDompdf();
        $pdf->loadHtml($html);

        return new PdfFacade($pdf);
    }

    /**
     * @param string $template template name
     * @param list<Event> $events
     * @return string Html
     */
    protected function renderHtml(string $template, array $events): string
    {
        return $this->templateEngine->render($template, [
            'events' => $events,
        ]);
    }
}