<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Bedok 85</title>
    <meta charset= "utf-8">
    <link rel="stylesheet" href="../common/externalCSS1.css">
    <link rel="stylesheet" href="../common/externalCSS.css">
    <link rel="stylesheet" href="../common/overlay.css">
    <style>
      label{
          display:inline-block;
          width:180px;
          text-align:right
      }
      #wrapper{
      margin: auto;
      padding:50px;
      width: 1200px;
      margin-top: 3%;
      box-shadow: 0 5px 5px -5px #333
      }

      h2 {
          font-size: 200%;
      }

      #blk85picture{
          padding: 20px 50px 50px 50px;
          background-color:white;
          border-radius:20px;
          box-shadow: 0 5px 5px -5px #333
      }

      #blk85_map{
          padding:50px;
          background-color: white;
          border-radius:20px;
          margin-top: 20px;
          width: 1100px;
          box-shadow: 0 5px 5px -5px #333
      }
      #directions{
        width: 35%;
        height: 365px;
        float: left;
        border-radius:20px;
        border:2px solid black;
        box-shadow: 0 5px 5px -5px #333
      }

      #blk85_map_div{
          background-image:url("../common/img/Blk85_map.png");
          background-size: contain;
          background-repeat: no-repeat;
          margin-left:40%;
          height: 380px;

      }

      #contact_us_details{
        width: 100%;
        height: 560px;
        background-color: white;
        border-radius:20px;
        padding-top: 20px;
        margin-top:20px;
        box-shadow: 0 5px 5px -5px #333

      }
      #contact_us_details * {
        text-align: center;
        
      }

      #phone_details{
          width: 40%;
        height: 365px;
        float: left;
        border-radius:20px;
        margin-left:80px;
        border:2px solid black;
        box-shadow: 0 5px 5px -5px #333
      }

      #phone_details>div {
        margin: 10px 0px;
      }

      #email_details{
          width: 40%;
        height: 365px;
        float: right;
        border-radius:20px;
        margin-right:80px;
        border:2px solid black;
        box-shadow: 0 5px 5px -5px #333;
      }

      #email_details>div {
        margin: 10px 0px;
      }

      #phone_details center > img, #email_details center > img {
        margin-top: 30px;
      }

    </style> 
    <script type="text/javascript" src="../common/overlay.js"></script>
    <script type ="text/javascript" src ="about_us.js"></script>
  </head>  
    <body>
      <?php
      include("../login/logindb.php");
      if(!isset($_SESSION))
        session_start();
      ?>
          <?php include '../common/overlay.php' ?>
          <?php include '../common/top_header.php' ?>
          <!-- <script type="text/javascript" src="../common/overlayR.js"></script> -->
          
          <div id="wrapper">
              <div id="blk85picture">
              <h2 align='center'>About Us</h2>
              <center><img src ="../common/img/bedok85_background.jpg" height="500px" width="auto" id="blk85_pic"></center>
              <center><p style="font-size:15px">Located at 85 Bedok North Street 4,Singapore 460085, the humble food centre that servers affordable food for all!</br>
                                                      Being one of the OG food centres in Singapore, the food centre has been feeding people since it's opening in 1977.</br></p></center>
              </div>
              <div id="blk85_map">
                  <div id="directions">
                      <u><center>Directions to Bedok 85!</center></u><br>
                      <center>The following transport lines have routes that pass near bus stop 84231 (Blk85)<center><br>
                      <center><img src="../common/img/Bus.png">Bus: 14, 222, 46</center>
                      <center><img src="../common/img/Train.jpg"> Train: DOWNTOWN LINE, EASTWEST LINE</center><br><br>
                      The Bus stops right infront of Bedok 85 Market Centre!
                      
                  </div>
                  <div id="blk85_map_div">   
                  </div>
              </div>
              <div id="contact_us_details">
                  <h2 align="center">Contact us</h2>
                  <center><p style="font-size:25px;">Get in touch with us!</p></center>
                  <div id="phone_details">
                  <center><img src ="../common/img/Phone.jpg" height="80px" width="auto" id="phone_pic"></center>
                  <center>Phone</center>
                  <br>
                  <div><b>Bedok 85 Management Customer Service Department</b></div>
                  <div>+65 6587 1232</div>
                  <div><b>Bedok 85 Management Sales Department</b></div>
                  <div>+65 6587 0982</div>
                  <div><b>Bedok 85 Management Corporate Department</b></div>
                  <div>+65 6587 1234</div>
                  </div>
                  <div id="email_details">
                  <center><img src ="../common/img/email.jpg" height="80px" width="auto" id="phone_pic"></center>
                  <center>Email</center>
                  <br>
                  <div><b>Feedback and Enquiries</b></div>
                  <div>Blk85_CS@f32ee.com</div>
                  <div><b>Advertisement proposals</b></div>
                  <div>Blk85_Sales@f32ee.com</div>
                  <div><b>Employment Opportunities</b></div>
                  <div>Blk85_HR@f32ee.com</div>
                  </div>
                  
              </div>
      
          </div>
          <footer>
            <small>
              <i>Copyright &copy; Bedok 85
                <a href="mailto:\\192.168.56.2\f32ee">bedok85@f32ee.com</a>
              </i>
            </small>
          </footer>
    </body>
</html>
    