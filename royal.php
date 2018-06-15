<!DOCTYPE html>
<html lang="en">

<?php session_start(); 
include("config.php");
?>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>ROYAL Technology</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <!-- Custom styles for this template -->
    <link href="css/agency.min.css" rel="stylesheet">

    <style type="text/css">
    .map-responsive{
        overflow:hidden;
        padding-bottom:100%;
        position:relative;

    }
    .map-responsive iframe{
        left:0;
        top:0;
        height:100%;
        width:100%;
        position:absolute;
    }

</style>
</head>
<body id="main_page">
  <!-- Nav bar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#main_page">Royal Computers</a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#nav_res" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa fa-bars" ></i>
    </button>
    <div class="collapse navbar-collapse" id="nav_res">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#home"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
        </li>

        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#team">About Us</a>
        </li>
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#products">Product</a>
        </li>
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#service">Services</a>
        </li>
        <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="#contact">CONTACT</a>
        </li>

        <?php if(isset($_SESSION['login_user'])): ?>

            <li class="nav-item">
                <a class="nav-link js-scroll-trigger" href="#gallary">GALLARY</a>
            </li>
            <li class="nav-item">
                <li class="nav-item"> <a  class="nav-link js-scroll-trigger" data-toggle="modal" data-target="#model_manage_profile">Manage Profile</a> </li>
            </li>
            <li class="nav-item"> <a   class="nav-link js-scroll-trigger" href="logout.php" > <i class="fa fa-fw fa-sign-out"></i>LOGOUT</a> </li>
            <?php else: ?>
             <li class="nav-item"> <a  class="nav-link js-scroll-trigger" data-toggle="modal" data-target="#myModal"> <i class="fa fa-user"></i> Log In</a> </li>
         <?php endif; ?> 
     </ul>
 </div>
</div>
</nav>

<!-- Nav Bar Ends Here -->

<!-- Header -->
<div style="">
    <img src="apple21.jpg" width="100%" height="100%" >
</div>

<!-- Login form -->

<div class="modal fade" id="myModal">
    <div class="modal-dialog">
     <div class="modal-content">
        <div class="modal-header">
            <button class="close" data-dismiss="modal">X</button>
        </div>
        <center>  <img src="login.png" alt="Avatar" class="avatar" /></center>
        <div class=" modal-body">
            <form action="" method="POST"> 
                <label for="uname"><b>Username</b></label>
                <input type="Email" class="form-control" placeholder="Enter Username" name="username" required>

                <label for="psw"><b>Password</b></label>
                <input type="password"class="form-control" placeholder="Enter Password" name="password" required>
                <br>
                <button type="submit" class="btn btn-success btn-block" name="submit_login" >Sign in</button>

                <br>
                <br>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

<?php
if (isset($_POST['submit_login']))
{    

    $username=$_POST['username'];
    $password=$_POST['password'];

    $ses_sql="SELECT * FROM login WHERE uname='$username' and pass='$password'";
    $recent= mysqli_query($connect, $ses_sql);
    $row = mysqli_fetch_array($recent);
    $_SESSION['login_user']=$row['uname'];

    if (mysqli_num_rows( $recent) != 0)
    {
        session_start();
        echo "<script language='javascript' type='text/javascript'> location.href='royal.php' </script>";   
    }
    else
    {
        echo "<script type='text/javascript'>alert('User Name Or Password Invalid!')</script>";
    }
}
?>

<div class="modal fade" id="model_manage_profile">
    <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-header" style="background-color:#27c4ac;color: white; ">
        Change Account Password
        <button class="close" data-dismiss="modal">X</button>
    </div>

    <div class=" modal-body">
        <form action="" method="POST"  onSubmit="return validatePassword()" name="frmChange"> 
            <label for="uname"><b>Current Password</b></label>
            <input type="password"class="form-control" placeholder="Enter  Current  Password" id="currentPassword" name="old_password" required>
            <label for="uname"><b>New Password</b></label>
            <input type="password"class="form-control" placeholder="Enter  New  Password" id="newPassword" name="new_password" required>
            <label for="uname"><b>Confirm Password</b></label>
            <input type="password"class="form-control" placeholder="Enter  Conform  Password"  id="confirmPassword" name="cnfrm_password" required>
            <br>
            <div class="" id="ps"> </div>
            <button type="submit" class="btn btn-success btn-block" name="submit_profile" >Save</button>

            <br>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
<script>
    function validatePassword() {
        var newPassword,confirmPassword,output = true;
        newPassword = document.frmChange.newPassword;
        confirmPassword = document.frmChange.confirmPassword;
        if(newPassword.value != confirmPassword.value) {
            newPassword.value="";   
            confirmPassword.value="";
            newPassword.focus();
            document.getElementById("ps").innerHTML = "Please Enter The Same Password...!";
            document.getElementById("ps").setAttribute("class","alert alert-danger");
            output = false;
        }   
        return output;
    }
</script>
<?php
if (isset($_POST['submit_profile']))
{    

    $current_Password=$_POST['old_password'];
    $new_Password=$_POST['new_password'];

    $sql = "SELECT * FROM login where pass ='$current_Password'";
    $result = mysqli_query($connect, $sql);

    if (mysqli_num_rows($result) > 0) {
          $ses_sql1="UPDATE login SET pass = '$new_Password' where pass ='$current_Password' ";
        mysqli_query($connect, $ses_sql1);
        echo "<script type='text/javascript'>alert('Password Changed successfuly..!');</script>";
    } else {
        echo "<script type='text/javascript'>alert('Sorry Current Password is Invalid!')</script>";
    }
}
?>

<!-- About Section -->

<div class="container" >
  <div id="home"> </div>
  <br></br>
  <b><h1>Home</h1></b>
  <div class="jumbotron">
    <h5 class="large text-muted"><p>
       Royal Computers is located in the heart of Bhatkal city, established in the year 2014 draws it’s brand value from four years of experience in creating and maintaining strong customer relationships, proven aptitude to provide ultramodern technology to its clients along with exceptional service & support back-up and Infrastructure facility.
   </p><br><p>
      Royal Computers holds the distinction of having multi skilled technical professionals aiming to reduce the IT downtime thus contributing towards better IT returns alongside significant business results for its clients.

      We are preferred and quality vendors for a variety of branded products such as personal & desktop computers, notebook & laptops, servers, printers, scanners, CCTV Cameras and IP Cameras and other computer peripherals.

  </p><br><p>
      Optimum-Return-on-IT Investment and Best-Value-for-Money to our clients are foundation on which our business runs today. Integrating IT with Business for excellent business results is the key for modern day business. This applies to all the businesses regardless of the scale, size and geography. We are the pioneers providing IT solutions to range of segments like Corporate, Small & Medium Business, Small Office and Homes.
      <br></br>
  </p></h5>
</div>

</div>

<div class="container">
    <div class="row">
        <?php
        $imagesDirectory = "upload_images/";

        if(is_dir($imagesDirectory))
        {
            $opendirectory = opendir($imagesDirectory);
            
            while (($image = readdir($opendirectory)) !== false)
            {
                if(($image == '.') || ($image == '..'))
                {
                    continue;
                }

                $imgFileType = pathinfo($image,PATHINFO_EXTENSION);

                
                if(($imgFileType == 'jpg') || ($imgFileType == 'png'))
                    {  ?>

                        <div class="col-md-4">
                            <div class="thumbnail">
                                <?php
                                echo "<img src='upload_images/".$image."' alt='apple2'   width='100%' height='200' > ";
                                ?>
                                <div class="caption">
                                    <?php 
                                    $ses_sql="SELECT * FROM gallary WHERE photo_name ='$image' ";
                                    $recent= mysqli_query($connect, $ses_sql);
                                    $row = mysqli_fetch_array($recent);
                                    ?> <p> <?php echo $row["description"] ; ?> </p><br></br><?php
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                closedir($opendirectory);
            }
            ?>
        </div>
    </div>

    <?php if(isset($_SESSION['login_user'])): ?>
        <div class="container"  id="gallary">
          <br></br>
          <h3 >Gallary</h3>
          <br></br>
          <!-- Team -->
          <div class="jumbotron">
            <div class="container">
                <div class="team-member">  
                    <div class="rodw">
                        <div class="col-md-2">
                            <a class="nav-link js-scroll-trigger btn btn-primary" style="background-color: black; color: white;"  data-toggle="modal" data-target="#myModal1"  > <i class="fa fa-upload"></i> </span> Upload</a>
                            <br></br>
                        </div>  
                        <div class="col-lg-12">
                            <?php
                            $sql="SELECT *  FROM gallary";
                            $result=mysqli_query($connect,$sql);

                            ?>

                            <div class="table-responsive">  
                              <table id="editable_table" class="table table-hover ">
                                <thead style=" background-color:#27c4ac;color: white;">
                                  <tr>
                                    <th>ID</th>
                                    <th>Photo</th>
                                    <th>Desc</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
                              while($row = mysqli_fetch_array($result))
                              {
                                  echo'
                                  <tr>
                                  <td>'.$row["id"].'</td>
                                  <td>';  echo '<img  width="100%" height="200" src="upload_images/'.$row["photo_name"].'" />';echo'</td>
                                  <td> <textarea name="" id="" cols="45" rows="10">'.$row["description"].'</textarea></td>
                                  </tr>
                                  ';
                              }
                              ?>
                          </tbody>
                      </table>
                  </div>  
              </div>
          </div> 

          <div class="modal fade" id="myModal1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="royal.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <button class="close" data-dismiss="modal">X</button>
                        </div>
                        <center>  <img id="blah" src="#" alt="your image" class="avatar" /></center>
                        <div class=" modal-body">
                            <label for="comment">Desciption About Product:</label>
                            <br></br>
                            <textarea class="form-control" rows="5" id="comment" name="text"></textarea><br></br>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <input type='file' id="selected_file" onchange="readURL(this);" class="btn btn-info" title="Please Choose Only .jpg, .jpeg, .gif, .png formats allowed to a max size of 5 MB" name="photo" id="fileSelect" />
                            <input type="submit" class="btn btn-success"  name="submit_upload" value="Submit">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>


<?php
// Check if the form was submitted

if (isset($_POST['submit_upload'])){
    // Check if file was uploaded without errors
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];
        $desc = $_POST["text"];
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
        // Verify MYME type of the file
        if(in_array($filetype, $allowed)){
            // Check whether file exists before uploading it
            if(file_exists("upload_images/" . $_FILES["photo"]["name"])){
             echo "<script type='text/javascript'>alert('Photo is Already Exist..!')</script>";
         } else{
            move_uploaded_file($_FILES["photo"]["tmp_name"], "upload_images/" . $_FILES["photo"]["name"]);
            $sql1 = "INSERT INTO gallary (photo_name,description)
            VALUES('{$filename}','{$desc}')";
            if (mysqli_query($connect, $sql1)) {
                ?><script type='text/javascript'>
                    </script>"<?php
                } else {
                    echo "<script type='text/javascript'>alert('Error in Database..!')</script>";
                }

            } 
        } else{
            echo "<script type='text/javascript'>alert('There was a problem uploading your file. Please try again..!')</script>"; 
        }
    } else{
     echo "<script type='text/javascript'>alert('Error..! Please select Photo')</script>";
 }
}
?>
<?php endif; ?>
<!-- ABout Page staret Here -->
<div class="container"  id="team">
  <br></br>
  <h3 >About Us</h3>
  <br></br>
  <!-- Team -->
  <div class="jumbotron">
    <div class="container">

      <p>  When you choose Royal Computers  as your IT services, you will recognise our passion for client satisfaction, business process expertise, technology innovation and more. Our passion is to help our clients to enhance their business productivity. We help customers to do business better leveraging our industry-wide experience, deep technology expertise, comprehensive  services and a vertically aligned business model.
        We are dedicated for helping small and medium business organisations, government agencies and educational institutions to solve their real world business problems our technical solutions which includes implementation, system design, supporting services and consulting services. As a technical services provider, Royal Computers  team is committed to providing excellent customer service, professionalism, products and business practices. Our goal is to provide responsive and accurate resolutions.
        Royal Computers  offers a full range of IT solutions and support with special expertise. We design industry-specific IT solutions to help our clients take advantage of the new opportunities and adapt to the new challenges of a changing world. We are relentlessly focused on providing the absolute best people to lead and support our clients’ initiatives, we help our clients achieve their business targets better, faster and more cost-effectively.
    We offer IT-enabled business solutions along with a complete range of services. We believe our responsibilities also extend beyond business and we behave ethically and honestly in all our interactions – with our clients, our partners and our employees.</p>

</div>

</div>
</div>
<div class="container" >
  <div id="products"> </div>
  <br></br>
  <b><h1>Products</h1></b>
  <div class="jumbotron">
    <h4>Desktops & Notbooks</h4>
    <h5 class="large text-muted"><p>
       Royal Computers caters to customized desktop requirements of enterprise, institutional and home segment customers at an affordable price. Clients are offered both branded and assembled personal computers as per the requirements. Entry level, Mainstream, Performance and Gaming desktops are offered to Enterprise, small office and Home segment customers. Royal Computers deals in branded computers like HP, Dell, Lenovo and Acer to meet the brand aspirations of its valued client base.
</p><br>
   
    <img src="img/apple.png" width="140px" height="100px">&nbsp;&nbsp;&nbsp;
     <img src="img/lenovo.png" width="140px"> &nbsp;&nbsp;&nbsp;
    <img src="img/dell.png" width="140px" height="100px">&nbsp;&nbsp;&nbsp;
    <img src="img/hp.png" width="140px" height="100px">&nbsp;&nbsp;&nbsp;
    <img src="img/acer.png" width="140px" height="100px">&nbsp;&nbsp;&nbsp;
    <img src="img/asus.png" width="140px" height="100px">&nbsp;&nbsp;&nbsp;
<br>
<br>
<p>
     Royal Computers takes pride in selling assembled desktops to its existing and prospective client segment. Assembled computers provide high bandwidth and flexibility through customization by offering latest and advanced technology at an affordable price


  </p><br></h5>
</div>

</div>
<div class="container" >
  <div id="service"> </div>
  <br></br>
  <b><h1>IT Services</h1></b>
  <div class="jumbotron">
    <h5 class="large text-muted"><p>
      Royal Computers helps you to achieve a flexible, effective and a robust IT strategy by providing you system integration, testing, application development and management services and solutions. Make progress through business-specific applications that drive better performance, efficiency and cost-effectiveness. 
       </p><br><p>
      Our experts can help you build and manage an IT infrastructure that equals the demands of a changing business environment. We can help you improve performance, enhance productivity and drive new growth initiatives.
  </p><br><p>
      Need help selecting the right equipment to suit your needs? Do you have a system that needs troubleshooting and resolution? Contact the Royal Computers for all your equipment needs!
      <ul>
          <li>AMC (Annual Maintenance Contract)</li>
          <li>Network set-up & administration</li>
        <li> Desktop administration</li> 

      </ul>
      <br></br>
  </p></h5>
</div>

</div>

<!-- Contact Section -->
<div class="container " >

  <h3 style="padding:65px 16px" id="contact">CONTACT</h3>
  <div class="jumbotron">
    <div class="row">
      <div class="col-md-5">
        <p><i class="fa fa-map-marker fa-fw xxlarge margin-right"></i> Bhatkal, Karnatka</p>
        <p><i class="fa fa-phone fa-fw xxlarge margin-right"></i>Call <a href="tel:9900962167"> 9900962167</a></p>

        <p><i class="fa fa-envelope fa-fw xxlarge margin-right"> </i> Email:<a href="mailto:krish@gmail.com"> Krishna@gmail.com</a></p>
        <br></br>
        <form action="royal.php" method="post" >
          <p><input class="form-control" type="text" placeholder="Name" required name="name"></p>
          <p><input class="form-control" type="email" placeholder="Email" required name="email"></p>
          <p><input class="form-control" type="text" placeholder="Subject" required name="subject"></p>
          <p><textarea class="form-control" placeholder="Type your Message here..." name="msg"></textarea></p>
          <p>
            <button class="btn snd_btn btn-primary" type="submit" style="background-color: black; color: white;" name="submit_contact">
              <i class="fa fa-paper-plane"></i> SEND MESSAGE
          </button>
      </p>
  </form>
</div>

<div class="col-md-7">

    <div class="map-responsive">
        <iframe src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d813.8549848309156!2d74.55025929806868!3d13.996147646671115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x3bbc42e110f760a1%3A0x5fd0e094251f5e02!2sRoyal+Electricals%2C+damda+residency%2C+sagar+road%2C+near+shamshuddin+circle%2C+Belalkanda%2C+Bhatkal%2C+Karnataka+581320!3m2!1d13.9964096!2d74.5501901!5e0!3m2!1sen!2sin!4v1528643206541" width="600" height="530" frameborder="0" style="border:1" allowfullscreen></iframe>

    </div>

</div>
</div>
</div>
</div>
</div>

<?php
if(isset($_POST["submit_contact"])){

    $name=$_POST['name'];
    $email=$_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['msg'];
    $headers = 'From:'. $email . "rn"; // Sender's Email
    $headers .= 'Cc:'. $email . "rn"; // Carbon copy to Sender
    // Message lines should not exceed 70 characters (PHP rule), so wrap it
    $message = wordwrap('From:-\n '.$name.'\n Message:-'.$message, 70);
    // Send Mail By PHP Mail Function
    mail("shreekrishnajangid12@gail.com", $subject, $message, $headers);
    echo "<script type='text/javascript'>alert('Your mail has been sent successfuly ! Thank you for your feedback..!')</script>";
}  
?>

<!-- Footer -->
<footer class=" bg-dark">
    <div class="row">
       <div class="col-md-12">
        <br>
        <ul class="list-unstyled list-inline text-center">
         <p align=""><a href="#main_page" class="btn btn-info js-scroll-trigger"><i class="fa fa-arrow-up margin-right"></i>To the top</a></p>
         <br>
         <h4 style="color:white;">Follow Us</h4>

         <li class="list-inline-item">
           <a target="_blank" href="http://www.facebook.com">
            <button  class="btn btn-default" style="background-color: #4286f4; color: white;border-radius: 100px"><span class="fa fa-facebook"  ></span> </button>
        </a>
    </li>
    <li class="list-inline-item">
      <a target="_blank" href="http://www.twitter.com">
        <button  class="btn btn-default" style="background-color: #55acee; color: white;border-radius: 100px"><span class="fa fa-twitter"  ></span> </button>
    </a>
</li>
<li class="list-inline-item">
  <a target="_blank" href="http://www.gmail.com">
    <button  class="btn btn-default" style="background-color:#dd4b39; color: white;border-radius: 100px"><span class="fa fa-google-plus"  ></span> </button>
</a>
</li>
<li class="list-inline-item">
  <a target="_blank" href="http://www.twitter.com">
    <button  class="btn btn-default" style="background-color: #0073b2; color: white;border-radius: 100px"><span class="fa fa-linkedin"  ></span> </button>
</a>

</ul>
</div>
</div>
<!-- Copyright -->
<div class="footer-copyright text-center py-3 " style="color:white;">© 2018 Copyright:
  Krishna Jangid
  <br>
</div>
<!-- Copyright -->

</footer>
<!-- Footer -->


</body>
</html>


<!-- Bootstrap core JavaScript -->
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/jquery.tabledit.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.min.js"></script>
<script src="js/agency.min.js"></script>

<script type="text/javascript">  
    $(document).ready(function(){  
     $('#editable_table').Tabledit({
      url:'action.php',
      editButton: true,
      deleteButton: true,
      buttons: {
        delete: {
            class: 'btn btn-sm btn-danger',
            html: '<span class="glyphicon glyphicon-trash"></span> &nbsp DELETE',
            action: 'delete'
        },
        confirm: {
            class: 'btn btn-sm btn-info',
            html: 'Are you sure?'
        },
        edit: {
            class: 'btn btn-sm btn-primary',
            html: '<span class="glyphicon glyphicon-pencil"></span> &nbsp EDIT',
            action: 'edit'
        }
    },
    columns:{
       identifier:[0, "id"],
       editable:[[2,'desc']]
   },
   restoreButton:false,

   onSuccess:function(data, textStatus, jqXHR)
   {
     location. reload(true);
 }

});

 });    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah')
                .attr('src', e.target.result)
                .width(200)
                .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>   