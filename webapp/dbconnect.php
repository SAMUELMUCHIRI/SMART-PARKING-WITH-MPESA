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

?>