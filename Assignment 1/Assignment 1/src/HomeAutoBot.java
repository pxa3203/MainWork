import java.awt.Color;

public class HomeAutoBot {
	public static void main(String[] args) { //main functions where everything is called and ran
		GTerm gt = new GTerm(900, 800);
		startUp(gt);
		int numberOfAppliances = Integer.parseInt((gt.getInputString("How many appliances would you like to enter?"))); //this is where the user is prompter for the number of appliances they would like to enter into the bot. 
		String[] applianceArray = new String[numberOfAppliances]; 													//Line 9 also creates the array lengths
		String[] applianceState = new String[numberOfAppliances];
		getAppliances(gt, applianceArray, applianceState, numberOfAppliances);
		variableFontColors(gt, FontColors.GTERM);
		gt.println("You have entered " + numberOfAppliances + " appliances");
		gt.println("");
		gt.println("");
		gt.println("");
		variableFontColors(gt, FontColors.HEADINGS);
		printAppliances(gt, applianceArray, applianceState, numberOfAppliances);
		boolean done = false;
		while (!done) { //this loop is dependent on the boolean within the applianceCommand function. This allows the loop to be killed when the user selects cancel or closes the prompted input window.
			done=applianceCommand(gt, applianceArray, applianceState, numberOfAppliances);
		}
	}

	public static void startUp(GTerm gt) { // this is the beginning/welcoming section of the program
		gt.setFontSize(18);
		gt.setBackgroundColor(Color.BLACK);
		variableFontColors(gt, FontColors.HEADINGS);
		gt.println("Hi there! My name is Fraizr!");
		gt.println(" "); // the empty quotes are to make empty lines to seperate two dialogues
		gt.println(" ");
		gt.println(" ");

		gt.println("Starting Appliance Input Mode...");
	}

	public static void getAppliances(GTerm gt, String applianceArray[], String applianceState[], 
			int numberOfAppliances) { // this is where the appliances and their states are put into their respective
										// arrays
		for (int i = 0; i < numberOfAppliances; i++) { //this loop asks for the appliance names and they states of on or off. Saves them their respective arrays.
			applianceArray[i] = (gt.getInputString("Name an appliance"));
			applianceState[i] = (gt.getInputString("Is the " + applianceArray[i] + " on or off?"));
		}
	}

	public static void printAppliances(GTerm gt, String applianceArray[], String applianceState[],
			int numberOfAppliances) { // this is where the appliances are printed out with their states shown
		variableFontColors(gt, FontColors.HEADINGS);
		gt.print("Available commands: 'turn on <appliance>' or 'turn off <appliance>'");
		gt.println("");
		gt.println("");
		gt.print("Available Appliances: ");
		for (int i = 0; i < numberOfAppliances; i++) { //I used the font color variables to dynamical switch the font color based off the users inputs.
			variableFontColors(gt, FontColors.APPLIANCES);
			gt.print(" " + applianceArray[i] + " ");
			if (applianceState[i].equalsIgnoreCase("on")) {
				variableFontColors(gt, FontColors.ON);
			}
			if (applianceState[i].equalsIgnoreCase("off")) {
				variableFontColors(gt, FontColors.OFF);
			}
			gt.print("(" + applianceState[i] + ")");
		}
	}

	public static void variableFontColors(GTerm gt, FontColors color) { // this is where the font colors are applied
																		// variables
		switch (color) { //I used a switch to tie the colors with a variable. Therefore you can change a color within one line of code.
		case HEADINGS:
			gt.setFontColor(Color.WHITE);
			break;
		case APPLIANCES:
			gt.setFontColor(Color.ORANGE);
			break;
		case ON:
			gt.setFontColor(Color.GREEN);
			break;
		case OFF:
			gt.setFontColor(Color.RED);
			break;
		case GTERM:
			gt.setFontColor(Color.MAGENTA);
			break;
		default:
			break;
		}
	}

	enum FontColors { // this is where font color variables are created, enum seemed like the only reasonable option, was also the most efficient according to my knowledge.
		HEADINGS, APPLIANCES, ON, OFF, GTERM
	}

	public static boolean applianceCommand(GTerm gt, String applianceArray[], String applianceState[], int numberOfAppliances) { //this function is where the commands are prompted
		//acted on and printed out. It was the core of the program. I used if statements, for loops, and my previous arrays to complete this.
		String userApplianceInput = gt.getInputString("Please enter a command"); //the program prompts the user for a command and the user inputs.
		if (userApplianceInput == null) {
			programFinish(gt);
			return true;
		}
		
		gt.print("\n");
		variableFontColors(gt, FontColors.HEADINGS);
		gt.println("");
		gt.print("Available commands: 'turn on <appliance>' or 'turn off <appliance>'");
		gt.println("");
		gt.println("");
		gt.print("Available Appliances: ");
		for (int i = 0; i < numberOfAppliances; i++) {
			if (userApplianceInput.equalsIgnoreCase("turn on " + applianceArray[i])) { //this is where the input is analyzed and comprehended by the function
				applianceState[i] = ("on");
				variableFontColors(gt, FontColors.APPLIANCES);
				gt.print(" " + applianceArray[i] + " ");
				variableFontColors(gt, FontColors.ON);
				gt.print("(" + applianceState[i] + ")");
			} else if (userApplianceInput.equalsIgnoreCase("turn off " + applianceArray[i])) {
				applianceState[i] = ("off");
				variableFontColors(gt, FontColors.APPLIANCES);
				gt.print(" " + applianceArray[i] + " ");
				variableFontColors(gt, FontColors.OFF);
				gt.print("(" + applianceState[i] + ")");
			} else {
				if (applianceState[i].contentEquals("on")) {
					variableFontColors(gt, FontColors.APPLIANCES);
					gt.print(" " + applianceArray[i] + " ");
					variableFontColors(gt, FontColors.ON);
					gt.print("(" + applianceState[i] + ")");
				}

				else {
					variableFontColors(gt, FontColors.APPLIANCES);
					gt.print(" " + applianceArray[i] + " ");
					variableFontColors(gt, FontColors.OFF);
					gt.print("(" + applianceState[i] + ")");
				}
			}

		}
		return false; //return for the boolean to repeat the loop
	
	}

	public static void programFinish(GTerm gt) { //this functions finishes the program with a friendly goodbye message. Using a font variable.
		variableFontColors(gt, FontColors.GTERM);
		gt.println("\n");
		gt.println("You may now close the window. See you next time!");
	}

}