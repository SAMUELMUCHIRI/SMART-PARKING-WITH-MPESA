#include <Servo.h>
#include <Wire.h>
#include <LiquidCrystal_I2C.h>

Servo myservo; 


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

void setup() {
  
  Serial.begin(115200);
 Wire.begin(I2C_SDA, I2C_SCL);
  lcd.init();  
  // Turn on the backlight (if available)
  lcd.backlight();
  lcd.setCursor(0, 0);
  lcd.print(" SMART PARKING ");
  
  pinMode(EntryPin, INPUT);
  pinMode(ExitPin, INPUT);
  pinMode(irSensorPin1, INPUT);
  pinMode(irSensorPin2, INPUT);
  pinMode(irSensorPin3, INPUT);
  pinMode(irSensorPin4, INPUT);
  myservo.attach(4);  // attaches the servo on pin 4
  delay(1000);
}

void loop() {
  // Read and print the value from the IR sensor
 int sensorValue1 = digitalRead(EntryPin);
  int sensorValue2 = digitalRead(ExitPin);
  int sensorValue3 = digitalRead(irSensorPin1);
  int sensorValue4 = digitalRead(irSensorPin2);
  int sensorValue5 = digitalRead(irSensorPin3);
  int sensorValue6 = digitalRead(irSensorPin4);
  int AvailableParking=sensorValue3+sensorValue4+sensorValue5+sensorValue6;

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
  
}
  

  
  //delay(1000); // Adjust delay as needed
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