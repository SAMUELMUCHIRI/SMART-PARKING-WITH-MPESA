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

### Hardware Design
The Components used were 
- NodeMCU ESP8266
- 5 IR sensors
- 1 servo motor
- 1 Capacitor
- Conncting cables
- Power Sockets
- Buck Converter
<br>

The components use above were incoparate into a pcb .Kicad software was used to design the pcb.



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


# Hardware Programming
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


# Database Design
 Myh SQL was used as the DBMS
The ER diagram is Shown Below
![Erdiagram](https://github.com/SAMUELMUCHIRI/SMART-PARKING-WITH-MPESA/blob/main/images/erdiagram.png)

# Application Design
The web app was wtitten in php .Queries are sent to the database as the user interacts with the application.
 <br>
 Here's the landing Homepage

![Webapp](https://github.com/SAMUELMUCHIRI/SMART-PARKING-WITH-MPESA/blob/main/images/webapp.png)




