package com.naughton.getmybikebackrack.mqtt;

import org.eclipse.paho.client.mqttv3.IMqttDeliveryToken;
import org.eclipse.paho.client.mqttv3.MqttCallback;
import org.eclipse.paho.client.mqttv3.MqttClient;
import org.eclipse.paho.client.mqttv3.MqttConnectOptions;
import org.eclipse.paho.client.mqttv3.MqttException;
import org.eclipse.paho.client.mqttv3.MqttMessage;
import org.eclipse.paho.client.mqttv3.MqttPersistenceException;

/**
 *
 * @author martin
 *
 */
public class MqttConnect implements MqttCallback {
	int qos = 0;

	//tcp://<org-id>.messaging.internetofthings.ibmcloud.com:1883
	//ssl://<org-id>.messaging.internetofthings.ibmcloud.com:8883
	String org="wc9zb2";
	String broker = "tcp://wc9zb2.messaging.internetofthings.ibmcloud.com:1883";
	String authmethod ="use-token-auth";
	String authtoken = "ULqSw1z*9i-G1O5?zC";
	String deviceId="fc2cde34207e";
	String type="MQTTDevice";
	String clientId="d:"+org+":"+type+":"+deviceId;
	MqttClient sampleClient;
 
		
	public MqttClient connect() {
		try {
		System.out.println("Connecting");
		sampleClient = new MqttClient(broker, clientId);
		sampleClient.setCallback(this);
		System.out.println("Setting up options");
		MqttConnectOptions connOpts = new MqttConnectOptions();
		connOpts.setCleanSession(true);
		connOpts.setUserName(authmethod);
		connOpts.setPassword(authtoken.toCharArray());
		
		System.out.println("[CloudPlugs]: Connecting to broker: " + broker);
		sampleClient.connect(connOpts);
		System.out.println("[CloudPlugs]: Connected!");
		
		} catch (MqttPersistenceException e) {
			System.out.println("Persistence exception");
			e.printStackTrace();
		} catch (MqttException e) {
			System.out.println("MqttException");
			e.printStackTrace();
		}
		return sampleClient;
	}

	public void disconnect() {
		try {
			sampleClient.disconnect();
		} catch (MqttException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	}

	public void connectionLost(Throwable arg0) {
		System.out.println("connectionLost");
		
	}

	public void deliveryComplete(IMqttDeliveryToken arg0) {
		System.out.println("deliveryComplete");
		
	}

	public void messageArrived(String arg0, MqttMessage arg1) throws Exception {
		System.out.println("messageArrived");
	}


}
