//I named the class Device because that is what is stored in this class (all the data for the devices). The composition of the class is concise and only 
//holds the data for the devices. 
public class Device {
//I named GTerm gt and used the type GTERM because that is common practice for this class call all functions using the gt term. This variable 
//is used in multiple methods throughout the class therefore it is a member variable.
	private GTerm gt;
//I named the variable deviceName because it stores the device name for this instance of the class.  This variable is used in multiple methods throughout 
//the class therefore it is a member variable. I used a string because the name is a string of letters.
	private String deviceName;
//I used an int because the data is watts and that metric is a number and int's handle numbers well. I named the variable device watts because it holds
//watts for this instance of the device class. This variable is used in multiple methods throughout the class therefore it is a member variable.
	private int deviceWatts;
//I used a string array because the data forwarded from the primary class is an array and the data is letters. I named the variable device watts because it holds
//watts for this instance of the device class. I named the variable deviceFileElements because it holds the file path elements as they are split.
	private String[] deviceFileElements;
//I used an int because the data is a number and int's handle numbers well. I named the variable device status because it holds the data the corresponds 
//to the device being on/off. This variable is used in multiple methods throughout the class therefore it is a member variable.
	private int deviceStatus;
//The constructor's parameters are the device info from the primary class because the info needs to be imported and initialized into the member variables.
//The constructor is very concise and cannot be shortened.
	public Device(String deviceName, int deviceWatts, String[] deviceFileElements, int deviceStatus) {
		this.deviceName = deviceName;
		this.deviceWatts = deviceWatts;
		this.deviceFileElements = deviceFileElements;
		this.gt = new GTerm(425, 350);
		this.deviceStatus = deviceStatus;
	}
//This method is void and is named drawTerminal becuase it returns no value and simply draws the terminal for the device with all the device info.  
//There are no parameters because the method does not intake any data.
	public void drawTerminal() {
		this.gt.clear();
		this.gt.setXY(0, 0);
		this.gt.setFontSize(20);
		this.gt.println("Name: " + this.deviceName);
//I used this condition to check if the device is on or off every time the window is drew. The statement is very concise and cannot be shortened.
		if (this.deviceStatus == 0) {
			this.gt.println("Status: off");
		}
//I used this condition to check if the device is on or off every time the window is drew. The statement is very concise and cannot be shortened.
		if (this.deviceStatus == 1) {
			this.gt.println("Status: on");
		}
//I used this condition to check if the device is consuming or creating power. The statement is very concise and cannot be shortened.
		if (this.deviceWatts < 0) {
			this.gt.println("Rated power creation: " + deviceWatts*-1 + " Watts");
		}
//I used this condition to check if the device is consuming or creating power. The statement is very concise and cannot be shortened.
		if (this.deviceWatts > 0) {
			this.gt.println("Rated power consumption: " + deviceWatts + " Watts");
		}
		this.gt.setXY(25, 85);
		this.gt.addImageIcon(this.deviceFileElements[deviceFileElements.length - 1]);
	}
//This method is void because it returns no value. I named the method closeTerminal because it closes the terminal of the device and that is all.
//There are no parameters because the method does not intake any data.
	public void closeTerminal() {
		this.gt.close();
	}
//This method is an int and is named getWatts because it returns the integer of the device wattage to be used in the main class.
//There are no parameters because the method does not intake any data.
	public int getWatts() {
		return this.deviceWatts;
	}
//This method is an int and is named getDeviceStatus because it returns the integer of the device status to be used in the main class.
//There are no parameters because the method does not intake any data.
	public int getDeviceStatus() {
		return this.deviceStatus;
	}
//This method is a void and is named setDeviceStatusOn because it does not return anything and it turns the device status on.
//There are no parameters because the method does not intake any data.
	public void setDeviceStatusOn() {
		this.deviceStatus = 1;
	}
//This method is a void and is named setDeviceStatusOff because it does not return anything and it turns the device status off.
//There are no parameters because the method does not intake any data.
	public void setDeviceStatusOff() {
		this.deviceStatus = 0;
	}
//This method is a string and is named toString because it returns the device name in a string to be used in the main class.
//There are no parameters because the method does not intake any data.
	public String toString() {
		return this.deviceName;
	}

}
