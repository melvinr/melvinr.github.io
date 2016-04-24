//Minor Everything Web
//Course: Web of Things

#include <EIoTCloudRestApi.h>
#include <EIoTCloudRestApiConfig.h>
#include <ThingSpeak.h>
#include <ESP8266WiFi.h>


//Pins and leds with values
int pinLdr = A0;
int exposure = 0;


//Define client, use your wifi or hotspot's SSID and password
const char* ssid = "mellie";
const char* password = "159753??";
WiFiClient client;

//Keys for EIoTCloudRestApi
EIoTCloudRestApi eiotcloud;
#define LDR_ID "57039c74c943a0661cf3149d/je3efB3WsdCBwJEu"

//ThingSpeak API
const int CHANNEL_ID = 106699;
const char * API_KEY = "2QITX0H6ZFQ7RS3R";

//Setup for use
void setup() {
 Serial.begin(9600);
 eiotcloud.begin();
 ThingSpeak.begin(client);
}

void loop() {
  delay(1000);

  //Get LDR value and send to cloud
  exposure = analogRead(pinLdr);
  Serial.println(exposure);
  eiotcloud.sendParameter(LDR_ID, exposure);
   ThingSpeak.writeField(CHANNEL_ID, 2, exposure, API_KEY);
}
