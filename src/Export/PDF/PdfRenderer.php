<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister\Export\PDF;

use Passchn\Konzertmeister\View\ViewInterface;

class PdfRenderer
{
    public function __construct(
        protected readonly DompdfFactoryInterface $dompdfFactory,
        protected readonly ViewInterface          $view,
        protected readonly PdfOptions             $options,
    ) {
    }

    public function render(array $events, ?string $template = null): PdfFacade
    {
        $html = $this->view->render(
            $template ?? $this->options->defaultTemplate,
            [
                'events' => $events,
            ]
        );
        $pdf = $this->dompdfFactory->createDompdf();
        $pdf->loadHtml($html);

        return new PdfFacade($pdf);
    }
}