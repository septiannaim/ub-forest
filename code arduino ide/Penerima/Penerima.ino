#include <SPI.h>
#include <LoRa.h>
#include <WiFi.h>
#include <HTTPClient.h>

#define SS 15
#define RST 0
#define DIO0 27

const char* ssid = "Persetan";
const char* password = "1234567899";

const char* serverUrl = "http://192.168.117.188:8000/api/sensor-data";

void setup() {
  Serial.begin(115200);

  // WiFi connect
  WiFi.begin(ssid, password);
  Serial.print("Connecting to WiFi");
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("\nWiFi connected");

  // LoRa init
  SPI.begin(14, 12, 13, SS);
  LoRa.setPins(SS, RST, DIO0);

  Serial.println("Initializing LoRa Receiver...");
  if (!LoRa.begin(900E6)) {
    Serial.println("LoRa init failed!");
    while (true);
  }

  LoRa.setSpreadingFactor(10);
  LoRa.setSyncWord(0xF3);
  LoRa.enableCrc();

  Serial.println("LoRa Receiver Ready!");
}

void loop() {
  int packetSize = LoRa.parsePacket();
  if (packetSize) {
    String received = "";
    while (LoRa.available()) {
      received += (char)LoRa.read();
    }
    Serial.print("Data received via LoRa: ");
    Serial.println(received);

    // Kirim ke server
    if (WiFi.status() == WL_CONNECTED) {
      HTTPClient http;
      http.begin(serverUrl);
      http.addHeader("Content-Type", "application/json");

      int httpResponseCode = http.POST(received);

      if (httpResponseCode > 0) {
        String response = http.getString();
        Serial.println("Server response: " + response);
      } else {
        Serial.println("Error sending POST: " + String(httpResponseCode));
      }
      http.end();
    } else {
      Serial.println("WiFi disconnected, cannot send data");
    }
  }
  delay(100);
}
