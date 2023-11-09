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
            <form action="details.php" method="post" >
                <h1><label for="Smart Parking System">Smart Parking System</label></h1>        
                <?php
                echo "<p><h3><span style=\"color: #4fb542;\">SYSTEM ONLINE</span> </h3></p>";
                //echo "<br>";
                echo "<h3>Parking Spots: 4 </h3>";
                
                ?>
                
                
                <br>
                <label for="parking_number">Parking Number:</label>
                <input type="text" name="parking_number" value=" " required><br>

        

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