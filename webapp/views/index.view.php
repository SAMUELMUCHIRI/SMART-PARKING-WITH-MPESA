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
            <form  id="parkingForm" action="details.php" method="post" >
                <h1><label for="Smart Parking System">Smart Parking System</label></h1>        
                <?php
                echo "<p><h3><span style=\"color: #4fb542;\">SYSTEM ONLINE</span> </h3></p>";
                //define("PROJECT_API_KEY","hello world");
                date_default_timezone_set('Africa/Nairobi');
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
                echo"Database Online";
                echo "<br>";
                $query11 = "select IR1 FROM system_status ;";
                $query22 = "select IR2 FROM system_status ;";
                $query33 = "select IR3 FROM system_status ;";
                $query44 = "select IR4 FROM system_status ;";
                $result11 = $conn->query( $query11 );
                $result22 = $conn->query( $query22 );
                $result33 = $conn->query( $query33 );
                $result44 = $conn->query( $query44 );
                $slot11 =$result11->fetch_assoc();
                $slot22 =$result22->fetch_assoc();
                $slot33 =$result33->fetch_assoc();
                $slot44 =$result44->fetch_assoc();
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $data = array(
                      'sendval1' => $_POST['sendval1'],
                      'sendval2' => $_POST['sendval2'],
                      'sendval3' => $_POST['sendval3'],
                      'sendval4' => $_POST['sendval4']
                    );
                  
                    $jsonContent = json_encode($data, JSON_PRETTY_PRINT);
                    $logFile = "data_log.txt";
                    file_put_contents($logFile, $jsonContent);
                  
                    echo "Values uploaded successfully to data_log.txt";
                  } else {
                    //echo "Invalid request method";
                  
                    // Read the data_log.txt file and display the latest values
                    $fileContent = file_get_contents("data_log.txt");
                    if ($fileContent !== false) {
                      $decodedData = json_decode($fileContent, true);
                      if ($decodedData) {
                        $IR1=$decodedData['sendval1'];
                        $IR2=$decodedData['sendval2'];
                        $IR3=$decodedData['sendval3'];
                        $IR4=$decodedData['sendval4'];
                     

                        //$sql = "INSERT INTO system_status (IR1, IR2 , IR3 ,IR4 ) VALUES ($IR1 ,$IR2 , $IR2 ,$IR4)";
                        $sql="UPDATE system_status SET IR1=$IR1,IR2=$IR2,IR3=$IR3,IR4=$IR4" ;
                    
                        if ($conn->query($sql) === TRUE) {
                            echo "<br>";
        
                        //echo "Data inserted successfully";
                        } else {
                            echo "<br>";
                        echo "Error: " . $sql . "<br>" . $conn->error;
                        
                    }
                      } else {
                        echo "<br>No valid data found in data_log.txt";
                      }
                    } else {
                      echo "<br>Unable to read data_log.txt";
                    }
                  }
                  echo '<meta http-equiv="refresh" content="30">';
     
                echo "<br>";
                
                $query1 = "select IR1 FROM system_status ;";
                $query2 = "select IR2 FROM system_status ;";
                $query3 = "select IR3 FROM system_status ;";
                $query4 = "select IR4 FROM system_status ;";
                $result1 = $conn->query( $query1 );
                $result2 = $conn->query( $query2 );
                $result3 = $conn->query( $query3 );
                $result4 = $conn->query( $query4 );
                $slot1 =$result1->fetch_assoc();
                $slot2 =$result2->fetch_assoc();
                $slot3 =$result3->fetch_assoc();
                $slot4 =$result4->fetch_assoc();
                echo "PARKING";
                echo "<br>";
                
                if(stripslashes($slot1['IR1'])== 0){
                    echo" SLOT 1 : FULL";
                    if((stripslashes($slot11['IR1'])== 1) and ($IR1==0)){
                        $date_time = date("Y-m-d H:i:s"); 
                        $current_date_time=strval($date_time);
                        $query5="UPDATE parking_details SET Time_In = '$current_date_time'  WHERE Parking_Number =1";
                        $conn->query($query5);

                    }else{
                 
                    }
                    
                }else{
                    echo"SLOT 1 :EMPTY";
                    if((stripslashes($slot11['IR1'])== 0) and ($IR1==1)){
                        $date_time = date("Y-m-d H:i:s"); 
                        $current_date_time=strval($date_time);
                        $query5="UPDATE parking_details SET Time_Out = '$current_date_time' WHERE Parking_Number =1";
                        $conn->query($query5);
                    } else{
                   }}
                echo "<br>";
                if(stripslashes($slot2['IR2'])== 0){
                    echo" SLOT 2 : FULL";
                    if((stripslashes($slot22['IR2'])== 1) and ($IR2==0)){
                        $date_time = date("Y-m-d H:i:s"); 
                    $current_date_time=strval($date_time);
                    $query6="UPDATE parking_details SET Time_In ='$current_date_time' WHERE Parking_Number =2 ";
                    $conn->query($query6);

                    }else{
                    }
                 }else{
                    echo"SLOT 2 :EMPTY";
                    if((stripslashes($slot22['IR2'])== 0) and ($IR2==1)){
                        $date_time = date("Y-m-d H:i:s"); 
                        $current_date_time=strval($date_time);
                        $query6="UPDATE parking_details SET Time_Out ='$current_date_time' WHERE Parking_Number =2 ";
                        $conn->query($query6);

                    } else{
                  }
                }
                echo "<br>";
                if(stripslashes($slot3['IR3'])== 0){
                    echo" SLOT 3 : FULL";
                    if((stripslashes($slot33['IR3'])== 1) and ($IR3==0)){
                        $date_time = date("Y-m-d H:i:s"); 
                        $current_date_time=strval($date_time);
                        $query7="UPDATE parking_details SET Time_In ='$current_date_time' WHERE Parking_Number =3 ";
                        $conn->query($query7);

                    }else{
              
                    }
                 }else{
                    echo"SLOT 3 :EMPTY";
                    if((stripslashes($slot33['IR3'])== 0) and ($IR3==1)){
                        $date_time = date("Y-m-d H:i:s"); 
                        $current_date_time=strval($date_time);
                        $query7="UPDATE parking_details SET Time_Out ='$current_date_time' WHERE Parking_Number =3";
                        $conn->query($query7);

                    } else{
                  
                    }
                }
                echo "<br>";
                if(stripslashes($slot4['IR4'])== 0){
                    echo" SLOT 4 : FULL";
                    if((stripslashes($slot44['IR4'])== 1) and ($IR4==0)){
                        $date_time = date("Y-m-d H:i:s"); 
                        $current_date_time=strval($date_time);
                        $query8="UPDATE parking_details SET Time_In ='$current_date_time' WHERE Parking_Number = 4";
                        $conn->query($query8);

                    }else{
         
                    }
                    
                 }else{
                    
                    echo"SLOT 4 :EMPTY";
                    if((stripslashes($slot44['IR4'])== 0) and ($IR4==1)){
                        $date_time = date("Y-m-d H:i:s"); 
                        $current_date_time=strval($date_time);
                            $query8="UPDATE parking_details SET Time_Out ='$current_date_time' WHERE Parking_Number = 4";
                            $conn->query($query8);

                    } else{
                 
                    }}
                
        
          

                //echo "Parking Spots: AREA 1 :".$slot1."AREA 2 :".$slot2."AREA 3 :".$slot3."AREA 4 :".$slot4."  ";
                
                ?>
                
                
                <br>
                <label for="parking_number">Parking Number:</label>
                <input type="text" name="parking_number" value=" " required><br>
                 
              <label for="PhoneNumber1 ">Phone Number :</label>
              <input type="text" name="PhoneNumber" value=" " required><br>


        

                <input type="submit" name="submit" value="Calculate Fee">
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
    
<script>
    document.getElementById('parkingForm').addEventListener('parking_number', function(event) {
        // Prevent the form from submitting by default
        event.preventDefault();

        // Get the value entered in the parking_number field
        var parkingInput = document.getElementById('parking_number').value;

        // Check if the input value is within the range of 1 to 4
        if (parkingInput >= 1 && parkingInput <= 4) {
            // If the input is within the range, submit the form
            this.submit();
        } else {
            // If the input is not within the range, display an alert
            alert('Please enter a parking number between 1 and 4.');
        }
    });
</script>
</body>
</html>