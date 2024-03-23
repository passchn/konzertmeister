<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister\Export\PDF;

use Dompdf\Dompdf;
use Dompdf\Options;

class DompdfFactory implements DompdfFactoryInterface
{
    public function createDompdf(): Dompdf
    {
        return new Dompdf(new Options());
    }
}