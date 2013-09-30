<?
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-script-type" content="text/javascript" />
    <meta http-equiv="content-style-type" content="text/css" />
	<title>E-Detailing</title>
    <script src="http://www.google.com/jsapi" type="text/javascript"></script>
	<script type="text/javascript">
	    google.load("jquery", "1.4.2");
		google.load("jqueryui", "1.7.2");
	</script>
	<link rel="stylesheet" type="text/css" href="stylesheets/style.css" media="all" />
	<script type="text/javascript" src="script/slide.js"></script>
</head>
	<body>
		<div id="wrapper">
			<div id="headerDiv">Header</div>
			<div id="frame">
				<!--<input type="button" name="" id="" value="save" onclick="return saveDta()"/>-->
			</div>
			<div id="rightDiv">
				<div id="specfcatnDiv">
					<table id="specfcatnTabl">
						<tr>
							<td colspan="3" style="text-align:center">Specifications</td>
						</tr>
						<tr height="5px"></tr>
						<tr>
							<td>Width</td>
							<td>:</td>
							<td><input type="text" name="sepcWdth" id="sepcWdth" onchange="return changeWdth()" /></td>
						</tr>
						<tr height="5px"></tr>
						<tr>
							<td>Height</td>
							<td>:</td>
							<td><input type="text" name="sepcHght" id="sepcHght" onchange="return changeHght()" /></td>
						</tr>
						<tr height="5px"></tr>
						<tr>
							<td>Bg Color</td>
							<td>:</td>
							<td><input type="text" name="sepcBgColor" id="sepcBgColor" onchange="return changeColor()" /></td>
						</tr>
						<!--<tr height="5px"></tr>
						<tr>
							<td>Bg Image</td>
							<td>:</td>
							<td><input type="file" name="sepcBgImg" id="sepcBgImg" onchange="return changeColor()" /></td>
						</tr>-->
					</table>
				</div>
				<div id="options">
					<div id="drag1" class="drag"></div>
				</div>
			</div>
		</div>
		<div id="div_id"></div>
	</body>
</html>