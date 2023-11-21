#include <Servo.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>



// Set WiFi credentials
const char* ssid = "Ivannah";
const char* password = "Petcol0049";
const char* serverIP = "192.168.0.111";  // Replace with your server's IP address
const int serverPort = 80;
Servo myservo; 
// REPLACE with your Domain name and URL path or IP address with path
const char* serverName = "http://192.168.0.111/TEST/index.php";


// Set the LCD address to 0x3F for a 20 chars and 4 line display

LiquidCrystal_I2C lcd(0x3F, 20, 4);
int I2C_SDA=3;
int I2C_SCL=1;


// create servo object to control a servo
// Define the pin number for the IR sensor
const int EntryPin = 0;
const int ExitPin = 5;
const int irSensorPin1 = 2;
const int irSensorPin2 = 12;
const int irSensorPin3 = 13;
const int irSensorPin4 = 14;
String sendval1, sendval2, sendval3, sendval4 ,postData;

void setup() {
  
  //Serial.begin(115200);
  Wire.begin(I2C_SDA, I2C_SCL);
  // Begin WiFi
  
  lcd.init();  
  // Turn on the backlight (if available)
  lcd.backlight();
  lcd.setCursor(0, 0);
  lcd.print(" SMART PARKING ");
  delay(500);

  pinMode(EntryPin, INPUT);
  pinMode(ExitPin, INPUT);
  pinMode(irSensorPin1, INPUT);
  pinMode(irSensorPin2, INPUT);
  pinMode(irSensorPin3, INPUT);
  pinMode(irSensorPin4, INPUT);
  myservo.attach(4);  // attaches the servo on pin 4
  lcd.clear();
  //configure the mode
  /*
  WiFi.mode(WIFI_AP);
//name for the access point and 8 character password
  WiFi.softAP("ESP001", "<1-to-9>");
  lcd.setCursor( 0 ,0);
  lcd.print("Wifi : ESP001");
  lcd.setCursor(0, 1);
  lcd.print("Password : <1-to-9>");
  delay(2500);
      while (WiFi.softAPgetStationNum() !=1){ //loop here while no AP is connected to this station
      //Serial.print(".");
      delay(100);                           
      }
  delay(500);
  
  lcd.clear();
*/

      // Connecting to WiFi...
  
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
  


 
 }
 void sendSensorValues() {
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

    return;
  }

  Serial.println("Connected to server");
  int sensorValue1 = digitalRead(EntryPin);
  int sensorValue2 = digitalRead(ExitPin);
  int sensorValue3 = digitalRead(irSensorPin1);
  int sensorValue4 = digitalRead(irSensorPin2);
  int sensorValue5 = digitalRead(irSensorPin3);
  int sensorValue6 = digitalRead(irSensorPin4);
  int AvailableParking=sensorValue3+sensorValue4+sensorValue5+sensorValue6;

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
  if (AvailableParking > 0) 
{
  //lcd.clear();
  lcd.setCursor(0, 1);
  lcd.print("                  ");
  lcd.setCursor(3, 0);
  lcd.print("park space");
  lcd.setCursor(16, 0);
  lcd.print(AvailableParking);
  lcd.setCursor(0, 2);
  lcd.print(" 1     2    3    4");
  if (sensorValue3==0)
  {
    lcd.setCursor(0, 3);
    lcd.print("FULL");
  } else
  {
    lcd.setCursor(0, 3);
    lcd.print("EMTY");
  }
    if (sensorValue4==0)
  {
    lcd.setCursor(5, 3);
    lcd.print("FULL");
  } else
  {
    lcd.setCursor(5, 3);
    lcd.print("EMTY");
  }
    if (sensorValue5==0)
  {
    lcd.setCursor(10, 3);
    lcd.print("FULL");
  } else
  {
    lcd.setCursor(10, 3);
    lcd.print("EMTY");
  }
    if (sensorValue6==0)
  {
    lcd.setCursor(16, 3);
    lcd.print("FULL");
  } else
  {
    lcd.setCursor(16, 3);
    lcd.print("EMTY");
  }

  if ((sensorValue1 == 0) ^ (sensorValue2 == 0))
  {
   OpenBarrier();
  } 

}else 
{
  lcd.clear();
  lcd.setCursor(0, 1);
  lcd.print("  Parking  Full  ");

  if (sensorValue2 == 0)
  {
    OpenBarrier();  
  }
  //delay(300);
  //lcd.setCursor(0, 0);
  //lcd.clear();

}

  

  while (client.available()) {
    String line = client.readStringUntil('\n');
    Serial.println(line); // Print each line of the server response
  }
  
  client.stop();
}


void loop() 
{
sendSensorValues();
  
}

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