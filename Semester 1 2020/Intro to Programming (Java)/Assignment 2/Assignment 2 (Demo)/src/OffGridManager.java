//I named this class OffGridManager because it is the name of assignment as well as the name of the function that the program is running. This class
//has all the main methods of the program. The class is in the beginning stages of development therefore not all code is here yet. The composition
//of the class is concise and I would not separate it out any further.
public class OffGridManager {
//I used GTerm because it is the library out classes uses and it is a member variable because it is used throughout the entire program. I named it gt
//because it is common practice for GTerm and is a well known variable name.
	private GTerm gt;
//I used Object as the type because it is the name of the supplementary class. I named the variable object because all the objects entered by the user
//are stored in this variable. It is a member variable because it will be used in many methods. It is an array to have many instances being able to be created.
	private Object[] objects;
//I used an int because the data stored will be a number. I named the variable 'i' because it is common practice to use i when storing values in arrays.
//It is a member variable because it will be used in many methods. 
	private int i;
//I used an int because the data stored will be a number. I named the variable totalWatts becuase it the number that will be updated to show the total
//power being consumed by the user's devices. It is a member variable because it will be used in many methods.
	private int totalWatts;

//I have no parameters in the constructor because the constructor does not need any input from another method or class. Only the main functions are called
//in the constructor making it as short and concise as possible. 
	public OffGridManager() {
		this.i = 0;
		this.objects = new Object[10];
		this.gt = new GTerm(500, 330);
		this.totalWatts = 0;
		this.gt.setFontSize(16);
		this.gt.print("Current power position (Watts:)");
		this.gt.addTextField(Integer.toString(this.totalWatts), 100);
		this.gt.println("\n");
		this.gt.addButton("Add Device", this, "addDevice");
		this.gt.addButton("Remove Device", this, "removeDevice");
		this.gt.addButton("Toggle on/off", this, "deviceToggle");
		this.gt.println("\n\n");
		this.gt.addList(490, 200, this, "deviceSelection");
	}

//This method is a void because it does need to return any values. I named the method addDevice because this the method that runs when the user clicks
//the 'Add Device' button. The method is concise and nothing in it could be moved to another method. No parameters are needed because the method is not
//dependent on data from an outside source.
	public void addDevice() {
		this.gt.showMessageDialog("Choose image for device");
//I used a String because numbers and letters would be stored in this variable, not just numbers like an int. I named the variable deviceFilePath 
//because the data held within the string is file path for the devices photo.
		String deviceFilePath = this.gt.getFilePath();
//This array was named deviveFileElements because it holds the split elements of the file in which the device photo is held. It is a string because the
//data held are letters not just numbers. The array is only used in this method therefore is it a local/private variable. 
		String[] deviceFileElements = deviceFilePath.replace("\\", "//").split("//");
//This array was named deviveFilePeriod because it holds the split elements of the file that are split by the period attribute. In which the device 
//photo is held. It is a string because the data held are letters not just numbers. The array is only used in this method therefore is it a 
//local/private variable. 
		String[] deviceFilePeriod = deviceFileElements[deviceFileElements.length - 1].split("[.]");
//I used a String because numbers and letters would be stored in this variable, not just numbers like an int. I named the variable deviceName 
//because the data held within the string is name for the device.
		String deviceName = deviceFilePeriod[deviceFilePeriod.length - 2];
		int deviceWatts = Integer.parseInt(
				this.gt.getInputString("Enter power consumption (negative for production) for the " + deviceName));
		this.objects[i] = new Object(deviceName, deviceWatts, deviceFileElements);
		this.objects[i].newTerminal();
		this.gt.addElementToList(0, deviceName);
		this.i += 1;
	}

	// public void removeDevice() {
	// this.gt.removeElementFromList(0, 0);
	// }
//I named this method main because it is where the entire program runs from. The only parameter is the array of args and is required for the main
//method. It returns void because all the method does is call and run the constructor. Which in turn then runs the part of the program we are interested
//in. The method is concise as can be and cannot be split up.
	public static void main(String[] args) {
//I named the variable dv because it stands for device, which is a main componenet to the function. The type is the class because 
//it calls itself and runs the program. 
		OffGridManager dv = new OffGridManager();
	}
}