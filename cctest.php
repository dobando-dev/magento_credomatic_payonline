<?php
date_default_timezone_set('America/Costa_Rica');

$orderId = 'Test2';
$key = '5b262dJytde8g8q3ChPJ2FQ7CE2RHyzJ';
$keyId = '7762642';
//Quita el punto decimal del monto
$amount = number_format(10.00,2);
$time = time();
$hash = md5("$orderId|$amount|$time|$key");

echo '<pre>';
print_r($_GET);
echo '</pre>'

?>
<html>
<div class="medium-12 columns no-padding">
                            <h1>Procesando su transacción</h1>
<br>
<p>Por favor ingrese los datos de su tarjeta.</p>
<form name="CredomaticPost" method="post" action="https://credomatic.compassmerchantsolutions.com/api/transact.php">
    Amount
    <input type="text" name="amount" id="amount" value="<?php echo $amount?>"><br/>
    Hash
    <input type="text" name="hash" id="hash" value="<?php echo $hash?>"><br/>
    Time
    <input type="text" name="time" id="time" value="<?php echo $time?>"> Time is <?php echo date('d-m-Y H:i:s', $time) ?><br/>
    Key ID
    <input type="text" name="key_id" id="key_id" value="<?php echo $keyId?>"><br/>
    Order ID
    <input type="text" name="orderid" id="orderid" value="<?php echo $orderId?>"><br/>
    Processor ID
    <input type="text" name="processor_id" id="processor_id" value=""><br/>
    CC Number
    <input type="text" name="ccnumber" id="ccnumber" value="4111111111111111"><br/>
    CC EXP
    <input type="text" name="ccexp" id="ccexp" value="1220"><br/>
    CCV
    <input type="text" name="cvv" id="cvv" value="999"><br/>
    Type
    <input type="text" name="type" id="type" value="sale"><br/>
    Address
    <input type="text" name="address" id="address" value=""><br/>
    Redirect
    <input type="text" name="redirect" id="redirect" value="http://dkoko.com/cctest.php"><br/>
    <input type="submit" value="Submit">
</form>                        </div>
</html>