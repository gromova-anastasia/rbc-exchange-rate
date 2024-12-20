<?php

declare(strict_types=1);

namespace Rbc\Domain\Currency\Contract\Infrastructure;

interface CbrCurrencyModelInterface
{
    public function getChCode(): string;
    public function getUnitRate(): float;
}