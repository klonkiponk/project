<link href="css/jquery-ui-1.10.0.custom.css" rel="stylesheet">
<script src="js/jquery-1.9.0.js"></script>
<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
<script type="text/javascript">
	$(function() {	
		/*$(".datepicker").datepicker({
			inline: true,
			dateFormat: 'yy-mm-dd'
		}).val();*/
/* New Test, that tries to get rid of the problem with pointing to the first text input field*/
$('.datepicker').each(function(){
    $(this).datepicker({
   			inline: true,
			dateFormat: 'yy-mm-dd'
    });
});


$(".taskToggler").click(function(){
	$("form.newTask").slideToggle();
});

$(".primaryTaskToggler").click(function(){
	$("form.newPrimaryTask").slideToggle();
});

$(".holidayToggler").click(function(){
	$("form.newHoliday").slideToggle();
});



<?php 
$sql = "SELECT usershortname FROM users GROUP BY usershortname";
$usershortnames = $GLOBALS['DB']->query($sql);
while($user = $usershortnames->fetch_array()){
	echo '	$(".'.$user['usershortname'].'").click(function(){
				$(".'.$user['usershortname'].'").toggleClass("highlightDay")
			});';
}
?>

		<?php
		for($i = 01;$i <= 31;$i++){
		
			if($i < 10){
				echo '
					$(".day0'.$i.'").mouseover(function(){
						$(".day0'.$i.'").addClass("highlightDay")
					});
					$(".day0'.$i.'").mouseleave(function(){
						$(".day0'.$i.'").removeClass("highlightDay")
					});	
				';
			}
			else {
				echo '
					$(".day'.$i.'").mouseover(function(){
						$(".day'.$i.'").addClass("highlightDay")
					});
					$(".day'.$i.'").mouseleave(function(){
						$(".day'.$i.'").removeClass("highlightDay")
					});	
				';
			}
		}
		?>
	});
</script>