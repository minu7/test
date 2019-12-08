<?php

//TODO print formatted report
require('./models/Customer.php');
if (count($argv) != 3) {
  throw new Exception("Must be provided 2 arguments: customer_id and currency");
}
$customer = new Customer(intval($argv[1]));
echo "Your transactions are (in ".$argv[2].") \n";
foreach ($customer->getTransactions() as $transaction) {
  echo $transaction->getDate().": ".$transaction->getAmountIn($argv[2]). "\n";
}
