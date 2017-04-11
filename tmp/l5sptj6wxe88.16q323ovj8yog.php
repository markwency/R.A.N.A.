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
    <div class="nav-wrapper container row"> <a id="logo-container" href="#" class="col m1 brand-logo"><img src="<?php echo $UI . 'img/uplb-logo.png'; ?>" alt="uplblogo" style="width:100%;"> </a>
      <ul class="right hide-on-med-and-down">
        <li><a href="#">Navbar Link</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav">
        <li><a href="#">Navbar Link</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  
      <!--<h1 class="header center orange-text">Job Fair 2016 Sign up Sheet</h1>
      <!--<div class="row center">-->
  
  

<div class="container">
    <div class="section">
		<form class="row" id="studentinfo" method="post">
		Search:
		<input type="text" id="search">
		<a class="waves-effect waves-light btn" id="retrieve">Search</a>
			<ul class="collapsible" data-collapsible="accordion">
				<li>
					<div class="collapsible-header active"><i class="material-icons">filter_drama</i>Personal Information</div>
						<div class="collapsible-body">
						
						<div class="col m6">
							
							
							<p>
							
							
							
							<label>Full Name <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="If this is incorect, please visit OSA Communication and Information Technology(COMMIT).">[?]</a></label>
							<input type="text" id="fullname" readonly="readonly1">
							<label>Student Number <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="If this is incorect, please visit OSA Communication and Information Technology(COMMIT).">[?]</a></label>
							<input type="text" id="studentnumber" readonly="readonly2">
							<label>Birthday <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="If this is incorect, please visit OSA Communication and Information Technology(COMMIT).">[?]</a></label>
							<input type="date" id="birthday" readonly="readonly3">
							</p>
						</div>
							
							
						<div class="col m6">
							<p>
							<label>College <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="If this is incorect, please visit OSA Communication and Information Technology(COMMIT).">[?]</a></label>
							<input type="text" id="college" readonly="readonly4" required>
							<label>Course <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="If this is incorect, please visit OSA Communication and Information Technology(COMMIT).">[?]</a></label>
							<input type="text" id="course" readonly="readonly5" required>
							<label>Last Updated</label>
							<input type="date" id="update" readonly="readonly6" required>
							</p>
						</div>
						</div>
					
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">whatshot</i>Personal Information</div>
						<div class="collapsible-body">
						
						<div class="col m6">
							<p>
							<!--<?php $ctr=0; foreach (($inputs?:array()) as $input): $ctr++; ?>
							<label class="label" for="<?php echo $input['id']; ?>"><?php echo $input['label']; ?></label>
							<?php if ($ctr==1): ?>
								
									<input id="<?php echo $input['id']; ?>" type="text" class="job-fair-input validate" autofocus>
								
								<?php else: ?>
									<input id="<?php echo $input['id']; ?>" type="text" class="job-fair-input validate" >
								
							<?php endif; ?>

							
							<?php endforeach; ?>-->
							
							
							<label>Nick name</label>
							<input type="text" id="nickname" placeholder="John Doe" required>
							
							<label>Talent/Skills and Abilities</label>
							<input type="text" id="talent" required>
							
							<label>Scholarships</label>
							<input type="text" id="scholarship">
							
							<label>Nationality</label>
							<input type="text" id="nationality" required>
							
							</p>
							
						</div>
						
						<div class="col m6">
							<p>
							
							<label>Religion</label>
							<input type="text" id="religion" required>
							
							<label>Birthplace</label>
							<input type="text" id="birthplace" required>
							
							<label>Marital Status</label>
							<select id="maritalstatus" class="browser-default">
								<option value="" disabled selected>Choose your option</option>
								<?php foreach (($maritalstatuss?:array()) as $maritalstatus): ?>
									<option value="<?php echo $maritalstatus; ?>"><?php echo $maritalstatus; ?></option>
								<?php endforeach; ?>
							</select>
  
							<label>Biological Sex</label>
							<select id="biologicalsex" class="browser-default" required>
								<option value="" disabled selected>Choose your option</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
								
							</select>
							
							<label>Blood Type</label>
							<select id="bloodtype" class="browser-default" required>
								<option value="" disabled selected>Choose your option</option>
								<?php foreach (($bloodtypes?:array()) as $bloodtype): ?>
									<option value="<?php echo $bloodtype; ?>"><?php echo $bloodtype; ?></option>
								<?php endforeach; ?>
								
								
								
							</select>
							</p>
						</div>

						</div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">place</i>Contact Information</div>
						<div class="collapsible-body">
					  
						<div class="col m6">
							<p>
							<label>College Address</label>
							<input type="text" id="collegeaddress" placeholder="John Doe" required>
							<label>Permanent Address</label>
							<input type="text" id="permanentaddress" required>
							<label>Primary Mobile Number</label>
							<input type="text" id="primarymobilenumber" required>
							<label>LandLine Number</label>
							<input type="text" id="landlinenumber">
							<label>Contact Person</label>
							<input type="text" id="contactperson" placeholder="John Doe" required>
									
							</p>
						</div>
						<div class="col m6">
							<p>
									
							<label>E-mail Address</label>
							<input type="email" id="email" placeholder="johndoe@up.edu.ph" required>
							<label>Facebook username or ID</label>
							<input type="text" id="facebookusername">
							<label>Twitter username</label>
							<input type="text" id="twitterusername">
							<label>Mobile Device</label>
							<select id="mobiledevice" class="browser-default">
								<option value="" disabled selected>Choose your option</option>
								<?php foreach (($mobileoss?:array()) as $mobileos): ?>
									<option value="<?php echo $mobileos; ?>"><?php echo $mobileos; ?></option>
								<?php endforeach; ?>
								
							</select>
								
							<label>Region</label>
							<select id="region" class="browser-default" required>
								<option value="" disabled selected>Choose your option</option>
								<?php foreach (($regions?:array()) as $region): ?>
									<option value="<?php echo $region; ?>"><?php echo $region; ?></option>
								<?php endforeach; ?>
							</select>
							</p>
						</div>
						</div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">whatshot</i>Family Information</div>
						<div class="collapsible-body">
						<div class="col m6">
								
							<p>
							<label>Mother's Name</label>
							<input type="text" id="mothersname" placeholder="John Doe" required>
							
							<label>Mother's Education</label>
							<select id="motherseducation" class="browser-default" required>
								<option value="" disabled selected>Choose your option</option>
								<?php foreach (($educations?:array()) as $education): ?>
									<option value="<?php echo $education; ?>"><?php echo $education; ?></option>
								<?php endforeach; ?>
								
								
								
								
							</select>
							<label>Mother's Work</label>
							<input type="text" id="motherswork" required>
							<label>Mother's Birthday</label>
							<input type="date" class="datepicker" id="mothersbirthday" required>
							</p>	
						</div>
						<div class="col m6">
							<p>	
									
							<label>Father's Name</label>
							<input type="text" id="fathersname" placeholder="John Doe" required>
							
							<label>Father's Education</label>
							<select id="motherseducation" class="browser-default" required>
								<option value="" disabled selected>Choose your option</option>
								<?php foreach (($educations?:array()) as $education): ?>
									<option value="<?php echo $education; ?>"><?php echo $education; ?></option>
								<?php endforeach; ?>
							</select>
							<label>Father's Work</label>
							<input type="text" id="fatherswork" required>
							<label>Father's Birthday</label>
							<input type="date" class="datepicker" id="fathersbirthday" required>
									
							</p>
						</div>
						</div>
				</li>
				<li>
					<div class="collapsible-header"><i class="material-icons">filter_drama</i>Additional Information</div>
						<div class="collapsible-body">
						<div class="col m6">
							<p>
								
							<label>Previous College</label>
							<input type="text" id="previouscollege">
							<label>Previous Elementary</label>
							<input type="text" id="previouselementary" required>
							<label>Previous Highschool</label>
							<input type="text" id="previoushighschool" required>
							</p>
						</div>
							
							
						<div class="col m6">
							<p>
							<!--<label>I am an international student</label>
							<a class="waves-effect waves-light btn" id="internationalstudent">Yes</a><br>
							<label>I am currently employed</label>
							<a class="waves-effect waves-light btn" id="currentlyemployed">Yes</a>-->
							<label>I am an international student</label><br>
							<input type="button" onclick="toggleis();"/></a><br>
							<label id="lpn" style="display: none">Passport Number</label>
							<input id="passportnumber" type="text" style="display: none"/>
							<label id="ltov" style="display: none">Type of Visa</label>
							<select id="typeofvisa" class="browser-default" style="display: none"/>
								<option value="" disabled selected>Choose your option</option>
								<?php foreach (($visas?:array()) as $visa): ?>
									<option value="<?php echo $visa; ?>"><?php echo $visa; ?></option>
								<?php endforeach; ?>
							</select><br>
							
							<label>I am currently employed</label><br>
							<input type="button" onclick="togglece();"/></a><br>
							<label  id="le" style="display: none">Employer</label>
							<input id="employer" type="text" style="display: none"/>
							<label id="ljt" style="display: none">Job Title</label>
							<input id="jobtitle" type="text" style="display: none"/><br>
							
							</p>
						</div>
						</div>
					
				</li>
					
					
			</ul>
		
		
		<a class="waves-effect waves-light btn" id="submit"><i class="material-icons left">done</i>submit</a>
		
		</form>
		
	
	</div>
</div>
	
	
	
  <footer class="page-footer red">
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
            <li><a class="white-text" href="https://www.facebook.com/uplbosa/">Facebook</a></li>
            <li><a class="white-text" href="https://twitter.com/uplbosa">Twitter</a></li>
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
  <script src="<?php echo $UI . 'js/toggle.js'; ?>"></script>

  </body>
</html>

