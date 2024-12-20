<?php

declare(strict_types=1);

namespace Rbc\Infrastructure\CBR\Transformer;

use Rbc\Infrastructure\CBR\Model\CbrCurrencyModel;
use SimpleXMLElement;

class XmlCbrCurrencyModelTransformer
{
    public function transform(SimpleXMLElement $currency): CbrCurrencyModel
    {
        return new CbrCurrencyModel(
            (string)$currency->Vname,
            (int)$currency->Vnom,
            (float)$currency->Vcurs,
            (float)$currency->Vcode,
            (string)$currency->VchCode,
            (float)$currency->VunitRate
        );
    }

}