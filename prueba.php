<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=windows-1252" http-equiv="Content-Type" />
<title>Untitled 1</title>
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
 <script type="text/javascript">
 $(document).ready(function(){
 $("#msex").click(function(){

 $("#fname").attr("disabled",true);
  $("#hname").removeAttr("disabled");
 });
 $("#fsex").click(function(){

 $("#fname").removeAttr("disabled");
  $("#hname").attr("disabled",true);
 });
 });
 </script>
</head>

<body>

<input type="radio" id="msex"value="male" name="sex"/> Male
<input type="radio" id="fsex" name="sex" value="female" /> Female    </div>
Father's Name<input type="text" id="fname" />
Husband's Name<input type="text" id="hname" />


</body>

</html>