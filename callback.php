<?php

	require_once . 'YOUR DATABASE CONFIG PATH';

$order_currency = 'BTC';

$token = $_POST['token']; //need generate token from your server (optional)

//fetch request url
$payment_info = file_get_contents("https://faucetpay.io/merchant/get-payment/" . $token); //$token is optional
$payment_info = json_decode($payment_info, true); //decode result
$token_status = $payment_info['valid']; //$token_status is optional

$merchant_username = $payment_info['merchant_username']; //get merchant username from request result
$amount1 = $payment_info['amount1']; //get amount from request result 
$currency1 = $payment_info['currency1']; ////get currency from request result
$amount2 = $payment_info['amount2']; //get second amount from request result if available
$currency2 = $payment_info['currency2']; //get second currency from request result if available
$custom = $payment_info['custom']; ///get invoice information or order id from request result

$my_username = "YOUR FAUCETPAY USERNAME";

//validate request if match with order
if ($my_username == $merchant_username && $token_status == true) {    //$token_status is optional

//prepare to get order information from database, configure based on your database table and column
$invo = db()->prepare("SELECT * FROM deposits WHERE id = " .$custom);
$invo->execute();
$invo = $invo->fetch(\PDO::FETCH_OBJ);

        $current_date = date('Y-m-d'); //get current date

        $updateinvoice = db()->prepare('UPDATE deposits SET status = ? WHERE id = '.$custom); //updating order status
        $updateinvoice->execute([1]);

        $user = db()->prepare("SELECT * FROM users WHERE id = " . $invo->user_id); 
        $user->execute();
        $user = $user->fetch(\PDO::FETCH_OBJ); //get user information from database
        
        $new = $invo->amount;
        $newbalance = $user->account_balance + $new; //add balance to users

        $updatebalance = db()->prepare('UPDATE users SET account_balance = ? WHERE id = ' . $invo->user_id);
        $updatebalance->execute([$newbalance]);
        echo "Deposit $new Success!";
} else {

        echo "Deposit Failed!";

}

?>
