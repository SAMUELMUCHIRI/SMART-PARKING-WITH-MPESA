# SMART PARKING WITH MPESA

## Objective
The fundamental objective of this Project is to familiarize  with the principles of 
engineering design thinking, a process through which a holistic solution is conceived to address tangible, 
real-world issues. 


## The Project is divided into 
- [Hardware Design](#hardware-design)
- [Hardware Programming](#hardware-programming)
- [Database Design](#database-design)
- [Application Design](#application-design) 

## **Hardware Design**
The Components used were 
- NodeMCU ESP8266
- 5 IR sensors
- 1 servo motor
- 1 Capacitor
- Connecting cables
- Power Sockets
- Buck Converter
- Mounting frame
<br>

The components use above were incorporated into a Printed Circuit Board(pcb) .Kicad software was used to design the pcb.



**Geber File**
 
![Geber file](https://github.com/SAMUELMUCHIRI/SMART-PARKING-WITH-MPESA/blob/main/images/geber%20file.png)
<br>

**Schematic**

![Schematic ](https://github.com/SAMUELMUCHIRI/SMART-PARKING-WITH-MPESA/blob/main/images/Schematic.png)
<br>

**Routings**

![Routings](https://github.com/SAMUELMUCHIRI/SMART-PARKING-WITH-MPESA/blob/main/images/routes.png)
<br>

**3D View**

![3D view ](https://github.com/SAMUELMUCHIRI/SMART-PARKING-WITH-MPESA/blob/main/images/3d%20.png)
<br>
**Developed PCB**

![PCB](https://github.com/SAMUELMUCHIRI/SMART-PARKING-WITH-MPESA/blob/main/images/pcb.png)


## **Hardware Programming**
The sketch Primary operation contains all the code for the hardware .
The code entail 
- LCD display

```arduino
//Check the whole code this is a snippet
  Wire.begin(I2C_SDA, I2C_SCL);
  
  
  lcd.init();  
  lcd.backlight();
  lcd.setCursor(0, 0);
  lcd.print(" SMART PARKING ");

```
- Getting Values from IR sensors
```arduino
//Check the whole code this is a snippet
  int sensorValue1 = digitalRead(EntryPin);
  int sensorValue2 = digitalRead(ExitPin);
  int sensorValue3 = digitalRead(irSensorPin1);
  int sensorValue4 = digitalRead(irSensorPin2);
  int sensorValue5 = digitalRead(irSensorPin3);
  int sensorValue6 = digitalRead(irSensorPin4);

```
- Turning the servo
```arduino
//Check the whole code this is a snippet
void OpenBarrier()
{
  for (int i = 40; i < 180; i++) 
  {
  myservo.write(i); 
  delay(30);                 
  }
  delay(100);
  
  for (int i = 179; i > 40 ; i--) 
  {
  myservo.write(i); 
  delay(30);                 
  }

  delay(30);
}
```
- Connecting the Node Mcu to wifi
```arduino
//Check the whole code this is a snippet
  WiFi.begin(ssid, password);
  lcd.setCursor(0, 0);
  lcd.print("Connecting to ");
  lcd.setCursor(0, 2);
  lcd.print(ssid);
    // Loop continuously while WiFi is not connected
  while (WiFi.status() != WL_CONNECTED)
  {
    delay(100);
    lcd.setCursor(0 ,3);
    lcd.print("scanning.....");
  }
  delay(200);
  lcd.clear();
  // Connected to WiFi
  //Serial.println();

    lcd.setCursor(0, 3);
  lcd.print(WiFi.localIP());
    lcd.setCursor(0, 1);
  lcd.print("Connected!  ");
  delay(250);
  lcd.clear();
  
```
- Connecting the NodeMcu to Local host (can be changed)
```arduino
//Check the whole code this is a snippet
WiFiClient client;

  if (!client.connect(serverIP, serverPort)) {
    lcd.clear();
    lcd.setCursor(0 , 1);
    lcd.print("NO LOCALHOST");
    //Serial.println("Connection failed");
    lcd.setCursor(5 , 2);
    lcd.print("WRONG SERVERIP");
    lcd.setCursor(3 , 3);
    lcd.print(serverIP);
    delay(1000);
    lcd.setCursor(0 , 1);
    lcd.clear();
  }
```
- Transmitting sensor data from Node Mcu to Local host
```arduino
//Check the whole code this is a snippet
  String postData = "sendval1=" + String(sensorValue3) +
                    "&sendval2=" + String(sensorValue4) +
                    "&sendval3=" + String(sensorValue5) +
                    "&sendval4=" + String(sensorValue6);

  client.println("POST /index.php HTTP/1.1");
  client.print("Host: ");
  client.println(serverIP);
  client.println("Content-Type: application/x-www-form-urlencoded");
  client.print("Content-Length: ");
  client.println(postData.length());
  client.println("Connection: close");
  client.println();
  client.println(postData);
```
- Notify any errors encountered in any operation and how to solve them


## **Database Design**
 MySQL was used as the DBMS
The ER diagram is Shown Below
![Erdiagram](https://github.com/SAMUELMUCHIRI/SMART-PARKING-WITH-MPESA/blob/main/images/erdiagram.png)

## **Application Design**
The web app was wtitten in php .Queries are sent to the database as the user interacts with the application.
```php

<?php
//connction to the Database dbconnect.php

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
```
 <br>

 ```php
 //logging in data sent by the NodeMCU to the data_log.txt
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
                  }
 ```
 <br>

 ```php
 //storing contents of the log file to Database
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
                      }
                    }

 ```

<br>

```php
//Fetch values from Database 
                
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
```
```php
//the following lines of code compare values from current database value to previous database values and assigns either empty or full slot
                
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
```
 Here's the landing Homepage

![Webapp](https://github.com/SAMUELMUCHIRI/SMART-PARKING-WITH-MPESA/blob/main/images/webapp.png)


<br>

**Payment** as an integral part of the project was realized using the [**DarajaAPI**](https://developer.safaricom.co.ke/)
The Client Receives an STK push on the phone an is billed accordingly.The Payment system is able to validate transactions
the Following files are for payment
- stkpush.php
- payment.php





