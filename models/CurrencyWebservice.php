<?php
require_once('./consts/EXHANGE.php');
require_once('./consts/CURRENCY.php');
require_once('./utilities/startsWith.php');

/**
 * Dummy web service returning random exchange rates
 *
 */
class CurrencyWebservice
{

  /**
   * @todo return random value here for basic currencies like GBP USD EUR (simulates real API)
   *
   */
  public static function getExchangeRate($currency, $toCurrency)
  {
    if (EXHANGE[$currency] && $currency === $toCurrency) {
      return 1;
    }

    if (EXHANGE[$currency] && EXHANGE[$currency][$toCurrency]) {
      return EXHANGE[$currency][$toCurrency];
    }

    return null;
  }

  public static function getCurrencyFromSymbol($symbol)
  {
    return CURRENCY[$symbol];
  }

  public function getSymbol($amount) {
    foreach (array_keys(CURRENCY) as $value) {
      if (startsWith($amount, $value)) {
        return $value;
      }
    }
    return null;
  }
}
