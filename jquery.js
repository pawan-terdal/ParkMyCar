/*
		By
			Pawan Terdal		:	1PE15IS073
			Rahul Gautham Putcha	:	1PE15IS079
		J-Query For Animating Scroll Effects
*/

$(document).ready
(
	function()
	{
		$(".home").click
		(
			function()
			{
				 $("html , body").animate({scrollTop : $("#Home").offset().top} , 500);
			}
		);
	}
);

$(document).ready
(
	function()
	{
		$(".detail").click
		(
			function()
			{
				 $("html , body").animate({scrollTop : $("#Details").offset().top} , 1000);
			}
		);
	}
);

$(document).ready
(
	function()
	{
		$(".layout").click
		(
			function()
			{
				$("html , body").animate({scrollTop : $("#Layout").offset().top} , 1000);
			}
		);
	}
);

$(document).ready
(
	function()
	{
		$(".layout-chase").click
		(
			function()
			{
				$("html , body").animate({scrollTop : $("#Layout").offset().top } , 1000);
			}
		);
	}
);


$(document).ready
(
	function()
	{
		$(".about").click
		(
			function()
			{
				$("html , body").animate({scrollTop : $("#About").offset().top } , 2000);
			}
		);
	}
);

$(document).ready
(
	function()
	{
		$(".slot-preview").click
		(
			function()
			{
				$("html,body").animate
				(
					{scrollTop : $("#Slot-Preview").offset().top } , 2000
				);
			}
		);
	}
);

//-------------Back Button-------------
$(document).ready
(
	function()
	{
		$(".back-button").click
		(
			function()
			{
				$("html,body").animate
				(
					{scrollTop : $("#Layout").offset().top} , 1500
				);
			}
		);
	}
);


//----------------Sticky navigation---------------

$(document).ready
(
	function()
	{
		$("#Layout").waypoint
		(
			function(direction)
			{
				if(direction == "down")
				{
					$("nav").addClass("sticky");

				}
				else
				{
					$("nav").removeClass("sticky");
				}
			},
			{
				offset : "30%"
			}
		);
	}
);
