#include <Servo.h>

Servo myservo;  // create servo object to control a servo
// Define the pin number for the IR sensor
const int EntryPin = 2;
const int ExitPin = 3;
const int irSensorPin1 = 4;
const int irSensorPin2 = 5;
const int irSensorPin3 = 6;
const int irSensorPin4 = 7;

void setup() {
  Serial.begin(9600);
  pinMode(EntryPin, INPUT);
  pinMode(ExitPin, INPUT);
  pinMode(irSensorPin1, INPUT);
  pinMode(irSensorPin2, INPUT);
  pinMode(irSensorPin3, INPUT);
  pinMode(irSensorPin4, INPUT);
  myservo.attach(9);  // attaches the servo on pin 9
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
  Serial.print("The parking space available  :");
  Serial.println(AvailableParking);
  if ((sensorValue1 == 0) ^ (sensorValue2 == 0)){
    OpenBarrier();
  } 

 }else {
  // Code for high sensor value
  Serial.println("Parking Space full");
   if (sensorValue2 == 0){
    OpenBarrier();
  } 
  
}
  

  
  delay(1000); // Adjust delay as needed
}

void OpenBarrier(){
  //myservo.write(10);
    for (int i = 0; i < 180; i++) {
    myservo.write(i); 
    delay(30);                 
  }
  delay(1500);
    for (int i = 179; i > 0 ; i--) {
    myservo.write(i); 
    delay(30);                 
  }
  //delay(1000);
  
 
}

