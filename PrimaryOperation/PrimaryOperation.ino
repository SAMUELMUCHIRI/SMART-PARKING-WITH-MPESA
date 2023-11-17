#include <Servo.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClient.h>


// Set WiFi credentials
#define WIFI_SSID "Ivannah"
#define WIFI_PASS "Petcol0049"
const char* serverAddress = " 0.0.0.0"; // Use your computer's local IP address
const int serverPort = 80; // Port of your local server (usually 80 for HTTP)

const char* host="192.168.0.111";//LOCAL IPv4 ADDRESS...ON CMD WINDOW TYPE ipconfig/all
const uint16_t port=80;//PORT OF THE LOCAL SERVER
 WiFiClient client;
Servo myservo; 
// REPLACE with your Domain name and URL path or IP address with path
const char* serverName = "http://192.168.0.116/TEST/index.php";


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
  
  WiFi.begin(WIFI_SSID, WIFI_PASS);
  lcd.setCursor(0, 0);
  lcd.print("Connecting to ");
  lcd.setCursor(0, 2);
  lcd.print(WIFI_SSID);
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
  delay(2500);
  lcd.clear();
  //server response
  
  // Perform HTTP GET request

 

  HTTPClient http;
  String dataToSend = "HelloFromNodeMCU";
  String url = "http://" + String(serverAddress) + "/TEST/index.php?data=" + dataToSend;
  http.begin(client ,url);

  int httpResponseCode = http.GET();
  if (httpResponseCode > 0) {
    //Serial.print("HTTP Response code: ");
    //Serial.println(httpResponseCode);
    String payload = http.getString();
    //Serial.println("Response payload: " + payload);
  } else {
    //Serial.print("Error in HTTP request: ");
    //Serial.println(httpResponseCode);
  }
  http.end();





  delay(1500);
  lcd.clear();
 }
     
  //delay(1000);


void loop() {
  // Read and print the value from the IR sensor
 int sensorValue1 = digitalRead(EntryPin);
  int sensorValue2 = digitalRead(ExitPin);
  int sensorValue3 = digitalRead(irSensorPin1);
  int sensorValue4 = digitalRead(irSensorPin2);
  int sensorValue5 = digitalRead(irSensorPin3);
  int sensorValue6 = digitalRead(irSensorPin4);
  int AvailableParking=sensorValue3+sensorValue4+sensorValue5+sensorValue6;

  //server stuff
  HTTPClient http;    // http object of clas HTTPClient
  // Convert to float
  sendval1 = float(sensorValue3);
  sendval2 = float(sensorValue4); 
  sendval3 = float(sensorValue5); 
  sendval4 = float(sensorValue6); 
  String PROJECT_API_KEY= "hello world";
        

  postData="api_key"+PROJECT_API_KEY;
  postData+="&sendval=" + String(sensorValue3);
  postData+="&sendval2=" + String(sensorValue4);
  postData+="&sendval3=" + String(sensorValue5);
  postData+="&sendval4=" + String(sensorValue6);

  //TestData ="api_key=" String(PROJECT_API_KEY) + "&sendval=" + String(sensorValue3) + "&sendval2=" + String(sensorValue4) + "&sendval3=" + String(sensorValue5) + "&sendval4=" + String(sensorValue6);
  // We can post values to PHP files as  example.com/dbwrite.php?name1=val1&name2=val2
  // Hence created variable postData and stored our variables in it in desired format
  // Update Host URL here:-
/*
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
     //tring serverPath = serverName + "?temperature=24.37";
      String AserverPath="http://192.168.0.116/TEST/index.php";
      // Your Domain name with URL path or IP address with path
      http.begin(client, "http://192.168.0.116:80/test/index.php" );
    //http.begin(client , ); // Replace with your PHP script URL
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    // Prepare data to send


    int httpResponseCode = http.POST(postData);
    if (httpResponseCode == 200) {
      String response = http.getString();
      //lcd.print("HTTP Response code: " + String(httpResponseCode));
      delay(30);
      lcd.clear();
      lcd.setCursor(0, 3);
      lcd.print("POST SUCCESS");
      delay(50);
      lcd.clear();
    } else {
      lcd.setCursor(0, 3);
      lcd.print("Error POST FAIL");
      delay(50);
      lcd.clear();
    }

    http.end();
  }
*/
//server end
  if (AvailableParking > 0) {
    lcd.setCursor(0, 0);
  lcd.print("parking space  = ");
     lcd.setCursor(0, 1);
  lcd.print(AvailableParking);

  /*Serial.print("The parking space available  :");
  Serial.println(AvailableParking);*/
  if ((sensorValue1 == 0) ^ (sensorValue2 == 0)){
   OpenBarrier();
  } 

 }else {
  // Code for high sensor value
   
     lcd.setCursor(0, 0);
  lcd.print("parking  Full");
   lcd.setCursor(0, 1);
  lcd.print(".");
  
  /*Serial.println("Parking space full");*/
   if (sensorValue2 == 0){
    OpenBarrier();
  
  
}
  

  delay(3000);
 }
  //delay(1000); // Adjust delay as needed
}
void sendDataToServer() {
  if (WiFi.status() == WL_CONNECTED) {
    HTTPClient http;
    http.begin(client , "http://192.168.0.111/test/index.php"); // Replace with your PHP script URL
    http.addHeader("Content-Type", "application/x-www-form-urlencoded");

    // Prepare data to send
    String data = "sensor_value=100"; // Replace with your sensor value

    int httpResponseCode = http.POST(data);
    if (httpResponseCode > 0) {
      String response = http.getString();
      Serial.println("HTTP Response code: " + String(httpResponseCode));
      Serial.println("Server response: " + response);
    } else {
      Serial.println("Error sending POST request");
    }

    http.end();
  }
}
void OpenBarrier(){
  //myservo.write(10);
    for (int i = 40; i < 180; i++) {
    myservo.write(i); 
    delay(30);                 
  }
  delay(150);
  
    for (int i = 179; i > 40 ; i--) {
    myservo.write(i); 
    delay(30);                 
  }

  delay(30);
}