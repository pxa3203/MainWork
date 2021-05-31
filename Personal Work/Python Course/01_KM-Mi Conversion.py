# first python course module, making KM to MI converter

#asking user how many KM's they would like to convert to MI, then saving in variable
kilometers = float(input("How many Kilometers would you like to convert to Miles?"))

#setting the KM to MI conversion rate into a variable
conversion_rate = 1.609344

#doing conversion from user entered KM to MI, saving into variable
miles = kilometers/conversion_rate
#displaying the conversion in a user friendly format to user
print(kilometers, "km =", round(miles,4), "miles")