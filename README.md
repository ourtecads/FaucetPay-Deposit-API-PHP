# FaucetPay-Deposit-API-PHP
Documentation:
<br>
The first part would be to set up the HTML form which is used to take the payment parameters.
<br><br>
Form End-Point (Action): https://faucetpay.io/merchant/webscr
Form Method: POST
<br><br>
Parameter<br>
merchant_username > Required > Your FaucetPay username<br>
item_description > Required > Description of the item user is paying for<br>
amount1	Required > Amount > you want to receive in your origin currency<br>
currency1 > Required > The origin currency in your payment form	USD<br>
currency2 > Optional > The coin you want to enforce the buyer to pay with. Set blank, the user chooses themselves<br>
custom > Optional > An identifier that is passed over the callback URL. It can be used to identify the User ID who is paying or be an Order ID.<br>
callback_url > Optional > A URL where you want to receive the POST callback.<br>
success_url > Optional > A URL where you want to redirect the user after they pay.<br>
cancel_url > Optional > A URL where you want to redirect the user if they cancel.<br>
<br><br>
HTML Form:
<code><form action="https://faucetpay.io/merchant/webscr" method="post">
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
</form></code>
