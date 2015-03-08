package com.naughton.getmybikebackrack.mqtt;

import java.text.SimpleDateFormat;
import java.util.Date;

import org.eclipse.paho.client.mqttv3.MqttClient;
import org.eclipse.paho.client.mqttv3.MqttException;
import org.eclipse.paho.client.mqttv3.MqttMessage;
import org.eclipse.paho.client.mqttv3.MqttPersistenceException;
import org.json.JSONException;
import org.json.JSONObject;

/**
 * 
 * @author martin
 *
 */
public class MqttClientCommunication {
	int count=0;
	
	public void sendMessage(){
		MqttConnect mqtt = new MqttConnect();
		MqttClient connection = mqtt.connect();

		MqttMessage message = new MqttMessage(getContent().getBytes());
		int qos = 0;
		message.setQos(qos);
		// CloudPlug channel - MQTT topic
		String topic = "iot-2/evt/eid/fmt/json";
		try {
			connection.publish(topic,message);
			connection.disconnect();
			Thread.sleep(2000);
		} catch (MqttPersistenceException e) {
			mqtt.disconnect();
			e.printStackTrace();
		} catch (MqttException e) {
			mqtt.disconnect();
			e.printStackTrace();
		} catch (InterruptedException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
	}
	
	public String getContent(){
		// Format the Json String
		JSONObject contObj = new JSONObject();
		JSONObject jsonObj = new JSONObject();
		try {
			contObj.put("count", count);
			contObj.put("time", new SimpleDateFormat("yyyy-MM-dd HH:mm:ss").format(new Date()));
			contObj.put("gps","53.342237,-6.2837981,19");
			jsonObj.put("d", contObj);
		} catch (JSONException e1) {
			e1.printStackTrace();
		}

		System.out.println("Send count as " + count);
		count++;

		// Publish device events to the app
		// iot-2/evt/<event-id>/fmt/<format>
		return jsonObj.toString();
	}

}
