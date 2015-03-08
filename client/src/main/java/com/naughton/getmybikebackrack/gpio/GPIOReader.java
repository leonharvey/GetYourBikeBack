package com.naughton.getmybikebackrack.gpio;

import com.naughton.getmybikebackrack.mqtt.MqttClientCommunication;

public class GPIOReader {
	
	private MqttClientCommunication mqtt;
	
	/*public void start() {
		 GPIO.begin(); // important  
	        GPIO.pinMode(10, GPIO.INPUT);
	        GPIO.pinMode(13, GPIO.OUTPUT);
	        int count=0;
	        while(count<1000) {  
	            boolean digitalRead = GPIO.digitalRead(10);
	            GPIO.digitalWrite(13, true);
	            if(!digitalRead){
	            	System.out.println("Sensor detected");
	            }else{
	            	System.out.println("No sensor detected");
	            }
	            try {  
	                Thread.sleep(2000);  
	            } catch (InterruptedException ex) {  
	            } 
	            GPIO.digitalWrite(13, false);
	            try {  
	                Thread.sleep(1000);  
	            } catch (InterruptedException ex) {  
	            }  
	            count++;
	        }  
	        GPIO.cleanUp(); // optional  
	}*/
	
	public void start() {
		 GPIO.begin(); // important  
	        GPIO.pinMode(10, GPIO.INPUT);
	        while(true) {  
	            boolean digitalRead = GPIO.digitalRead(10);
	            if(!digitalRead){
	            	System.out.println("Sensor detected");
	            	mqtt.sendMessage();
	            }else{
	            	System.out.println("No sensor detected");
	            }
	        }  
	}

	public void setReader(MqttClientCommunication mqtt) {
		this.mqtt=mqtt;
	}
}
