<!DOCTYPE html>
<html lang = "en">
<head>
<title> Bedok 85 Hawker Centre </title>
<meta charset= "utf-8">
<link rel="stylesheet" href="../common/externalCSS1.css">
<link rel="stylesheet" href="../common/externalCSS.css">
<link rel="stylesheet" href="../common/overlay.css">
<script type="text/javascript" src="../common/overlay.js"></script>
<style>

label{
    display:inline-block;
    width:180px;
    text-align:right
}
h2 {
  font-size: 200%;
  padding: 5px;
}

#wrapper{
margin: auto;
padding:75px;
margin-top:3%;
box-shadow: 0 5px 5px -5px #333
}
#wrapper{
    width: fit-content;
}

footer {
  position: relative;
  display: block;
  bottom: 0px;
}

</style>
</head>

<body>
<?php
    include '../login/logindb.php';
    include '../common/top_header.php';
    include '../common/overlay.php';
?>
<script type ="text/javascript" src ="contact_us.js"></script>
        <div id="wrapper">
            <div id='contactform'>
            <form action="" method="GET" id="contact_us_form">
            <label for="name">Name: </label>
            <input type="text" id="fname" name="firstname">
            </div>

            </form>
        </div>

<footer>
<small>
<i>Copyright &copy; Bedok 85
<a href="mailto:\\192.168.56.2\f32ee">bedok85@f32ee.com</a>
</i>
</small>
</footer>
</body>