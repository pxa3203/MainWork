//I named this class OffGridManager because that is the name of the assignment, as well the composition of this class is concise and only holds the main
//value and functions of the program.
public class OffGridManager {
//I named GTerm gt and used the type GTERM because that is common practice for this class call all functions using the gt term. This variable 
//is used in multiple methods throughout the class therefore it is a member variable.
	private GTerm gt;
//I named this variable devices because that is what is stored in the variable type. I used the type device because that is the name of 
//the secondary class used to store the array of entered devices by the user. It is a member variable because it is used in multiple 
//methods through out the class 
	private Device[] devices;
//It is a member variable because it is used in multiple methods through out the class. I named the variable i because it is common practice 
//so name a variable i that is used as a key to store data. It is an int because int's handle numbers the best out of all types.	
	private int i;
//It is an int because int's handle numbers the best out of all types. It is a member variable because it is used in multiple methods through 
//out the class. I named the variable powerPosition because it tracks the current power position that the application is in.
	private int powerPosition;
//I named this variable numofDevices because it tracks the current number of devices that are in the program. It is an int because int's 
//handle numbers the best out of all types. It is a member variable because it is used in multiple methods through out the class.
	private int numOfDevices;
//I named the variable removeIndex because it tracks which index position of what device is removed. It is used in multiple methods in the class
//therefore it is a member variable. I used an int because int's handle numbers extremely well.
	private int removeIndex;
//The constructor has no parameter because there is no data incoming into the method that will be used. The constructor is concise and only does the
//main functions of the program. I initialized the member variables and called the methods needed to run the core of the program.
	public OffGridManager() {
		this.i = 0;
		this.removeIndex = 0;
		this.devices = new Device[10];
		this.gt = new GTerm(500, 330);
		this.powerPosition = 0;
		this.gt.setFontSize(16);
		this.gt.print("Current power position (Watts:)");
		this.gt.addTextField(Integer.toString(this.powerPosition), 100);
		this.gt.println("\n");
		this.gt.addButton("Add Device", this, "addDevice");
		this.gt.addButton("Remove Device", this, "removeDevice");
		this.gt.addButton("Toggle on/off", this, "deviceToggle");
		this.gt.println("\n\n");
		this.gt.addList(490, 200, this, "deviceSelection");
	}
//The method is a void because it return no data. There are no parameters because there are no data points coming into the method. The method is concise
//and only does executes what needs to be done to complete the button press. I named the method addDevice because the user enters a device into the system
//using the corresponding button.
	public void addDevice() {
		this.gt.showMessageDialog("Choose image for device");
//I used an int because the data is a number and int's handle numbers the best. I named it device status becuase it keeps track of the status of the
//device.
		int deviceStatus = 0;
//I used a string because the data in the type is letters and special characters. I named is devilefilepath because it holds the file path in which the 
//device name is held.
		String deviceFilePath = this.gt.getFilePath();
//I named the array deciveFileElements becuase it the array that holds all the elements of the filepath for the name of the device being added.
//I used a string type because the data is all letters when it is split. The array is only used inside this method therefore it should not and is not
//a member variable.
		String[] deviceFileElements = deviceFilePath.replace("\\", "//").split("//");
//I named the array deviceFilePeriod becuase it splits the fileelements array by the period in the array just leaving the file name.
//I used a string type because the data is all letters when it is split. The array is only used inside this method therefore it should not and is not
//a member variable.
		String[] deviceFilePeriod = deviceFileElements[deviceFileElements.length - 1].split("[.]");
//I used a string because the data held in the type is a string of letters split by the array above. I named the string deviceName becuase after the
//length is trimmed is all that is left is the name of the device.
		String deviceName = deviceFilePeriod[deviceFilePeriod.length - 2];
//I used an int because the data is a number and int's handle numbers the best. I named the variable devicewatts becuase it holds the wattage of 
//the device.
		int deviceWatts = Integer.parseInt(
				this.gt.getInputString("Enter power consumption (negative for production) for the " + deviceName));
//I used a type device because that is the name of secondary class in which the data of the device is held. I named it device info because the info for
//the device is held within the other class and this variable.
		Device deviceInfo = new Device(deviceName, deviceWatts, deviceFileElements, deviceStatus);
		this.devices[i] = deviceInfo;
		this.devices[i].drawTerminal();
		this.gt.addElementToList(0, deviceInfo);
		this.i += 1;
		this.numOfDevices += 1;
	}
//The method is a void because it return no data. There are no parameters because there are no data points coming into the method. The method is concise
//and only does executes what needs to be done to complete the button press. I named the method removeDevice because the selected device hets removed 
//when the user presses that button. 
	public void removeDevice() {
		Device selectedDevice = (Device) this.gt.getSelectedElementFromList(0);
//I used an int because the data is a number and int's handle numbers the best. I named it index to track the array of the devices and the location
// in which the devices are stored.
		int index = 0;
//I used an int because the data is a number and int's handle numbers the best. I named it removedDevice because it tracks where in the array the device
//was removed.
		int removedDevice = 0;
		if (selectedDevice != null) {
//This while loops basically holds the body of the method because because it needs to be ran through multiple times to find a match (if there is one),
//to a device within the devices array. It runs 1 time less than the numOfDevices because the way the array assigns data starting at 0 and not 1.
		while (index < this.numOfDevices) {
//I used this statement to see if a device in the array equals the device that is selected. This if statement holds the body of function that removes
//the device. 
			if (this.devices[index].equals(selectedDevice)) {
				this.removeIndex = index;
				checkRemove();
//I used this statement to see if a device in the array can be removed. This statement checks to make sure the device is ok to remove
//from the loops. If the checkRemove method says it is ok to remove then the device is removed.
				if (checkRemove() == 0) {
					this.gt.removeElementFromList(0, index);
					this.devices[index].closeTerminal();
					this.numOfDevices -= 1;
					removedDevice = index;
				}
//I used this statement to see if the selected device in the array can be removed. In this statement if the device cannot be removed, then a message
//is displayed that says the device cannot be removed.
				else if (checkRemove() == 1) {
					this.gt.showMessageDialog("To remove device, device must first be switched off.");
				}
			}
			index += 1;
		}
//This while loops basically adjust the array by 1 number if a device was removed from the array. The loops to very concise. It runs 1 time less than 
//the numOfDevices because the way the array assigns data starting at 0 and not 1.
		while (removedDevice < this.numOfDevices) {
			this.devices[removedDevice] = this.devices[removedDevice + 1];
			removedDevice += 1;
		}	
		}
	}
//I named the method deviceToggle because the method toggles the device on and off when the user presses the button in the GUI.
//The method is a void because it return no data. There are no parameters because there are no data points coming into the method. The method is concise
//and only does executes what needs to be done to complete the button press.
	public void deviceToggle() {
//I used a type device because that is the name of secondary class in which the data of the device is held. I named it selectedObject because
//it is the selectedDevice from the list of devices.
		Device selectedObject = (Device) this.gt.getSelectedElementFromList(0);
//I used an int because the data is a number and int's handle numbers the best. I named it index to track the array of the devices and the location
// in which the devices are stored.
		int index = 0;
//This while loops basically holds the body of the method because because it needs to be ran through multiple times to find a match (if there is one),
//to a device within the devices array. It runs 1 time less than the numOfDevices because the way the array assigns data starting at 0 and not 1.
		while (index < this.numOfDevices) {
//I used this statement to see if a device in the array equals the device that is selected. This statement holds the body of the toggle function and 
//nothing can be removed from it.
			if (selectedObject.equals(this.devices[index])) {
//I used this statement to see if the device is on or off. This statement holds all the instructions to turn the device on from the off position. 
				if (this.devices[index].getDeviceStatus() == 0) {
//I used this statement to see if the selected device creates or consumes power. Nothing can be removed from this statement.
					if (this.devices[index].getWatts() < 0) { 
//I used an int because the data is a number and int's handle numbers the best. I named it watts becuase it tracks the watts that were entered originally
//when the device was created. It is different from the deviceWatts because this one can be manipulated and used without losing the initial value.
						int watts = 0;
						watts = (this.devices[index].getWatts() * -1);
						this.devices[index].setDeviceStatusOn();
						this.devices[index].drawTerminal();
						this.powerPosition += watts;
						powerRedraw();
					}	
//I used this statement to see if the selected device is creating or consuming power. Depending on the status the situation is handled differently. 
					else if (this.devices[index].getWatts() > 0) {
//I used this statement to see if the selected device can be turned on. The statement makes sure there is enough power left after the device is turned on.
						if (this.powerPosition - this.devices[index].getWatts() >= 0) {
							this.devices[index].setDeviceStatusOn();
							this.devices[index].drawTerminal();
							this.powerPosition -= this.devices[index].getWatts();
							powerRedraw();
						}
//I used this statement to tell the program what to do if the system does not have enough power to turn on. The if statment is concise and nothing
//can be removed.
						else if (this.powerPosition - this.devices[index].getWatts() <= 0) {
							this.gt.showMessageDialog("Not enough power to turn this device on");
						}	
					}
				}
//I used this statement to see if the selected device is on or not. If the device is on then the following statements contain instructions on how to 
//turn the device off.
				else if (this.devices[index].getDeviceStatus() == 1) {
//I used this statement to see if the device being turned off is creating or consuming power. Based on the power rating the situation is handled 
//differently.
					if (this.devices[index].getWatts() < 0) {
//I used this statement to see if there will be enough power remaining after we turn the device off. The if statement is concise and cannot be shortened.
						if (this.powerPosition + this.devices[index].getWatts() >= 0) {
							this.devices[index].setDeviceStatusOff();
							this.devices[index].drawTerminal();
							this.powerPosition += this.devices[index].getWatts();
							powerRedraw();
						} 
//I used this statement to inform the user that there is not enough remaining power if you were to turn that device off.
						else if (this.powerPosition - this.devices[index].getWatts() <= 0) {
							this.gt.showMessageDialog("Not enough remaining power to turn off device");
						}
					}
//I used this statement to see if the the device looking to be turned off is creating or generating power. If sitations are handled differently depending
//on the power state.
					else if (this.devices[index].getWatts() > 0) {
							this.devices[index].setDeviceStatusOff();
							this.devices[index].drawTerminal();
							this.powerPosition += this.devices[index].getWatts();
							powerRedraw();
					}
//I used this statement to inform the user that device cannot be turned off if the power will go into the negative amount. Therefore not enough
//power.
						else if (this.powerPosition - this.devices[index].getWatts() <= 0) {
							this.gt.showMessageDialog("You cannot turn this device off");
						}
				}	
			}
			index += 1;
		}	
	}
//The method is a void because it return no data. There are no parameters because there are no data points coming into the method. The method is concise
//and only does executes what needs to be done to complete the button press. The method is named powerRedraw becuase it simply redraws the power
//in the GTerm window of the selected device, when the power is toggled on/off.
	public void powerRedraw() {
		this.gt.setTextInEntry(0, Integer.toString(this.powerPosition));
	}
//The method is an int because it returns an int to be used in other methods. There are no parameters because there are no data points coming into the 
//method. The method is concise and only does executes what needs to be done to complete the button press. I named the method checkRemove because
//it checks if the device was actually removed from the loop. It assists the removeDevice method.
	public int checkRemove() {
//I used an int because the data is a number and int's handle numbers the best. I named the variable checkRemoveOutcome, because it tracks if the 
//device was removed from the array.
		int checkRemoveOutcome = 0;
//I used this statement to see the device that is selected and removed is one then the device has not been turned off. However if the device is removed
//then it will return 0 which is default.
		if (this.devices[removeIndex].getDeviceStatus() == 1) {
			checkRemoveOutcome = 1;
			return checkRemoveOutcome;
		} else {
			return checkRemoveOutcome;
		}
	}
//The method is a void because it return no data. There are no parameters because there are no data points coming into the method. The method is concise
//and only does executes what needs to be done to complete the button press. This method is dumby class and is named deviceSelection because it is
//the method that runs when the user selects a device from the list.
	public void deviceSelection() {
	}
//The method is a void because it return no data. There are 1 parameter because the string array is necessary for the main method. The method is concise
//and only does executes what needs to be done to complete the button press. This method is named main because it calls the entire program to run from
//the top down. This method runs the entire program.
	public static void main(String[] args) {
//I used the type OffGridManager because it is the name of the class. I named the variable dv because it stands for device and calls the entire program
//from top down.
		OffGridManager dv = new OffGridManager();
	}
}