<html>
<head>
    <title>Parking System</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            text-align: center;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #b3ccff;
        }

        .container label, .container input, .result {
            display: block;
            margin: 10px 0;
        }

        .form-container {
            display: block;
        }

        .result {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <form  id="parkingForm" action="query.php" method="post" >
                <h1><label for="Smart Parking System">Smart Parking System</label></h1>
<?php
//INCLUDE THE ACCESS TOKEN FILE
include 'C:\xampp\htdocs\test\accessToken.php';
include 'C:\xampp\htdocs\dbconnect.php';
// File 2: receiving.php
$fileContent = file_get_contents("data2.txt");
if ($fileContent !== false) {
  $decodedData = json_decode($fileContent, true);
  if ($decodedData) {
    $PhoneNo=$decodedData['PhoneNo'];
    $parkingNumber=$decodedData['ParkingNumber'];
    $Fee=$decodedData['Fee'];
   


      
  
  //$receivedVariable = $_POST['sentVariable'];
 
  echo"<br>";


      //echo  $fee;
  
    


  echo"<br>";
  
  $PhoneNo = (int)$PhoneNo; // Convert to integer
  if ($PhoneNo >= 1000000000) {
      // Remove the first zero by using integer division and modulo
      $PhoneNo = ($PhoneNo / 10);
  }
  
  // Convert the modified integer back to a string
  $PhoneNo = strval($PhoneNo);


  $result = "254" . $PhoneNo;
  $PH=str_replace(' ', '', $result);

    
  

  //echo $receivedVariable;
  echo"<br>";
   
date_default_timezone_set('Africa/Nairobi');
$processrequestUrl = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
$callbackurl = 'https://icproject.000webhostapp.com/callback.php';
$passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
$BusinessShortCode = '174379';
$Timestamp = date('YmdHis');
// ENCRIPT  DATA TO GET PASSWORD
$Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
//$phone = addslashes($result);//phone number to receive the stk push
$money = strval($Fee);
$PartyA = $PH;
$PartyB = '254792207776';
$AccountReference = 'SMARTPARK';
$TransactionDesc = 'stkpush test';
$Amount = $money;
$stkpushheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $accessToken];
//INITIATE CURL
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $processrequestUrl);
curl_setopt($curl, CURLOPT_HTTPHEADER, $stkpushheader); //setting custom header
$curl_post_data = array(
  //Fill in the request parameters with valid values
  'BusinessShortCode' => $BusinessShortCode,
  'Password' => $Password,
  'Timestamp' => $Timestamp,
  'TransactionType' => 'CustomerPayBillOnline',
  'Amount' => $Amount,
  'PartyA' => $PartyA,
  'PartyB' => $BusinessShortCode,
  'PhoneNumber' => $PartyA,
  'CallBackURL' => $callbackurl,
  'AccountReference' => $AccountReference,
  'TransactionDesc' => $TransactionDesc
);

$data_string = json_encode($curl_post_data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
$curl_response = curl_exec($curl);
//ECHO  RESPONSE
$data = json_decode($curl_response);
$CheckoutRequestID = $data->CheckoutRequestID;
$ResponseCode = $data->ResponseCode;
if ($ResponseCode == "0") {
  //echo "The CheckoutRequestID for this transaction is : " . $CheckoutRequestID;

echo "Request Sent Awaiting Confirmation";
$data1 = array(
  'CheckoutRequestID' => $CheckoutRequestID,
  'PhoneNo' => $PhoneNo
                     
);
$jsonContent = json_encode($data1, JSON_PRETTY_PRINT);
$logFile = "Payment.txt";
file_put_contents($logFile, $jsonContent);


}

}
}
?>
       <br>
                    

                <input type="submit" name="submit" value="Check Payment Status">
            </form>
        </div>
    </div>
    <script>
        // Hide the form and show the result if it exists
        const formContainer = document.querySelector(".form-container");
        const resultContainer = document.querySelector(".result");

        if (resultContainer) {
            formContainer.style.display = "none";
            resultContainer.style.display = "block";
        }
    </script>
    
</body>
</html>