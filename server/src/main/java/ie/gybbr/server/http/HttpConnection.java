package ie.gybbr.server.http;

import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.net.URL;

import javax.net.ssl.HttpsURLConnection;


/**
 * api_key = test
chip_number
type = check_in / check_out
gps_location
sensor_id
 * @author martin
 *
 */
public class HttpConnection {
	
		public void sendPost() throws Exception {
			
			final String USER_AGENT = "Mozilla/5.0";
	 
			String url = "https://stolen-bike-leonharvey.c9.io/api";
			URL obj = new URL(url);
			HttpsURLConnection con = (HttpsURLConnection) obj.openConnection();
	 
			//add reuqest header
			con.setRequestMethod("POST");
			con.setRequestProperty("User-Agent", USER_AGENT);
			con.setRequestProperty("Accept-Language", "en-US,en;q=0.5");
			
			String api_key = "test";
			String chip_number="125223";
			String type = "check_in";
			String gps_location="1234";
			String sensor_id="12345";
	 
			String urlParameters = "api_key="+api_key+"&chip_number="+chip_number+"&type="+type+"&gps_location="+gps_location+"&sensor_id="+sensor_id;
	 
			// Send post request
			con.setDoOutput(true);
			DataOutputStream wr = new DataOutputStream(con.getOutputStream());
			wr.writeBytes(urlParameters);
			wr.flush();
			wr.close();
	 
			int responseCode = con.getResponseCode();
			System.out.println("\nSending 'POST' request to URL : " + url);
			System.out.println("Post parameters : " + urlParameters);
			System.out.println("Response Code : " + responseCode);
	 
			BufferedReader in = new BufferedReader(
			        new InputStreamReader(con.getInputStream()));
			String inputLine;
			StringBuffer response = new StringBuffer();
	 
			while ((inputLine = in.readLine()) != null) {
				response.append(inputLine);
			}
			in.close();
	 
			//print result
			System.out.println(response.toString());
	 
		}

}
