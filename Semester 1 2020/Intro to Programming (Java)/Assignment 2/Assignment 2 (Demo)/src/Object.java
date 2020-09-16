//I named this class Object because that is what gets stored and manipulated in this class. The class is faily concise and cannot be split any further.
//The class is a work in project and is not entirely complete.
public class Object {
//I used GTerm because it is the library out classes uses and it is a member variable because it is used throughout the entire program. I named it gt
//because it is common practice for GTerm and is a well known variable name.
	private GTerm gt;
//I used a String because the data stored in the variable are letters not numbers. I named the variable deviceName because that is what data is held
//in the variable. It is a member variable because it is used throughout the entire class in many methods. 
	private String deviceName;
//I used an int because the data stored will be a number. It is a member variable because it is used throughout the entire class in many methods.
//I named the variable deviceWatts because that is what is held within the variable, the watts for the respective device. 
	private int deviceWatts;
//I used a string for this array because the elements are all letters and not all numbers. I named the variable deviceFileElements to match the
//variable from the OffGridManager class. It is a member variable because it is used throughout the entire class in many methods.
	private String[] deviceFileElements;
//I used a boolean because it is easy to switch from easy to false to set the status of a device. It is a member variable because it is used 
// throughout the entire class in many methods. I named the variable deviceStatus becuase the true/false value held determines the status of the device.
	private boolean deviceStatus;

//The constructors parameters are taking data from the primary class to store and manipulate in this class. All the constructor does here is intialize
//the member variables to become the variables from the other class. The constructor is concise and cannot be split up.
	public Object(String deviceName, int deviceWatts, String[] deviceFileElements) {
		this.deviceName = deviceName;
		this.deviceWatts = deviceWatts;
		this.deviceFileElements = deviceFileElements;
		this.deviceStatus = false;
	}

//I used a void because the method does not need to return a value. I named the method newTerminal because that is what happens when the user
//adds a device, and when this method is called. The method is fairly concise and cannot be split into other methods. There are no parameters because
//the data has already been set to the member variables in the constructor. 
	public void newTerminal() {
		this.gt = new GTerm(400, 350);
		this.gt.setFontSize(20);
		this.gt.println("Name: " + this.deviceName);
		this.printStatus();
		this.gt.println("Rated power consumption: " + deviceWatts + " Watts");
		this.gt.setXY(25, 85);
		this.gt.addImageIcon(this.deviceFileElements[deviceFileElements.length - 1]);
	}

//I used a void because the method does not need to return a value. The method is fairly concise and cannot be split into other methods. There are no
//parameters because the data has already been set to the member variables in the constructor. I named the variable printStatus because the method prints
//the status of the device in the terminal. 
	public void printStatus() {
//I used an if statement to check against a boolean value when setting the status of a device. If statement is the only option to independently check
//the boolean that I am aware of. There's only one line in the condition therefore it is very concise and cannot be split or shortened.
		if (this.deviceStatus = false) {
			this.gt.println("Status: off");
		}
//I used an if statement to check against a boolean value when setting the status of a device. If statement is the only option to independently check
//the boolean that I am aware of. There's only one line in the condition therefore it is very concise and cannot be split or shortened.
		if (this.deviceStatus = true) {
			this.gt.println("Status: on");
		}
	}

}
