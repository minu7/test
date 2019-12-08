<?php
require_once('./models/Transaction.php');
require_once('./models/CurrencyWebservice.php');

class Customer
{
  private $id;
  private $transactions = [];
  function __construct($id) {
    if ($id <= 0) {
      throw new Exception('Customer id must be positive');
    }
    $this->id = $id;
  }

  private function orderTransactionsByDate() {
    usort($this->transactions, ["Transaction", "cmpDateAsc"]);
  }

  public function getTransactions()
  {
    $csvFile = file('./data.csv');
    $this->transactions = [];
    foreach ($csvFile as $line) {
      $data = str_getcsv($line, ";");
      if (intVal($data[0]) === $this->id) {
        $amount = doubleval(preg_replace("/[^0-9.]/", "", $data[2]));
        $date = explode("/", $data[1]);
        $date = $date[2].'-'.$date[1].'-'.$date[0];
        $symbol = CurrencyWebservice::getSymbol($data[2]);
        $this->transactions[] = new Transaction($date, $symbol, $amount);
      }
    }
    $this->orderTransactionsByDate();
    return $this->transactions;
  }
}
