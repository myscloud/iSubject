$(function(){

	$(".dropdown-menu li a").click(function(){
		$(".btn:first-child").text($(this).text());
		if($(this).text()=='Student'){
			$(".btn:first-child").val(1);
		}else if($(this).text()=='Teacher'){
			$(".btn:first-child").val(2);
		}else{
    		$(".btn:first-child").val(3);
		}

	});

});