//Minor Everything Web
//Course: Web of Things

#include <EIoTCloudRestApi.h>
#include <EIoTCloudRestApiConfig.h>
#include <ThingSpeak.h>
#include <ESP8266WiFi.h>


//Pins and leds with values
int pinPir = D0;
int pirState = LOW;
int val = 0;


//Define client, use your wifi or hotspot's SSID and password
const char* ssid = "MR";
const char* password = "159753!!";
WiFiClient client;

//Keys for EIoTCloudRestApi
EIoTCloudRestApi eiotcloud;
#define PIR_ID "57039c74c943a0661cf3149d/dLCRbLuCtg3NBJMP"

//ThingSpeak API
const int CHANNEL_ID = 106699;
const char * API_KEY = "2QITX0H6ZFQ7RS3R";

//Setup for use
void setup() {
 pinMode(pinPir, INPUT);
 Serial.begin(9600);
 eiotcloud.begin();
 ThingSpeak.begin(client);
}

void loop() {
  delay(1000);

//Send pir sensor's values to cloud.
 val = digitalRead(pinPir);
 ThingSpeak.writeField(CHANNEL_ID, 1, val, API_KEY);
     //If the returned value is high and pirState is low, motion has been detected, this will be sent to the cloud
     //and state will be set to high
    if (val == HIGH) {
        if (pirState == LOW) {
          Serial.println("Motion detected!");
          ThingSpeak.writeField(CHANNEL_ID, 1, val, API_KEY);
           eiotcloud.sendParameter(PIR_ID, 1);
          pirState = HIGH;
        }
    } else {
      //If the value is low and the pirState is high, there is no motion, this will be sent to the cloud
      //and state will be set to low.
        if (pirState == HIGH) {
          Serial.println("Motion ended");
          ThingSpeak.writeField(CHANNEL_ID, 1, val, API_KEY);
           eiotcloud.sendParameter(PIR_ID, 0);
          pirState = LOW;
        }
    }
}
