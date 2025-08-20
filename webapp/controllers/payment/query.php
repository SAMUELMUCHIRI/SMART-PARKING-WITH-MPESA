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
                <h2><label for="Payment Status">Payment Verification</label></h2>
<?php
//INCLUDE ACCESS TOKEN FILE 
$fileContent = file_get_contents("Payment.txt");
if ($fileContent !== false) {
  $decodedData = json_decode($fileContent, true);
  if ($decodedData) {
    $PhoneNo=$decodedData['PhoneNo'];
    $CheckoutRequestID=$decodedData['CheckoutRequestID'];
include 'C:\xampp\htdocs\test\accessToken.php';
include 'C:\xampp\htdocs\dbconnect.php';
date_default_timezone_set('Africa/Nairobi');
  $query_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
  $BusinessShortCode = '174379';
  $Timestamp = date('YmdHis');
  $passkey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
  // ENCRIPT  DATA TO GET PASSWORD
  $Password = base64_encode($BusinessShortCode . $passkey . $Timestamp);
  //THIS IS THE UNIQUE ID THAT WAS GENERATED WHEN STK REQUEST INITIATED SUCCESSFULLY
  
  $queryheader = ['Content-Type:application/json', 'Authorization:Bearer ' . $accessToken];
  # initiating the transaction
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL, $query_url);
  curl_setopt($curl, CURLOPT_HTTPHEADER, $queryheader); //setting custom header
  $curl_post_data = array(
    'BusinessShortCode' => $BusinessShortCode,
    'Password' => $Password,
    'Timestamp' => $Timestamp,
    'CheckoutRequestID' => $CheckoutRequestID
  );
  $data_string = json_encode($curl_post_data);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
  $curl_response = curl_exec($curl);
  $data_to = json_decode($curl_response);
  if (isset($data_to->ResultCode)) {
    $ResultCode = $data_to->ResultCode;
    if ($ResultCode == '1037') {
      $massage = "1037 Timeout in completing transaction";

      echo $massage;
      ?>
      <form method="post">
      <input type="submit" name="redirect" value="Proceed to HomePage and Fill in details">
        </form>
  
  <?php
  if (isset($_POST['redirect'])) {
      // Redirecting back to index.php
      header("Location: index.php");
      exit; // Ensure that subsequent code is not executed after redirection
  }
  
  
    } elseif ($ResultCode == '1032') {
      $massage = "1032 Transaction  has cancelled by user";
      echo $massage;
      ?>
      <form method="post">
      <input type="submit" name="redirect" value="Proceed to HomePage and Fill in details">
        </form>
  
  <?php
  if (isset($_POST['redirect'])) {
      // Redirecting back to index.php
      header("Location: index.php");
      exit; // Ensure that subsequent code is not executed after redirection
  }
  
    } elseif ($ResultCode == '1') {
      $massage = "1 The balance is insufficient for the transaction";
      echo $massage;
      ?>
      <form method="post">
      <input type="submit" name="redirect" value="Proceed to HomePage and Fill in details">
        </form>
  
  <?php
  if (isset($_POST['redirect'])) {
      // Redirecting back to index.php
      header("Location: index.php");
      exit; // Ensure that subsequent code is not executed after redirection
  }
  
    } elseif ($ResultCode == '0') {
      $massage = "0 The transaction is successfully";
      echo "Opening Barrier";
      
      $fileContent = file_get_contents("data2.txt");
      if ($fileContent !== false) {
    $decodedData = json_decode($fileContent, true);
    if ($decodedData) {
    $PhoneNo=$decodedData['PhoneNo'];
    $parkingNumber=$decodedData['ParkingNumber'];
    $Fee=$decodedData['Fee'];
    $Finalquery="update parking_details SET Payment_Status = 'PAID' WHERE Parking_Number= ".$parkingNumber .";";
    $result10 = $conn->query( $Finalquery );
      
      $query1 = "select Time_In FROM Parking_Details WHERE Parking_Number =" .$parkingNumber .";";
      $result1 = $conn->query( $query1 );
      $timein1 =$result1->fetch_assoc();
      $timein=stripslashes( $timein1["Time_In"] );
      $query2 = "select Time_Out FROM Parking_Details WHERE Parking_Number =" .$parkingNumber .";";
      $result2 = $conn->query( $query2 );
      $timeout1 =$result2->fetch_assoc();
      $timeout=stripslashes( $timeout1["Time_Out"] );
      $query3 = "select Time_Spent FROM Parking_Details WHERE Parking_Number =" .$parkingNumber .";";
      $result3 = $conn->query( $query3 );
      $timespent1 =$result3->fetch_assoc();
      $timespent=stripslashes( $timespent1["Time_Spent"] );
      ?> 
      
      <?php
      $query4 = "select Fee FROM Parking_Details WHERE Parking_Number =" .$parkingNumber .";";
      $result4 = $conn->query( $query4 );
      $Fee1=$result4->fetch_assoc();
      $Fee =stripslashes( $Fee1["Fee"] );
  
      
      $CustomerQ="insert into customer_table(Parking_Number, Phone_Number, TimeIn, TimeOut, SPENT,FEE) values ( ".$parkingNumber.", ".$PhoneNo.", '".$timein."', '".$timeout."','".$timespent."',$Fee);";
      $Stormzy=$conn->query( $CustomerQ );
      echo "<br>";
      
      ?>
      <form method="post">
      <input type="submit" name="redirect" value="Thanks for Prking With us">
      </form>
  
  <?php
  if (isset($_POST['redirect'])) {
      // Redirecting back to index.php
      header("Location: index.php");
      exit; // Ensure that subsequent code is not executed after redirection
  }
  
   
    }
  }
  
  
  }
}}}
?>
<br>
                    

                
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