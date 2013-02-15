<head>
    <meta charset="UTF-8">
    <title>Heckhaus</title>
    <link rel ="stylesheet" href="css/style.css" type="text/css" />
    
    
    <link rel="apple-touch-icon" href="img/touch-icon-iphone.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="img/touch-icon-ipad.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="img/touch-icon-iphone-retina.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="img/touch-icon-ipad-retina.png" />
    
    
    <!-- iOS Specifics letting it look like a native App -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    
    <meta name="apple-mobile-web-app-status-bar-style" content="translucent black" />
    
    <link rel="apple-touch-startup-image" href="img/startup.png">
    
    <?php
    /********************\
    	iOS
    \********************/
    if (preg_match("/\biPhone\b/i",$_SERVER['HTTP_USER_AGENT']) OR preg_match("/\biPad\b/i",$_SERVER['HTTP_USER_AGENT']))   
    {
		echo '<link rel="stylesheet" href="css//iOS.css">';   
    }?>
</head>