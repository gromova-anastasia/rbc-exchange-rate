<?php
declare(strict_types=1);

use Rbc\Domain\Currency\Scenario\GetCurrencyScenario;
use Rbc\Infrastructure\CBR\CbrClient;
use Rbc\Infrastructure\CBR\Transformer\XmlCbrCurrencyModelTransformer;
use Rbc\Presentation\CurrencyApiV1\Controller\CurrencyController;

require_once __DIR__ . '/../vendor/autoload.php';

$xmlCbrCurrencyModelTransformer = new XmlCbrCurrencyModelTransformer();
$currencyApi = new CbrClient($xmlCbrCurrencyModelTransformer);
$getCurrencyScenario = new GetCurrencyScenario($currencyApi);
$controller = new CurrencyController($getCurrencyScenario);

echo $controller->get();