<!DOCTYPE html>
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
            background-color: #f9f9f9;
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
    <?php
    // Function to calculate the parking fee based on time
    function calculateParkingFee($entryTime, $exitTime, $ratePerHour) {
        $entryTimestamp = strtotime($entryTime);
        $exitTimestamp = strtotime($exitTime);
        $timeDifference = ($exitTimestamp - $entryTimestamp) / 3600; // Convert to hours
        $totalFee = $timeDifference * $ratePerHour;
        return $totalFee;
    }

    $parkingNumber = $entryTime = $exitTime = $totalFee = "";

    // Check if the form is submitted
    if (isset($_POST['submit'])) {
        $parkingNumber = $_POST['parking_number'];
        $entryTime = $_POST['entry_time'];
        $exitTime = $_POST['exit_time'];
        $ratePerHour = 5; // Fixed rate per hour

        // Validate input (you may want to add more validation)
        if (empty($parkingNumber) || empty($entryTime) || empty($exitTime)) {
            echo "Please fill in all fields.";
        } else {
            $totalFee = calculateParkingFee($entryTime, $exitTime, $ratePerHour);

            // Display the results and hide the form
            echo '<div class="result">';
            echo "Parking Number: $parkingNumber<br>";
            echo "Entry Time: $entryTime<br>";
            echo "Exit Time: $exitTime<br>";
            echo "Total Fee: $totalFee USD<br>";
             // Add a "Go Back" button to return to the form
             echo '<br><a href="javascript:history.back()">Go Back</a>';
            echo '</div>';
            echo '<div class="form-container" style="display: none;">';
  
        }
    }
    ?>
    <div class="container">
        <div class="form-container">
            <form method="post" action="">
                <label for="parking_number">Parking Number:</label>
                <input type="text" name="parking_number" value="<?php echo $parkingNumber; ?>" required><br>

                <label for="entry_time">Entry Time:</label>
                <input type="datetime-local" name="entry_time" value="<?php echo $entryTime; ?>" required><br>

                <label for="exit_time">Exit Time:</label>
                <input type="datetime-local" name="exit_time" value="<?php echo $exitTime; ?>" required><br>

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
</body>
</html>
