
/*
		By
			Pawan Terdal		-	1PE15IS073
			Rahul Putcha Gautham	-	1PE15IS079
		JavaScript File for Inclusion of Dynamic HTML DOM Objects
*/

//Global Variables
var currentlySelected,currentlySelectedObj;
var slotTakenLabel = [],slotTakenObj = [];
var available = true;
//var jArray = [];

//Function Definitions

//For Generating Parking Sheet Easily
function generateSheet()
{
	var i;
	var numSlots = 50 , revSlots = 30; // Number of Normal Slots , Number of Reserved Slots
	var label = "P";	//<---NOTE : This is the Label for Normal Parking


	//Creating Slots on the Parking Sheet Area(div) with id = "sheet"
	sheet = document.getElementById('sheet');
	//--------------Normal Slot Creation------------
	var header = document.createElement("h4");
	header.appendChild(document.createTextNode("Normal Parking"));
	sheet.appendChild(header);

	/*jArray[i] ------> array which contains selected slots status.
										For Ex. if only first two slots are occupied,
										array values will be - [1 1 0 0 0 0 0 0 0 0 ]
*/

	for(i=0;i<numSlots;i++)
	{
			if(jArray[i] == 1){
				var slot   = document.createElement("div");
				var text   = document.createTextNode(label+" "+(i+1));
				slot.appendChild(text);
				slot.style.backgroundColor = "green";
				sheet.appendChild(slot);
			}
			else if(jArray[i] == 0){
				var slot   = document.createElement("div");
				var text   = document.createTextNode(label+" "+(i+1));
				slot.appendChild(text);
				slot.style.backgroundColor = "white";
				sheet.appendChild(slot);

			}

	}


	//------------Reserved Slot Creation-----------
	var header = document.createElement("h4");
	header.appendChild(document.createTextNode("Reserved Parking"));
	sheet.appendChild(header);
	for(i=0;i<revSlots;i++)
	{
		var slot   = document.createElement("div");
		var text   = document.createTextNode("R "+(i+1)); //<---NOTE : Reserved Parking Label is Defined Here
		slot.appendChild(text);
		sheet.appendChild(slot);
	}

	//selectSlot("#sheet div" , "green"); //<--Slot Layout and Features Here
}

//--------------Slot Effects-----------
function selectSlot(tag,color)
{
	$(document).ready
	(
		function()
		{
			$(tag).click //Called When any of the slots Created is clicked (individually)
			(
				function()
				{
					//$("#sheet div").css("background-color","white");	//<--For Toggling Effects for Slot Selection
					for(i=0;i<slotTakenObj.length;i++)	//<---For Preserving Slots that are Not Empty
						$(slotTakenObj[i]).css("background-color",color)


					//Preserving Current Slot that is Selected(Until Submit)
					$(this).css("background-color",color)
					currentlySelected	= this.textContent;
					currentlySelectedObj	= this;

					if(isSlotEmpty() == false)
					{
						$("html,body").animate({scrollTop : $("#Slot-Preview").offset().top} , 1000);

						//Pawan's Search for Available Slot in Database then,

						preview("#slot-box");
					}
				}
			);
		}
	);
}

//----------Submit Button Events------------
function onClickSubmit()
{
	var i;
	available = true;
	var regex = /^[a-zA-Z]+$/;

			//----------------Form Validation------------------------------
			var regVerify   = document.forms["detail_form"]["vehicle_reg_number"].value;
			var nameVerify  = document.forms["detail_form"]["driver_name"].value;
			var phoneVerify = document.forms["detail_form"]["driver_number"].value;
			if (regVerify == "" || nameVerify == "" || phoneVerify == "")
			{
				regVerify.focus();
				alert("Fill all Details");

			}
			else
			{
				if(regex.test(nameVerify.value) == false)
				{
			 		alert("Name must be in alphabets only");
			 		letters.yourname.focus();
				}
				//if(regVerify.length != 4) alert("Please give a 4 digit registration number");
				//if(phoneVerify.length != 10) alert("Please give a 10 digit phone number");

			}


}


//--------------Reset Button------------
function onClickReset()
{
	document.forms["detail_form"]["state"].value  		=
	document.forms["detail_form"]["region_code"].value 	=
	document.forms["detail_form"]["region"].value 		=
	document.forms["detail_form"]["vehicle_reg_number"].value 		=
	document.forms["detail_form"]["driver_name"].value 	=
	document.forms["detail_form"]["driver_number"].value 	= "";
	document.forms["detail_form"]["vehicle_type"].value 	= "car";
}

//----------Main Program----------

generateSheet();

//----------For Ticket Preview---- : Using J-Query
$(document).ready
(
	function()
	{
		$("#slot_search").click		//<--- On Submit Button Clicked
		(
			function()
			{
				//if(available)	//<--- if chosen Slot is Available then
				//{
					preview("#slot-box");
				//}
			}
		);
	}
);



function preview(section) // NOTE : Incomplete Function : include local data variables
{
	var box   = $(section).empty();		//<---Clean the Preview Box Container

	//Write the Ticket Containing Elements into it
	var para0 = document.createElement("p");
	var line  = document.createTextNode(jSlot_preview);
	//para0.append(line);
	//alert(jSlot_preview);

	/*var para1 = document.createElement("p");
	var line  = document.createTextNode("Registration Plate : " +
			state.value +" "+region_code.value+" " + region.value+" "+vehicle_reg_number.value);
	para1.append(line);

	var para2 = document.createElement("p");
	var line  = document.createTextNode("Name : " + driver_name.value);
	para2.append(line);

	var para3 = document.createElement("p");
	var line  = document.createTextNode("Phone No : " + driver_number.value);
	para3.append(line);

	//---------NOTE : Radio Button Here-----------
	var para4 = document.createElement("p");
	var vtype = document.querySelector('input[name = "vehicle_type"]:checked').value;
	var line  = document.createTextNode("Vehicle Type : " + vtype);
	para4.append(line);

	//---------NOTE : Normal/Reserved Decision Here-----
	var para5 = document.createElement("p");
	slot_type = (currentlySelected[0]=='R')?"reserved":"normal";
	var line  = document.createTextNode("Slot Type : " + slot_type);
	para5.append(line);
	box.append(para0,para1,para2,para3,para4,para5);*/
}

function isSlotEmpty()
{
	for(i=0;i<slotTakenLabel.length;i++)
	{
		if(slotTakenLabel[i] == currentlySelected)	//<---is Currently Selected Slot is already Empty / Booked Before??
		{
			return false;
		}
	}
	return true;
}

function noRefresh(form_name)
{
	$(document).ready(function () {
    $(form_name).on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url : $(this).attr('action') || window.location.pathname,
            type: "POST",
            data: $(this).serialize(),

        });
    });
  });
}
