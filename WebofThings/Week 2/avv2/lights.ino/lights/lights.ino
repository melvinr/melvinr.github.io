#include <ArduinoJson.h>
#include <ESP8266WiFi.h>

const char* ssid     = "AllKindzzz";
const char* password = "Boelers159753!";

const char* host     = "www.besem.nl"; // Your domain  
String path          = "/data/melvin.json";  
const int pin        = BUILTIN_LED;
const int pinLDR     = A0;

void setup() {
 pinMode(pin, OUTPUT); 
 pinMode(pin, HIGH);
 Serial.begin(9600);

 delay(10);
 Serial.print("Connecting to ");
 Serial.println(ssid);

 WiFi.begin(ssid, password);
 int wifi_ctr = 0;
 while (WiFi.status() != WL_CONNECTED) {
   delay(500);
   Serial.print(".");
 }

 Serial.println("WiFi connected");  
 Serial.println("IP address: " + WiFi.localIP());
}

void loop() {  
 getNetworkData();
 sendNetworkData();
}

void getNetworkData() {
 
 Serial.print("connecting to ");
 Serial.println(host);
 WiFiClient client;
 if (!client.connect(host, 80)) {
   Serial.println("connection failed");
   return;
 }

 client.print(String("GET ") + path + " HTTP/1.1\r\n" +
              "Host: " + host + "\r\n" + 
              "Connection: keep-alive\r\n\r\n");

 delay(500); // wait for server to respond

 // read response
 
 String section="header";
 while(client.available()) {

   String line = client.readStringUntil('\r');
   // we’ll parse the HTML body here
   if (section=="header") { // headers..
     Serial.print(".");
     if (line=="\n") { // skips the empty space at the beginning 
       section="json";
     }
   }
   else if (section=="json") {  // print the good stuff
     section="ignore";
     String result = line.substring(1);

     // Parse JSON
     int size = result.length() + 1;
     char json[size];
     result.toCharArray(json, size);
     StaticJsonBuffer<200> jsonBuffer;
     JsonObject& json_parsed = jsonBuffer.parseObject(json);
     if (!json_parsed.success())
     {
       Serial.println("parseObject() failed");
       return;
     }

     // Make the decision to turn off or on the LED
     if (strcmp(json_parsed["melvin"], "on") == 0) {
       digitalWrite(pin, LOW); 
       Serial.println("LED ON");
     }
     else {
       digitalWrite(pin, HIGH);
       Serial.println("led off");
     }
   }
 }
 Serial.print("closing connection. ");
}

void sendNetworkData() {

WiFiClient client;
int ldr = analogRead(pinLDR);
String PostData = "ldr="+ String(ldr);


if (client.connect("iot.mreijnoudt.com", 80)) {
 Serial.println("connected");
 client.println("POST /index.php HTTP/1.1");
 client.println("Host: iot.mreijnoudt.com");
 client.println("Content-Type: application/x-www-form-urlencoded");
 client.print("Content-Length: ");
 client.println(PostData.length());
 client.println();
 client.println(PostData);
 Serial.println(ldr);
 Serial.println("Data send");
} else {
 Serial.println("connection failed");
}
}
