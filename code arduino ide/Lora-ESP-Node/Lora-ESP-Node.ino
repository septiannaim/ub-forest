#include <DHT.h>
#include <TinyGPS++.h>
#include <HardwareSerial.h>

#define DHTPIN 18
#define DHTTYPE DHT22
#define VIBRATION_PIN 25   // Pindah ke pin interrupt-capable
#define MAGNETIC_PIN 15
#define PIR_PIN 27

DHT dht(DHTPIN, DHTTYPE);
TinyGPSPlus gps;
HardwareSerial gpsSerial(2);      // UART2: RX=16, TX=17
HardwareSerial sensorSerial(1);   // UART1: RX=4, TX=5

// ===== Variabel untuk hitung frekuensi getaran =====
volatile unsigned long vibrationCount = 0;
unsigned long lastMillis = 0;
float vibrationHz = 0.0;

// ISR (Interrupt Service Routine) untuk hitung pulsa getaran
void IRAM_ATTR countVibration() {
  vibrationCount++;
}

void setup() {
  Serial.begin(115200);
  gpsSerial.begin(9600, SERIAL_8N1, 16, 17);     // GPS
  sensorSerial.begin(115200, SERIAL_8N1, 4, 5);  // Ke LoRa sender

  dht.begin();

  pinMode(VIBRATION_PIN, INPUT);
  pinMode(MAGNETIC_PIN, INPUT_PULLUP);
  pinMode(PIR_PIN, INPUT_PULLDOWN);

  attachInterrupt(digitalPinToInterrupt(VIBRATION_PIN), countVibration, RISING);
}

void loop() {
  // Baca GPS
  while (gpsSerial.available() > 0) {
    gps.encode(gpsSerial.read());
  }

  // Hitung frekuensi getaran tiap 1 detik
  if (millis() - lastMillis >= 1000) {
    noInterrupts();
    vibrationHz = vibrationCount;  // Jumlah pulsa dalam 1 detik = Hz
    vibrationCount = 0;
    interrupts();
    lastMillis = millis();
  }

  // Baca status sensor digital
  int door = digitalRead(MAGNETIC_PIN);
  int pir  = digitalRead(PIR_PIN);

  // Baca suhu & kelembapan
  float temperature = dht.readTemperature();
  float humidity    = dht.readHumidity();

  if (isnan(temperature)) temperature = 0.0;
  if (isnan(humidity))    humidity    = 0.0;

  door = (door == HIGH || door == LOW) ? door : HIGH;
  String doorStatus = (door == LOW) ? "tertutup" : "terbuka";
  String pirStatus  = (pir  == HIGH) ? "Ada Gerakan" : "Tidak Ada Gerakan";

  double latitude  = gps.location.isValid() ? gps.location.lat() : -7.955972;
double longitude = gps.location.isValid() ? gps.location.lng() : 112.615999;

  // Susun JSON
  String jsonData = "{";
  jsonData += "\"device_id\":1,";
  jsonData += "\"suhu\":"       + String(temperature, 2) + ",";
  jsonData += "\"kelembapan\":" + String(humidity, 2)    + ",";
  jsonData += "\"getaran\":"    + String(vibrationHz, 1) + ",";
  jsonData += "\"pintu_status\":\"" + doorStatus + "\",";
  jsonData += "\"latitude\":"   + String(latitude, 7)    + ",";
  jsonData += "\"longitude\":"  + String(longitude, 7)   + ",";
  jsonData += "\"pir\":\""      + pirStatus + "\"";
  jsonData += "}";

  // Kirim via UART ke LoRa sender
  sensorSerial.println(jsonData);

  // Debug ke Serial Monitor
  Serial.println("Kirim ke LoRa sender:");
  Serial.println(jsonData);

  delay(2000);
}
