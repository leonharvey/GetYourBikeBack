package com.naughton.getmybikebackrack;

import com.naughton.getmybikebackrack.gpio.GPIOReader;
import com.naughton.getmybikebackrack.mqtt.MqttClientCommunication;
import com.naughton.getmybikebackrack.rfid.Reader;


public class GetMyBikeBackRack {

	public static void main(String[] args) {
		MqttClientCommunication mqtt = new MqttClientCommunication();
		
		/*Reader reader = new Reader();
		reader.setReader(mqtt);
		reader.start();*/
		GPIOReader read = new GPIOReader();
		read.setReader(mqtt);
		read.start();
		
	}
}
