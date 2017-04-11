<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title><?php echo $title; ?> - <?php echo $SITE; ?></title>

  <!-- CSS  -->
  <link href="<?php echo $RESOURCE . 'img/osa-logo.png'; ?>" type="image/png" rel="icon">
  <link href="<?php echo $RESOURCE . 'css/icons/icons.css'; ?>" rel="stylesheet">
  <link href="<?php echo $RESOURCE . 'css/materialize.css'; ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo $RESOURCE . 'css/style.css'; ?>" type="text/css" rel="stylesheet" media="screen,projection"/>

  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '530350553818701',
      xfbml      : true,
      version    : 'v2.6'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
  </script>
  <meta name="google-signin-client_id" content="424405090188-s8g0jvl1ulst145iim00jskovgfa20fa.apps.googleusercontent.com">
    <!--  Scripts-->
  <script src="<?php echo $RESOURCE . 'js/jquery.min.js'; ?>"></script>
  <script src="<?php echo $RESOURCE . 'js/jquery-ui.min.js'; ?>"></script>
  <script src="<?php echo $RESOURCE . 'js/materialize.js'; ?>"></script>
</head>
<body>

  <!-- Header -->
  <div id="banner">
    <div class="row">
        <div class="firstheader container center valign-wrapper" style="position:relative; float:left; padding-top:1%; margin-left:24%; margin-right: 24%;">
            <div class="uplbheader" style="padding-right:2%; position:relative;">
              <img src="<?php echo $RESOURCE . 'img/uplb-logo.png'; ?>">
            </div>
            <div class="upheader" style="position:relative;">
              <h5 class="center txtlogo uplbtext">University of the Philippines Los Baños</h5>
              <h3 class="center txtlogo osatext">Office of Student Affairs</h3>
            </div>
            <div class="osaheader" style="padding-left:2%; position:relative;">
              <img src="<?php echo $RESOURCE . 'img/osa-logo.png'; ?>">
            </div>
        </div>
        <div class="secondheader container center valign-wrapper" style="position:relative; float:left; padding-top:1%; margin-left:20%;">
            <div class="osaheader center" style="position:relative;">
              <img src="<?php echo $RESOURCE . 'img/osa-logo.png'; ?>">
            </div>
            <div class="upheader" style="position:relative; padding-left:2%">
              <h4 class="center txtlogo">Office of Student Affairs</h4>
            </div>
        </div>
        <div class="thirdheader container center" style="position:relative; float:left; padding-top:1%; margin-left:20%;">
            <div class="osaheader center" style="position:relative;">
              <img src="<?php echo $RESOURCE . 'img/osa-logo.png'; ?>">
            </div>
        </div>
    </div>
  </div>

  <!-- Dropdown Structure -->
  <ul id="aboutOsa" class="dropdown-content">
    <li class="active unclick"><a class="black-text" href="#">About OSA</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">What is OSAM?</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">Mission and Vision</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">Message from the Director</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">Career Opportunities</a></li>
    <li class="divider"></li><li class="divider"></li>
  </ul>

  <ul id="studentOrgs" class="dropdown-content">
    <li class="active unclick"><a class="black-text" href="#">Student Orgs</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">Recognized Orgs</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">Apply for Recognition</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">Recognition Guidelines</a></li>
    <li class="divider"></li><li class="divider"></li>
  </ul>

  <ul id="assistance" class="dropdown-content">
    <li class="active unclick"><a class="black-text" href="#">Financial Assistance</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">Scholarships</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">Student Assistantship</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">Socialized Tuition System (STS)</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">Student Loan Board (SLB)</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">Cash Loans</a></li>
    <li class="divider"></li><li class="divider"></li>
  </ul>

  <ul id="downloads" class="dropdown-content">
    <li class="active unclick"><a class="black-text" href="#">Downloads</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">S.A. Separation Form</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">Academic Calendar</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">Telephone Directory</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">UPTIME OSA Newsletter</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="white-text" href="#">OSA Annual Report</a></li>
    <li class="divider"></li><li class="divider"></li>
  </ul>

  <ul id="loggedin" class="dropdown-content">
    <li class="active unclick"><a class="black-text" href="#">Profile</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a id="editbutton" class="white-text">Edit</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a id="logoutbutton" class="white-text">Log out</a></li>
    <li class="divider"></li><li class="divider"></li>
  </ul>

  <!-- Collapsible -->
  <ul id="aboutOsa2" class="dropdown-content">
    <li class="active unclick"><a class="black-text" href="#">About OSA</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">What is OSAM?</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">Mission and Vision</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">Message from the Director</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">Career Opportunities</a></li>
    <li class="divider"></li><li class="divider"></li>
  </ul>

  <ul id="studentOrgs2" class="dropdown-content">
    <li class="active unclick"><a class="black-text" href="#">Student Orgs</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">Recognized Orgs</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">Apply for Recognition</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">Recognition Guidelines</a></li>
    <li class="divider"></li><li class="divider"></li>
  </ul>

  <ul id="assistance2" class="dropdown-content">
    <li class="active unclick"><a class="black-text" href="#">Financial Assistance</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">Scholarships</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">Student Assistantship</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">Socialized Tuition System (STS)</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">Student Loan Board (SLB)</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">Cash Loans</a></li>
    <li class="divider"></li><li class="divider"></li>
  </ul>

  <ul id="downloads2" class="dropdown-content">
    <li class="active unclick"><a class="black-text" href="#">Downloads</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">S.A. Separation Form</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">Academic Calendar</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">Telephone Directory</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">UPTIME OSA Newsletter</a></li>
    <li class="divider"></li><li class="divider"></li>
    <li><a class="collapsible-drop" href="#">OSA Annual Report</a></li>
    <li class="divider"></li><li class="divider"></li>
  </ul>

  <!-- Main Navigation -->
  <div class="tobefixed z-depth-3">
    <nav>
      <div class="nav-wrapper">

        <ul>
          <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons" style="margin-left:2%;">menu</i></a>
        </ul>
        <a href="" onclick="homepage()" id="osalogonav" class="brand-logo left" style="display: none;"><img src="<?php echo $RESOURCE . 'img/osa-logo.png'; ?>" style="width: 50px; height: 50px; margin-top: 5px;"></a>
        <a href="#" id="osalogonav2" class="brand-logo center" style="display: none;"><img src="<?php echo $RESOURCE . 'img/osa-logo.png'; ?>" style="width: 50px; height: 50px; margin-top: 5px;"></a>
        <div>
          <ul class="left hide-on-med-and-down">
            <li><a href="" onclick="homepage()">Home</a></li>
            <li><a href="badges.html">News</a></li>
            <li><a href="collapsible.html">Bulletin Board</a></li>
            <li><a href="mobile.html">Counseling</a></li>
            <li><a href="mobile.html">Mailing List</a></li>
            <li><a href="mobile.html">Contact OSA</a></li>
          </ul>
          <ul class="right hide-on-med-and-down">
            <!-- About OSA -->
            <li><a class="dropdown-button" href="#!" data-activates="aboutOsa">About OSA<i class="material-icons right">arrow_drop_down</i></a></li>
            <!-- Student Orgs -->
            <li><a class="dropdown-button" href="#!" data-activates="studentOrgs">Student Orgs<i class="material-icons right">arrow_drop_down</i></a></li>
            <!-- Financial Assistance -->
            <li><a class="dropdown-button" href="#!" data-activates="assistance">Financial Assistance<i class="material-icons right">arrow_drop_down</i></a></li>
            <!-- Downloads -->
            <li><a class="dropdown-button" href="#!" data-activates="downloads">Downloads<i class="material-icons right">arrow_drop_down</i></a></li>

            <?php if (isset($SESSION['googleid'])): ?>
              
                  <li id="buttonlogin" style="display:none;"><a class="loginbtn btn modal-trigger" href="#loginmodal">Log In</a></li>
                  <?php if (isset($SESSION['imgurl'])): ?>
                    
                        <li id="profiletab" style="background-color: transparent; margin-top:3px;"><a class="dropdown-button" href="#!" data-activates="loggedin"><img id="profileimage" style="height:55px; width:55px;" class="circle" src="<?php echo $SESSION['imgurl']; ?>"></a></li>
                    
                    <?php else: ?>
                        <li id="profiletab" style="background-color: transparent; margin-top:3px;"><a class="dropdown-button" href="#!" data-activates="loggedin"><img id="profileimage" style="height:55px; width:55px;" class="circle" src="<?php echo $UI . 'img/placeholder.png'; ?>"></a></li>            
                    
                  <?php endif; ?>
              
              <?php else: ?>
                  <li id="buttonlogin"><a class="loginbtn btn modal-trigger" href="#loginmodal">Log In</a></li>
                  <li id="profiletab" style="background-color: transparent; margin-top:3px; display:none;"><a class="dropdown-button" href="#!" data-activates="loggedin"><img id="profileimage" style="height:55px; width:55px;" class="circle" src="<?php echo $RESOURCE . 'img/osa-logo.png'; ?>"></a></li>             
              
            <?php endif; ?>
                 
                    
          </ul>
        </div>
      </div>
    </nav>
  </div>


  <!-- Mobile Version -->
  <ul class="side-nav" id="mobile-demo">
    <li><a class="white-text" href="sass.html">Home</a></li>
    <li><a class="white-text" href="badges.html">News</a></li>
    <li><a class="white-text" href="collapsible.html">Bulletin Board</a></li>
    <li><a class="white-text" href="mobile.html">Counseling</a></li>
    <li><a class="white-text" href="mobile.html">Mailing List</a></li>
    <li><a class="white-text" href="mobile.html">Contact OSA</a></li>
    <!-- About OSA -->
    <li><a class="dropdown-button" href="#!" data-activates="aboutOsa2">About OSA<i class="material-icons right">arrow_drop_down</i></a></li>
    <!-- Student Orgs -->
    <li><a class="dropdown-button" href="#!" data-activates="studentOrgs2">Student Orgs<i class="material-icons right">arrow_drop_down</i></a></li>
    <!-- Financial Assistance -->
    <li><a class="dropdown-button" href="#!" data-activates="assistance2">Financial Assistance<i class="material-icons right">arrow_drop_down</i></a></li>
    <!-- Downloads -->
    <li><a class="dropdown-button" href="#!" data-activates="downloads2">Downloads<i class="material-icons right">arrow_drop_down</i></a></li>
    <li class="divider"></li><li class="divider"></li>
    <?php if (isset($SESSION['googleid'])): ?>
      
        <li><a id="logoutbutton2" class="white-text loginbtn btn">Log out</a></li>
      
      <?php else: ?>
        <li><a class="loginbtn btn modal-trigger" href="#loginmodal">Log In</a></li>                 
      
    <?php endif; ?>
  </ul>

  <!-- Modal Structure -->

  <div id="loginmodal" class="modal modal-fixed-footer">
    <div class="modal-content grey lighten-3">
       <div class="row">
        <div class="col s12 m6">
          <h3 class="center upmaroon quicksand">Login</h3>
            <form class="col s12">
              <div class="row">
                  <div class="input-field col s12">
                      <input id="username" type="text" class="validate">
                      <label for="username">OSAM or S1 Username</label>
                  </div>
              </div>
              <div class="row">
                  <div class="input-field col s12">
                      <input id="password" type="password" class="validate">
                      <label for="password">OSAM or S1 Password</label>
                  </div>
              </div>
              <div class="row">
                  <div class="col m12">
                      <p class="center-align">
                          <button id="loginbutton" class="loginbtn2 btn btn-large" type="button" name="action">Login</button>
                      </p>
                  </div>
              </div>
            </form>

            <div class="container center">
              <p class="upmaroon">Sign in using your UP.EDU.PH Account:</p>
              <div class="googlesignin g-signin2 valign" data-onsuccess="onSignIn" style="padding-left:75px;"></div>
            </div>
            <br>
            <h5 class="center">No account? <a href="#" class="upmaroon">Create an account.</a></h5>
        </div>

        <div class="col s12 m6">
          <div class="icon-block">
            <h2 class="center upmaroon"><i class="material-icons">info_outline</i></h2>
            <h5 class="center upmaroon quicksand">Reminders</h5>

            <ul>
              <li><p class="light indent1"><b>Keep your password to yourself.</b> Sharing this to anyone is a violation of the <a href="#" class="upmaroon">Acceptable Use Policy of the UP System.</a> Violators shall suffer suspension ranging from one week to one year.</p></li>
              <li><p class="light indent1"><b>Account Problems:</b> Proceed to the offices listed below and bring validated UPLB ID or any other valid ID plus Form 5.</p>
                <ul class="bullet" style="padding-left:30px;">
                  <li><p class="light"><b>OSAM:</b> Communication and Information Technology, Room 7, 2/F Student Union Building.</p></li>
                  <li><p class="light"><b>SystemOne:</b> C-116, Institute of Computer Science, Physical Sciences Building.</p></li>
                  <li><p class="light"><b>e-UP/UP Mail:</b> Information Technology Center, 2/F AG Samonte Hall.</p></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </div>
    <div class="modal-footer grey lighten-4">
      <a href="#!" class=" modal-action modal-close btn-flat">Close</a>
    </div>
  </div>
  
  <br>

  <div class="container" style="margin-left:10%;">
    <div class="section">

      <div class="row">

        <div class="col s12 m7" style="margin-top:10px;">
          <h4 class="upmaroon" style="width:500px;">News</h4>
          <li class="divider3"></li>
          <div class="carousel">
            <a class="carousel-item" href="#one!"><img src="<?php echo $UI . 'img/news1.jpg'; ?>"><p class="center upmaroon">204 children receive school supplies during Off-the-Street, On-to-School project</p></a>
            <a class="carousel-item" href="#two!"><img src="<?php echo $UI . 'img/news2.jpg'; ?>"><p class="center upmaroon">UPLB front line personnel undergo life coaching seminar</p></a>
            <a class="carousel-item" href="#three!"><img src="<?php echo $UI . 'img/news3.jpg'; ?>"><p class="center upmaroon">ISA organizes Cultural Night 2015: Unifying Force for Global Community</p></a>
            <a class="carousel-item" href="#four!"><img src="<?php echo $UI . 'img/news4.jpg'; ?>"><p class="center upmaroon">UPLB Student Assistantship System attracts interest during UP System financial assistance workshop</p></a>
            <a class="carousel-item" href="#five!"><img src="<?php echo $UI . 'img/news5.jpg'; ?>"><p class="center upmaroon">ISD commissions nine new UPLB Ambassadors, recognizes past heads</p></a>
          </div>
          <br>
          <br>
          <!-- Switch -->
          <div class="switch" style="margin-top: 0;">
            <label class="upgreen">
              Off
              <input id="oncarousel" checked type="checkbox">
              <span class="lever"></span>
              On
            </label>
          </div>
        </div>

        <div class="col s12 m3 offset-m1" style="margin-top:10px;">

          <h4 class="upmaroon" style="width:500px;">OSAM Calendar</h4>
          <li class="divider2"></li>
          <br>

          <iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showNav=0&amp;showPrint=0&amp;mode=AGENDA&amp;height=300&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=uplbosa.org_8o0da47g5ueg2bfcks981al5n0%40group.calendar.google.com&amp;color=%23333333&amp;ctz=Asia%2FManila" style="border-width:0" width="500" height="300" frameborder="0" scrolling="no"></iframe>
          
          <h4 class="upmaroon" style="width:500px;">OSAM Bulletin Board</h4>
          <li class="divider2"></li>
          <br>

          <div class="slider">
            <ul class="slides">
              <li>
                <a href="#"><img src="<?php echo $UI . 'img/bb1.jpg'; ?>"></a> <!-- random image -->
              </li>
              <li>
                <a href="#"><img src="<?php echo $UI . 'img/bb2.jpg'; ?>"></a> <!-- random image -->
              </li>
              <li>
                <a href="#"><img src="<?php echo $UI . 'img/bb3.jpg'; ?>"></a> <!-- random image -->
              </li>
              <li>
                <a href="#"><img src="<?php echo $UI . 'img/bb4.jpg'; ?>"></a> <!-- random image -->
              </li>
            </ul>
          </div>

        </div>

      </div>
      <br><br>

      <div class="section">

      </div>
    </div>
  </div>

  <!-- Footer -->
<footer class="page-footer">
  <div class="container">
    <div class="row">
      <div class="col l6 s12">
        <h5 class="white-text">OSAM System</h5>
        <p class="white-text">
        The Office of Student Affairs Management (OSAM) System is a modernization project that keeps OSA up to date with industry standards. OSA is taking advantage of the benefits of Information Technology to promote students' academic growth and personal development. [read more]</p>
      </div>
      <div class="col l4 offset-l2 s12">
        <h5 class="white-texts">For general inquiries, email contact@uplbosa.org.</h5>
        <b><p class="white-texts">Mailing Address<br></p></b>
        <p class="white-texts-p">Room 2, 2/F, Student Union Building, UPLB, Laguna, 4031<br></p>
        <b><p class="white-texts">Director's Office (DO)<br></p></b>
        <p class="white-texts-p">Room 2 536-2238 do@uplbosa.org<br></p>
        <b><p class="white-texts">Communication and Information Technology (COMMIT)<br></p></b>
        <p class="white-texts-p">Room 7 501-6761 it@uplbosa.org<br></p>
        <b><p class="white-texts">Counseling and Testing Division (CTD)<br></p></b>
        <p class="white-texts-p">Room 9 536-7255 ctd@uplbosa.org<br></p>
        <b><p class="white-texts">International Students Division (ISD)<br></p></b>
        <p class="white-texts-p">Room 12 536-7255 isd@uplbosa.org<br></p>
        <b><p class="white-texts">Scholarships and Financial Assistance Division (SFAD)<br></p></b>
        <p class="white-texts-p">Room 5 and 6 536-3209 sfad@uplbosa.org<br></p>
        <b><p class="white-texts">Student Disciplinary Tribunal (SDT)<br></p></b>
        <p class="white-texts-p">Room 14 536-7255 sdt@uplbosa.org<br></p>
        <b><p class="white-texts">Student Organizations and Activities Division (SOAD)<br></p></b>
        <p class="white-texts-p">Room 8 501-6761 soad@uplbosa.org<br></p>
      </div>
    </div>
  </div>
  <div class="footer-copyright">
    <div class="container">
      © 2016 Communication and Information Technology - Office of Student Affairs. University of the Philippines Los Baños
    </div>
  </div>
</footer>

  <script src="<?php echo $RESOURCE . 'js/jquery.min.js'; ?>"></script>
  <script src="<?php echo $RESOURCE . 'js/jquery-ui.min.js'; ?>"></script>
  <script src="<?php echo $RESOURCE . 'js/materialize.js'; ?>"></script>
  <script src="<?php echo $RESOURCE . 'js/init.js'; ?>"></script>
  
  <script src="<?php echo $RESOURCE . 'js/index.js'; ?>"></script>
  

  </body>
</html>