<?php
use Chargily\ePay\Chargily;

require 'path-to-vendor/vendor/autoload.php';

$epay_config = require 'epay_config.php';

$chargily = new Chargily([
    //credentials
    'api_key' => $epay_config['key'],
    'api_secret' => $epay_config['secret'],
]);

if ($chargily->checkResponse()) {
    $response = $chargily->getResponseDetails();
    //@ToDo: Validate order status by $response['invoice']['invoice_number']. If it is not already approved, approve it.
    //something else
    /*
        $response like the follwing array
            $response = array(
                "invoice" => array(
                            "id" => 5566321,
                            "client" => "Client name",
                            "invoice_number" => "123456789",
                            "due_date" => "2022-01-01 00:00:00",
                            "status" => "paid",
                            "amount" => 75,
                            "fee" => 25,
                            "discount" => 0,
                            "comment" => "Payment description",
                            "tos" => 1,
                            "mode" => "EDAHABIA",
                            "invoice_token" => "randoom_token_here",
                            "due_amount" => 10000,
                            "created_at" => "2022-01-01 06:10:38",
                            "updated_at" => "2022-01-01 06:13:00",
                            "back_url" => "https://www.mydomain.com/success",
                            "new" => 1,
                );
            )
    */
    exit('OK');
}
?>