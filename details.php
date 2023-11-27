<!DOCTYPE html>
<html>
<head>
<title>Parking Details</title>
    <style>
        body {
            background-color: #f0f0f0; /* Set your desired background color */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .code-container {
            background-color: #b3ccff; /* Set your desired background color for the code container */
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="code-container">
    <?php
    // Function to calculate the parking fee based on time
  


    $parkingNumber = $entryTime = $exitTime = $totalFee = "";

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        $parkingNumber = $_POST['parking_number'];
        $PhoneNo = $_POST["PhoneNumber"];

                // File 1: sending.php
        //$variableToSend = "Hello";
       // $encodedVar = urlencode($PhoneNo); 
       

        // Validate input (you may want to add more validation)
        if (empty($parkingNumber) and empty($PhoneNo)) {
            echo "Please fill  fields.";
        } else {
            echo " ";
            //$totalFee = round(calculateParkingFee($entryTime, $exitTime, $ratePerHour));

            
            // Display the results and hide the form
            echo '<div class="result">';
            ?>
            <h1>Smart Parking System </h1>
            <br>
            <h3>Billing Page</h3>
            <?php
            $host="localhost";
            $dbname="smart_parking";
            $username="root";
            $password= "";
            $conn=mysqli_connect(hostname: $host,
                                    username: $username,    
                                    password: $password , 
                                    database: $dbname);
            if(mysqli_connect_errno()){
                die("Connection Error". mysqli_connect_error());}
            //echo"Database Online";
            
            
            $query = "select Time_In FROM Parking_Details WHERE Parking_Number =" .$parkingNumber .";";
            $result = $conn->query( $query );
      
            
            $timedb =$result->fetch_assoc();


            echo "Parking Number: $parkingNumber<br>";
       
            echo "Entry time is   "; 
            echo  stripslashes($timedb['Time_In']);

            echo '<br>';            
            $query1 = "select Time_Out FROM Parking_Details WHERE Parking_Number =" .$parkingNumber .";";
            $result1 = $conn->query( $query1 );
            $timeoutdb =$result1->fetch_assoc();
            echo "Exit time is ". stripslashes($timeoutdb['Time_Out']).' ';
            echo '<br>';            
            $query2 = "select TIMEDIFF(Time_Out ,Time_In) AS time_difference FROM Parking_Details WHERE Parking_Number =" .$parkingNumber .";";
            $result2 = $conn->query( $query2 );
            //$timespentdb =$result2->fetch_assoc();

            if ($result2->num_rows > 0) {
                // Output data of each row
                while($row = $result2->fetch_assoc()) {
                    echo "Time Difference: " . $row["time_difference"] . "<br>";
                    $Timestore=$row["time_difference"];
                    $Tquery="update parking_details SET Time_Spent='$Timestore' ,Payment_Status = 'PENDING' WHERE Parking_Number= ".$parkingNumber .";";
                    $result10 = $conn->query( $Tquery );
                }
            } else {
                echo "0 results";
            }

            echo "<br>";
            $query3 = "select TIMESTAMPDIFF(SECOND, Time_In ,Time_Out) AS time_difference_seconds FROM Parking_Details WHERE Parking_Number =" .$parkingNumber .";";
            $result3 = $conn->query( $query3 );
            //$timespentdb =$result2->fetch_assoc();

            
            if ($result3->num_rows > 0) {
                // Output data of each row
                while($row1 = $result3->fetch_assoc()) {
                    //echo "Time Difference in Seconds: " . $row1["time_difference_seconds"] . "<br>";
                    //start
                    $query4 = "select Time_DurationStart FROM charging_rates;";
                    $query5 = "select Charge FROM charging_rates;";
                    $result4 = $conn->query( $query4 );
                    $result5 = $conn->query( $query5 );
                    //$timespentdb =$result2->fetch_assoc();
        
                    $timeref =$result4->fetch_assoc();
                    $timecharge =$result5->fetch_assoc();
                    //echo " time ref is ". stripslashes($timeref['Time_DurationStart']).' ';
                    //echo '<br>';
                    //echo " time Charge is ". stripslashes($timecharge['Charge']).' ';
                    $fee=($row1["time_difference_seconds"]/stripslashes($timeref['Time_DurationStart']))*stripslashes($timecharge['Charge']);
                    //echo '<br>';
                    echo "Parking Fee  : KSH ".round($fee) ."";
                    $vp=strval(round($fee));

                    $Pquery="update parking_details SET Fee = ".$vp."  WHERE Parking_Number= ".$parkingNumber .";";
                    $resultPquery = $conn->query( $Pquery );
                    $data1 = array(
                        'ParkingNumber' => $parkingNumber,
                        'PhoneNo' => $PhoneNo,
                        'Fee' => $vp                    
                      );
                    $jsonContent = json_encode($data1, JSON_PRETTY_PRINT);
                    $logFile = "data2.txt";
                    file_put_contents($logFile, $jsonContent);
                  
                                       
                   
                    //end
                    
                }
            } else {
                echo "0 results";
            }
            
            
            //echo "Time Spent :".($timespentdb("time_difference")).' ';
            
           //echo "Total Time Spent :". $exitTime-$entryTime. '';
            
          
             // Add a "Go Back" button to return to the form
            ?>
             <form action="stkpush.php" method="post" >
             
             <input type="hidden" name="data" value="<?php echo $PhoneNo; ?>">
          

          
              <input type="submit" name="submit" value=" Lipa na Mpesa ">
              
             
    
          
              
          </form>
            <?php
            echo '<br><a href="javascript:history.back()">Go Back</a>';
          
            
  
        }
    } else{}
    ?>
    
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