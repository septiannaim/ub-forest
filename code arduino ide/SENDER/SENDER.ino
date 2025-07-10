#include <SPI.h>
#include <LoRa.h>

#define SS 15
#define RST 0
#define DIO0 27

HardwareSerial sensorSerial(2);  // UART2 (RX16, TX17)

void setup() {
  Serial.begin(115200);
  sensorSerial.begin(115200, SERIAL_8N1, 16, 17);  // UART2 pins

  SPI.begin(14, 12, 13, SS);
  LoRa.setPins(SS, RST, DIO0);

  Serial.println("Initializing LoRa Sender...");

  if (!LoRa.begin(900E6)) {
    Serial.println("LoRa init failed!");
    while (true);
  }

  LoRa.setSpreadingFactor(10);
  LoRa.setSyncWord(0xF3);
  LoRa.enableCrc();

  Serial.println("LoRa Sender Ready!");
}

void loop() {
  if (sensorSerial.available()) {
    String jsonData = sensorSerial.readStringUntil('\n');
    jsonData.trim();

    if (jsonData.length() > 0) {
      Serial.println("Sending data via LoRa: " + jsonData);
      LoRa.beginPacket();
      LoRa.print(jsonData);
      LoRa.endPacket();
      Serial.println("Data sent");
    }
  }
  delay(100);
}
