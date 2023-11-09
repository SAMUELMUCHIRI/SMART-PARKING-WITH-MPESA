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
    function chkEntryTime() {
        $entryTime ="";
    }

    function getParknumber() {
        
    }

    $parkingNumber = $entryTime = $exitTime = $totalFee = "";

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        $parkingNumber = $_POST['parking_number'];


        // Validate input (you may want to add more validation)
        if (empty($parkingNumber) ) {
            echo "Please fill in all fields.";
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
            echo "Parking Number: $parkingNumber<br>";
            //$entryTime=date_create_from_format('H:i:s ,d-m-Y','10:59:23 ,09-11-2023');
            $exitTime=date('H:i:s ,d-m-Y'); 
            echo "Entry time is   "; 
            echo  $entryTime;

            echo '<br>';            
                      
            echo "Exit time is ". $exitTime.' ';
            echo '<br>';            
            
           //echo "Total Time Spent :". $exitTime-$entryTime. '';
            
          
             // Add a "Go Back" button to return to the form
            ?>
             <form action="payment.php" method="post" >
              

              <label for="PhoneNumber1 ">Please Enter Your Phone Number :</label>
              <input type="text" name="PhoneNumber" value=" " required><br>

              <input type="submit" name="submit" value=" Lipa na Mpesa ">
    
          
              
          </form>
            <?php
            echo '<br><a href="javascript:history.back()">Go Back</a>';
          
            
  
        }
    }
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