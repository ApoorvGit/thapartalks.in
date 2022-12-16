<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['email'])) header('location: index.php');
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <link rel="icon" href="images/logo.PNG" type="image/PNG">
  <meta name="author" content="">
  <!--Google sign in-->
  <meta name="google-signin-scope" content="profile email">
  <meta name="google-signin-client_id" content="659283534062-uquu2nfgighoftp4tk334bfrbe2qscbe.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://apis.google.com/js/api:client.js"></script>
  <title>Connecting Thaparians</title>

  <link href="login/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="login/css/main.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
<!--google sign in script-->
<script>
    function senddetail(email,name){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //document.getElementById("show").innerHTML = this.responseText;
                window.location.href = "index.php";
            }
        };
        let domain=email.split('@');
        if(domain[1]=="thapar.edu"||email=="jashan2100@gmail.com"||email=="apoorvmishra1000@gmail.com"||email=="coolapoorvmishra@gmail.com"){
            xmlhttp.open("POST", "login2.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("name="+name+"&email="+email);
        }else{
             document.getElementById('name').innerText = "Verification failed";
        }
        
    }
    var googleUser = {};
    var startApp = function() {
      gapi.load('auth2', function(){
        // Retrieve the singleton for the GoogleAuth library and set up the client.
        auth2 = gapi.auth2.init({
          client_id: '659283534062-uquu2nfgighoftp4tk334bfrbe2qscbe.apps.googleusercontent.com',
          cookiepolicy: 'single_host_origin',
          // Request scopes in addition to 'profile' and 'email'
          //scope: 'additional_scope'
        });
        attachSignin(document.getElementById('customBtn'));
      });
    };
  
    function attachSignin(element) {
      console.log(element.id);
      auth2.attachClickHandler(element, {},
          function(googleUser) {
            var profile = googleUser.getBasicProfile();
            document.getElementById('name').innerText = "Verifying, Wait for a while."
                senddetail(profile.getEmail(),profile.getName());
          }, function(error) {
            alert(JSON.stringify(error, undefined, 2));
          });
    }
    </script>
    <script>startApp();</script>
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <img src="images/icon.PNG" style="width:100%;padding-bottom: 1em;">
                    <h5 class="h5 text-black-900 mb-4">Connecting Thaparians</h5> 
                    <h1 class="h2 text-gray-900 mb-4">Welcome</h1> 
                    <img src="images/namaskaram.gif" style="padding-bottom: 1em;">                 
                  </div>
                  <div class="user">
                      <center>
                    <div class="btn btn-google btn-user btn-block customGPlusSignIn" id="customBtn" style="width:228px;">
                        <i class="fab fa-google fa-fw"></i> <b>Log/Sign in with Google</b>
                    </div>
                    <div id="name"></div>

                    
                   <!--   <div scope="public_profile,email" onlogin="checkLoginState();" class="fb-login-button" data-size="large" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width=""></div>
                    -->
                    <div id="status"></div>  
                    <div id="show"></div>  
                    </center>              
                  </div>
                  
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>


  <script src="login/vendor/jquery/jquery.min.js"></script>
  <script src="login/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


  <script src="login/vendor/jquery-easing/jquery.easing.min.js"></script>

  <script src="login/js/main.js"></script>

</body>

</html>
