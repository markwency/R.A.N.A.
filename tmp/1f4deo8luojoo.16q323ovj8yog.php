<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>Job Fair Sign up Sheet 2016</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="<?php echo $UI . 'css/materialize.css'; ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo $UI . 'css/style.css'; ?>"type="text/css" rel="stylesheet" media="screen,projection"/>
  
  
 
</head>
<body>
  <nav class="light-blue lighten-1" role="navigation">
    <div class="nav-wrapper container row"> <a id="logo-container" href="#" class="col m1 brand-logo"><img src="uplb-logo.png" alt="uplblogo" style="width:100%;"> </a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">Navbar Link</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="#">Navbar Link</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  <div class="section no-pad-bot" id="index-banner">
    <div class="container">
      <br><br>
      <h1 class="header center orange-text">Job Fair 2016 Sign up Sheet</h1>
      <!--<div class="row center">
        <h5 class="header col s12 light">A modern responsive front-end framework based on Material Design</h5>
      </div>
      <div class="row center">
        <a href="http://materializecss.com/getting-started.html" id="download-button" class="btn-large waves-effect waves-light orange">Get Started</a>
      </div>-->
      <br><br>

    </div>
  </div>


  <div class="container">
    <div class="section">

      <!--   Icon Section   -->
      <div class="row">
        <div class="col s12 m4">
          <div class="icon-block">
            
				
				
			
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">
				<form class="col s12" id="job-fair-form">
      <p class="col m12">
        Please fill out the fields below.
      </p>
      <div class="row">


        <?php $ctr=0; foreach (($inputs?:array()) as $input): $ctr++; ?>

          <div class="input-field col s12">

            <?php if ($ctr==1): ?>
                
                    <input id="<?php echo $input['id']; ?>" type="text" class="job-fair-input validate" autofocus>
                
                <?php else: ?>
                    <input id="<?php echo $input['id']; ?>" type="text" class="job-fair-input validate" >
                
            <?php endif; ?>

            <label class="label" for="<?php echo $input['id']; ?>"><?php echo $input['label']; ?></label>
          </div>

        <?php endforeach; ?>





        <div class="input-field col s12">
          <a class="waves-effect waves-light btn" id="submit"><i class="material-icons left">done</i>submit</a>
        </div>
      </div>
      
    </form>
          </div>
        </div>

        <div class="col s12 m4">
          <div class="icon-block">

				
			
          </div>
        </div>
      </div>

    </div>
    <br><br>

    <div class="section">

    </div>
  </div>

  <footer class="page-footer orange">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">Bio</h5>
          <p class="grey-text text-lighten-4">Sign up sheet for the upcoming jop fair.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
          <ul>
            <li><a class="white-text" href="#!">Help</a></li>
            <li><a class="white-text" href="#!"></a></li>
            <li><a class="white-text" href="#!"></a></li>
            <li><a class="white-text" href="#!"></a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Connect</h5>
          <ul>
            <li><a class="white-text" href="#!">Facebook</a></li>
            <li><a class="white-text" href="#!">Twitter</a></li>
            <li><a class="white-text" href="#!"></a></li>
            <li><a class="white-text" href="#!"></a></li>
          </ul>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
      Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
      </div>
    </div>
  </footer>


  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  
  
  <!--  Scripts-->
  <script src="<?php echo $UI . 'js/jquery.min.js'; ?>"></script>
  <script src="<?php echo $UI . 'js/jquery-ui.min.js'; ?>"></script>
  <script src="<?php echo $UI . 'js/materialize.js'; ?>"></script>
  <script src="<?php echo $UI . 'js/init.js'; ?>"></script>

  <!-- scripts -->
 
  <script src="<?php echo $UI . 'js/jobfair.js'; ?>"></script>

  </body>
</html>

