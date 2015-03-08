package com.naughton.getmybikebackrack.rfid;

import com.naughton.getmybikebackrack.mqtt.MqttClientCommunication;

/**
 * Will have a listener either for serial or setup a TCP listener
 * 
 * @author martin
 *
 */
public class Reader {

	private MqttClientCommunication mqtt;

	public void start() {
		System.out.println("Starting read");
		int count =0;
		while(count<2){
			System.out.println("Counting"+count);
			mqtt.sendMessage();
			count++;
			try {
				Thread.sleep(1000);
			} catch (InterruptedException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}
		}
		
		
	}

	public void setReader(MqttClientCommunication mqtt) {
		this.mqtt = mqtt;
		
	}

}
