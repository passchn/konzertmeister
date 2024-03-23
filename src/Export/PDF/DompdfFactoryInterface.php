<?php

declare(strict_types=1);

namespace Passchn\Konzertmeister\Export\PDF;

use Dompdf\Dompdf;

interface DompdfFactoryInterface
{
    public function createDompdf(): Dompdf;
}