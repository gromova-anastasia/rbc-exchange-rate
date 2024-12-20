<?php

declare(strict_types=1);

namespace Rbc\Domain\Currency\Model;

class CurrencyModel
{
    private string $code;
    private float $rate;
    private float $difference;

    public function __construct(string $code, float $rate, float $difference)
    {
        $this->code = $code;
        $this->rate = $rate;
        $this->difference = $difference;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getDifference(): float
    {
        return $this->difference;
    }

}
