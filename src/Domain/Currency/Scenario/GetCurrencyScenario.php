<?php

declare(strict_types=1);

namespace Rbc\Domain\Currency\Scenario;

use DateTime;
use Rbc\Domain\Currency\Contract\Infrastructure\CurrencyApiInterface;
use Rbc\Domain\Currency\Model\CurrencyModel;

class GetCurrencyScenario
{
    private CurrencyApiInterface $currencyApi;

    public function __construct(CurrencyApiInterface $currencyApi)
    {
        $this->currencyApi = $currencyApi;
    }

    //TODO: Добавить вычисление кросс-курса
    public function __invoke($date, string $currencyCode, string $baseCurrency): CurrencyModel
    {
        $currentCurrency = $this->currencyApi->getRate($currencyCode, $date);
        $previousDate = (new DateTime($date))->modify('-1 day')->format('Y-m-d');
        $previousCurrency = $this->currencyApi->getRate($currencyCode, $previousDate);

        $difference = $currentCurrency->getUnitRate() - $previousCurrency->getUnitRate();

        return new CurrencyModel($currencyCode, $currentCurrency->getUnitRate(), $difference);
    }

}
