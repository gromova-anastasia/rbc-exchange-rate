<?php

declare(strict_types=1);

namespace Rbc\Presentation\CurrencyApiV1\Controller;

use Rbc\Domain\Currency\Scenario\GetCurrencyScenario;

class CurrencyController
{
    private const JSON_RESPONSE_TYPE = 'Content-Type: application/json';
    private const DEFAULT_CURRENCY = 'USD';
    private const DEFAULT_BASE_CURRENCY = 'RUR';

    private GetCurrencyScenario $getCurrencyScenario;

    public function __construct(GetCurrencyScenario $getCurrencyScenario)
    {
        $this->getCurrencyScenario = $getCurrencyScenario;
    }

    //TODO: добавить сваггер, роутинг и симфони)
    public function get(): string
    {
        $date = $_GET['date'] ?? date('Y-m-d');
        $currencyCode = $_GET['currency'] ?? self::DEFAULT_CURRENCY;
        $baseCurrency = $_GET['base'] ?? self::DEFAULT_BASE_CURRENCY;

        $currency = ($this->getCurrencyScenario)($date, $currencyCode, $baseCurrency);

        header(self::JSON_RESPONSE_TYPE);
        return json_encode([
            'error' => null,
            'code' => $currency->getCode(),
            'rate' => $currency->getRate(),
            'difference' => $currency->getDifference()
        ]);
    }

}