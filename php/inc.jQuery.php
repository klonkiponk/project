<link href="css/jquery-ui-1.10.0.custom.min.css" rel="stylesheet">
<script src="js/jquery-1.9.0.js"></script>
<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
<script type="text/javascript">
	$(function() {	
		$(".datepicker").datepicker({
			inline: true,
			dateFormat: 'yy-mm-dd'
		}).val();
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