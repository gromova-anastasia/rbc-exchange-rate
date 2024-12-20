<?php

declare(strict_types=1);

namespace Rbc\Infrastructure\CBR;

use Exception;
use Rbc\Domain\Currency\Contract\Infrastructure\CurrencyApiInterface;
use Rbc\Infrastructure\CBR\Exception\CbrDataException;
use Rbc\Infrastructure\CBR\Model\CbrCurrencyModel;
use Rbc\Infrastructure\CBR\Transformer\XmlCbrCurrencyModelTransformer;
use SimpleXMLElement;
use SoapFault;

class CbrClient implements CurrencyApiInterface
{
    private const URL = 'http://www.cbr.ru/DailyInfoWebServ/DailyInfo.asmx?WSDL';

    private XmlCbrCurrencyModelTransformer $cbrCurrencyModelTransformer;

    public function __construct(XmlCbrCurrencyModelTransformer $cbrCurrencyModelTransformer)
    {
        $this->cbrCurrencyModelTransformer = $cbrCurrencyModelTransformer;
    }

    /**
     * @throws SoapFault
     * @throws CbrDataException
     */
    private function getCbrData(string $date): ?SimpleXMLElement
    {
        $xml = null;

        try {
            $cbr = new \SoapClient(self::URL, ['soap_version' => SOAP_1_2, 'exceptions' => true]);
            $result = $cbr->GetCursOnDateXML(array('On_date' => $date));
            if ($result->GetCursOnDateXMLResult->any) {
                $xml = new SimpleXMLElement($result->GetCursOnDateXMLResult->any);
            }
        } catch (Exception $e) {
            throw new CbrDataException();
        }

        return $xml;
    }

    /**
     * @throws SoapFault
     * @throws CbrDataException
     */
    public function getRate(string $code, string $date): ?CbrCurrencyModel
    {
        $xml = $this->getCbrData($date . 'T00:00:00');
        if (null === $xml) {
            return null;
        }

        //TODO: Добавить кеширование данных цб
        $currencyModel = null;
        foreach ($xml->ValuteCursOnDate as $currency) {
            if ($currency->VchCode == $code) {
                $currencyModel = $this->cbrCurrencyModelTransformer->transform($currency);
            }
        }

        return $currencyModel;
    }
}