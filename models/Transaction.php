<?php
/*
  Amount is stored always in euro.
 */
require_once('./models/CurrencyWebservice.php');

class Transaction
{
  private $date;
  private $amount;
  private $currency;
  function __construct($date, $symbol, $amount) {
    $this->currency = CurrencyWebservice::getCurrencyFromSymbol($symbol);
    if (!$this->currency) {
      throw new Exception("Invalid Currency");
    }
    $this->amount = $amount;
    $this->date = $date;
  }

  public function getDate() {
    return $this->date;
  }

  public function getAmountIn($currency)
  {
    $exhangeRate = CurrencyWebservice::getExchangeRate($this->currency, $currency);
    if (!$exhangeRate) {
      throw new Exception("Invalid Currency");
    }
    return $this->amount * $exhangeRate;
  }

  public static function cmpDateAsc($a, $b) {
    return $a->date < $b->date;
  }
}
