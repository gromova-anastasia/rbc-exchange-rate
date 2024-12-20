<?php

declare(strict_types=1);

namespace Rbc\Domain\Currency\Contract\Infrastructure;

interface CurrencyApiInterface
{
    public function getRate(string $code, string $date): ?CbrCurrencyModelInterface;

}