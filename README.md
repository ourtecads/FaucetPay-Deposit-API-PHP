# FaucetPay-Deposit-API-PHP
Documentation:
The first part would be to set up the HTML form which is used to take the payment parameters.

Form End-Point (Action): https://faucetpay.io/merchant/webscr
Form Method: POST

Parameter	Required	Description	Example Value
merchant_username	Required	Your FaucetPay username	bitearn
item_description	Required	Description of the item user is paying for	PlayStation 5
amount1	Required	Amount you want to receive in your origin currency	100
currency1	Required	The origin currency in your payment form	USD
currency2	Optional	The coin you want to enforce the buyer to pay with. Set blank, the user chooses themselves	ETH
custom	Optional	An identifier that is passed over the callback URL. It can be used to identify the User ID who is paying or be an Order ID.	4564211
callback_url	Optional	A URL where you want to receive the POST callback.	https://faucetpay.io/postback
success_url	Optional	A URL where you want to redirect the user after they pay.	https://faucetpay.io/success
cancel_url	Optional	A URL where you want to redirect the user if they cancel.	https://faucetpay.io/failAccepted Values for currency1: USD, BCH, BNB, BTC, DASH, DGB, DOGE, ETH, FEY, LTC, TRX, USDT, ZEC
Accepted Values for currency2: "", BCH, BNB, BTC, DASH, DGB, DOGE, ETH, FEY, LTC, TRX, USDT, ZEC

HTML Form:
<form action="https://faucetpay.io/merchant/webscr" method="post">
    <input type="text" name="merchant_username" value="[YOUR USERNAME]">
    <br>
    <input type="text" name="item_description" value="[ITEM DESCRIPTION]">
    <br>
    <input type="text" name="amount1" value="[AMOUNT]">
    <br>
    <input type="text" name="currency1" value="USD">
    <br>
    <input type="text" name="currency2" value="BTC">
    <br>
    <input type="text" name="custom" value="[IDENTIFICATION VALUE]">
    <br>
    <input type="text" name="callback_url" value="[CALLBACK URL]">
    <br>
    <input type="text" name="success_url" value="[SUCCESS URL]">
    <br>
    <input type="text" name="cancel_url" value="[CANCEL URL]">
    <br>
    <input type="submit" name="submit" value="Make Payment">
</form>

        
IPN Callback:
To receive a callback, it is mandatory for you to specify a callback URL in the field. You'll receive a POST payload to your callback URL on a successful payment. The payload will contain the following field(s).

Parameter	Instruction
token	The token that is used to check the integity of the IPN callback. Read the next section for more information

Integrity Check (Token):

The next step is to figure out whether the IPN callback you received is legit and is from FaucetPay. To do that, we include a parameter called token in the IPN callback payload. You need to make a GET request to the following URL: https://faucetpay.io/merchant/get-payment/token

You can expect a JSON response from that endpoint in which there will be a parameter called valid and its value will either be true or false. In addition to that, there would be other parameters which can help you get information about the user's payment.

Parameter	Instruction
transaction_id	A unique string to identify the payment
merchant_username	Make sure that it is equal to your username
amount1	Make sure that it is something you're expecting
currency1	Make sure that it is something you're expecting
amount2	Amount user paid in currency2
currency2	The currency user selected and paid with. Please check if it is what you're expecting if you had hard-coded it in the HTML form
custom	You can use this to identify the user, order ID or the item the user paid for

Sample Response:
{
	"valid": true,
	"transaction_id": "ed3649c51977f58562faa6986bb86a5432d93ed5",
	"merchant_username": "google",
	"amount1": "10.00000000",
	"currency1": "DOGE",
	"amount2": "10.00000000",
	"currency2": "DOGE",
	"custom": "order1234"
}
