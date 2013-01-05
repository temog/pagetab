<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Facebookキャンペーンサンプル</title>
<style type="text/css">
body {
	margin:0 auto;
	padding:0;
	width:810px;
}
#header, #footer {
	background-color:#666;
	color:#fff;
	text-align:right;
}
#content {
	margin: 5px 10px;
}
</style>

<script type="text/javascript" src="https://connect.facebook.net/ja_JP/all.js"></script>
<script type="text/javascript">
window.fbAsyncInit = function() {
	FB.init({
		appId : '<?php echo $appId; ?>',
		status : true,
		cookie : true,
		xfbml : true,
		logging : true
	})

	FB.Canvas.setAutoGrow();
	FB.Canvas.scrollTo(0, 0);
};
</script>
</head>
<body>
<div id="header">
header parts
</div>

