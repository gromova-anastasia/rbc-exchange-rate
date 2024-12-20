<?php

declare(strict_types=1);

namespace Rbc\Infrastructure\CBR\Model;

use Rbc\Domain\Currency\Contract\Infrastructure\CbrCurrencyModelInterface;

class CbrCurrencyModel implements CbrCurrencyModelInterface
{
    private string $name;
    private int $nom;
    private float $curs;
    private float $code;
    private string $chCode;
    private float $unitRate;

    public function __construct(string $name, int $nom, float $curs, float $code, string $chCode, float $unitRate)
    {
        $this->name = $name;
        $this->nom = $nom;
        $this->curs = $curs;
        $this->code = $code;
        $this->chCode = $chCode;
        $this->unitRate = $unitRate;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNom(): int
    {
        return $this->nom;
    }

    public function getCurs(): float
    {
        return $this->curs;
    }

    public function getCode(): float
    {
        return $this->code;
    }

    public function getChCode(): string
    {
        return $this->chCode;
    }

    public function getUnitRate(): float
    {
        return $this->unitRate;
    }

}
