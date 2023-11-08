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
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST["PhoneNumber"];
                //$email = $_POST["email"];
                echo "<p>Payment Successful , $name!</p>";
                 }
        ?>
        <a href="index.html">Back to the form</a>

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