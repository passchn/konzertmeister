<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister\Export\PDF;

use Dompdf\Dompdf;
use Nette\Utils\FileSystem;

class PdfFacade
{
    public function __construct(
        protected readonly Dompdf $dompdf,
    ) {
    }

    public function stream(string $filename = 'konzertmeister-events.pdf', bool $asAttachment = true): void
    {
        $this->dompdf->render();
        $this->dompdf->stream($filename, [
            'Attachment' => $asAttachment,
        ]);
    }

    public function toBlob(): ?string
    {
        $this->dompdf->render();
        return $this->dompdf->output();
    }

    public function saveFile(string $filename = 'konzertmeister-events.pdf'): void
    {
        FileSystem::write($filename, $this->toBlob());
    }
}