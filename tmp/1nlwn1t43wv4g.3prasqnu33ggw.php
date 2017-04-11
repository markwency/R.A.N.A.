<div class="container" style="margin-top: 5%;">
    <div class="section">
		<form class="row" id="studentinfo" method="post">
			<ul class="collapsible" data-collapsible="accordion">
				<li>
					<div id="personalinfo" class="collapsible-header active"><i class="material-icons">perm_identity</i>Personal Information</div>
						<div class="collapsible-body">
						<div class="col m6">
							<p>
							<label>Full Name <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="If this is incorect, please visit OSA Communication and Information Technology(COMMIT).">[?]</a></label>
							<input type="text" id="fullname" readonly="readonly1">
							<label>Student Number <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="If this is incorect, please visit OSA Communication and Information Technology(COMMIT).">[?]</a></label>
							<input type="text" id="studnum" readonly="readonly1">
							<label>Birthday <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="If this is incorect, please visit OSA Communication and Information Technology(COMMIT).">[?]</a></label>
							<input type="date" id="bday" readonly="readonly1">
							</p>
						</div>
							
							
						<div class="col m6">
							<p>
							<label>College <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="If this is incorect, please visit OSA Communication and Information Technology(COMMIT).">[?]</a></label>
							<input type="text" id="college" readonly="readonly1">
							<label>Course <a class="tooltipped" data-position="top" data-delay="50" data-tooltip="If this is incorect, please visit OSA Communication and Information Technology(COMMIT).">[?]</a></label>
							<input type="text" id="course" readonly="readonly1">
							<label>Last Updated</label>
							<input type="datetime" id="lastupdated" readonly="readonly1">
							</p>
						</div>
						</div>
					
				</li>					
			</ul>				
		</form>			
	</div>
</div>

<div class="container" style="top: 20px;">
    <div class="section">
		<form class="row" id="studentinfo" method="post">
			<ul class="collapsible" data-collapsible="accordion">
				<li>
					<div class="collapsible-header active" id="1"><i class="material-icons">perm_identity</i>Account Information</div>
						<div class="collapsible-body">

							<div class="col m6">
								<p>
								<label>Username</label>
								<input type="text" id="uname" onblur="usernamechecker()" tabindex="1">
								<label>Last Accessed</label>
								<input type="datetime" id="lastaccessed" readonly="readonly1" tabindex="2">
								</p>
							</div>

							<div id="olduserpassword"class="col m6" style="display:none;">
								<p>
								<label>Password</label>
								<br><br>
								<input type="checkbox" class="filled-in" id="passwordcheck"/ tabindex="3">
							    <label for="passwordcheck">I want to change my password</label>
								<br>
								<br>
								<label id="oldpasswordlabel" style="display: none">Old Password</label>
								<input type="password" id="oldpassword" onblur="checkpassword()" style="display:none;" tabindex="4">
								<label id="newpasswordlabel" style="display: none">New Password</label>
								<input type="password" id="password" onblur="enableconfirmpassword()" readonly="readonly1" style="pointer-events: none; display:none;" tabindex="5">
								<label id="newpasswordconfirmlabel" style="display: none">Confirm New Password</label>
								<input type="password" id="confirmpassword" onblur="passwordchecker()" readonly="readonly1" style="pointer-events: none; display:none;" tabindex="6"> 
								</p>
							</div>
							<div id="newuserpassword" class="col m6" style="display:none;">
								<p>
								<label>Password</label>
								<input type="password" id="password2" onblur="enableconfirmpassword2()" tabindex="3">
								<label>Confirm Password</label>
								<input type="password" id="confirmpassword2" onblur="passwordchecker2()" readonly="readonly1" style="pointer-events: none;" tabindex="4">
								</p>
							</div>
									
						</div>
				</li>
				<li>
					<div class="collapsible-header" id="2" tabindex="7"><i class="material-icons">person_pin</i>Personal Information</div>
						<div class="collapsible-body">
						
						<div class="col m6">
							<p>
							
							<label>Nick name</label>
							<input type="text" id="nickname" placeholder="John Doe" tabindex="8">
							
							<label>Talent/Skills and Abilities</label>
							<input type="text" id="talent" tabindex="9">
							
							<label>Scholarships</label>
							<input type="text" id="scholarship" tabindex="10">
							
							<label>Nationality</label>
							<input type="text" id="nationality" tabindex="11">
							
							</p>
							
						</div>
						
						<div class="col m6">
							<p>
							
							<label>Religion</label>
							<input type="text" id="religion" tabindex="12">
							
							<label>Birthplace</label>
							<input type="text" id="birthplace" tabindex="13">
							
							<label>Marital Status</label>
							<select id="maritalstatus" class="browser-default" tabindex="14">
								<option value="" disabled selected>Choose your option</option>
								<?php foreach (($maritalstatuss?:array()) as $maritalstatus): ?>
									<option value="<?php echo $maritalstatus; ?>"><?php echo $maritalstatus; ?></option>
								<?php endforeach; ?>
							</select>
  
							<label>Biological Sex</label>
							<select id="biologicalsex" class="browser-default" tabindex="15">
								<option value="" disabled selected>Choose your option</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
								
							</select>
							
							<label>Blood Type</label>
							<select id="bloodtype" class="browser-default" tabindex="16">
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
					<div class="collapsible-header" id="3" tabindex="17"><i class="material-icons">contact_phone</i>Contact Information</div>
						<div class="collapsible-body">
					  
						<div class="col m6">
							<p>
							<label>College Address</label>
							<input type="text" id="collegeaddress" tabindex="18">
							<label>Permanent Address</label>
							<input type="text" id="permanentaddress" tabindex="19">
							<label>Primary Mobile Number</label>
							<input type="text" id="mobilenumber" tabindex="20">
							<label>LandLine Number</label>
							<input type="text" id="landlinenumber" tabindex="21">
							<label>Contact Person</label>
							<input type="text" id="contactperson" placeholder="John Doe" tabindex="22">
							<label>Contact Person Mobile Number</label>
							<input type="text" id="contactpersonmobilenumber" tabindex="23">
									
							</p>
						</div>
						<div class="col m6">
							
							<br>		
							<label>E-mail Address</label>
							<input type="email" id="emailaddress" placeholder="johndoe@up.edu.ph" tabindex="24">
							<div class="section">
								<label>Facebook username or ID</label>
								<div id="fbloader" class="preloader-wrapper small active" style="margin-left: 20px; display:none;">
								<div class="spinner-layer">
									<div class="circle-clipper left">
										<div class="circle"></div>
									</div><div class="gap-patch">
									<div class="circle"></div>
									</div><div class="circle-clipper right">
									<div class="circle"></div>
									 </div>
									</div>
								</div>
							</div>
							<input type="text" id="facebook" onchange="verifyfacebook()" tabindex="25">
							<label>Twitter username</label>
							<input type="text" id="twitter" tabindex="26">
							<label>Mobile Device</label>
							<select id="mobiledevice" class="browser-default" tabindex="27">
								<option value="" disabled selected>Choose your option</option>
								<?php foreach (($mobileoss?:array()) as $mobileos): ?>
									<option value="<?php echo $mobileos; ?>"><?php echo $mobileos; ?></option>
								<?php endforeach; ?>
								
							</select>
								
							<label>Region</label>
							<select id="region" class="browser-default" tabindex="28">
								<option value="" disabled selected>Choose your option</option>
								<?php foreach (($regions?:array()) as $region): ?>
									<option value="<?php echo $region; ?>"><?php echo $region; ?></option>
								<?php endforeach; ?>
							</select>

						</div>
						</div>
				</li>
				<li>
					<div class="collapsible-header" id="4" tabindex="28"><i class="material-icons">supervisor_account</i>Family Information</div>
						<div class="collapsible-body">
						<div class="col m6">
								
							<p>
							<label>Mother's Name</label>
							<input type="text" id="mothername" placeholder="John Doe" tabindex="29">
							
							<label>Mother's Education</label>
							<select id="mothereducation" class="browser-default" tabindex="30">
								<option value="" disabled selected>Choose your option</option>
								<?php foreach (($educations?:array()) as $education): ?>
									<option value="<?php echo $education; ?>"><?php echo $education; ?></option>
								<?php endforeach; ?>
								
								
								
								
							</select>
							<label>Mother's Work</label>
							<input type="text" id="motherwork" tabindex="31">
							<label>Mother's Birthday</label>
							<input type="date" class="datepicker" id="motherbday" tabindex="32">
							</p>	
						</div>
						<div class="col m6">
							<p>	
									
							<label>Father's Name</label>
							<input type="text" id="fathername" placeholder="John Doe" tabindex="33">
							
							<label>Father's Education</label>
							<select id="fathereducation" class="browser-default" tabindex="34">
								<option value="" disabled selected>Choose your option</option>
								<?php foreach (($educations?:array()) as $education): ?>
									<option value="<?php echo $education; ?>"><?php echo $education; ?></option>
								<?php endforeach; ?>
							</select>
							<label>Father's Work</label>
							<input type="text" id="fatherwork" tabindex="35">
							<label>Father's Birthday</label>
							<input type="date" class="datepicker" id="fatherbday" tabindex="36">

							<label>Number of Siblings</label>
							<input type="text" id="no_siblings" tabindex="37">
									
							</p>
						</div>
						</div>
				</li>
				<li>
					<div class="collapsible-header" id="5"  tabindex="38"><i class="material-icons">note_add</i>Additional Information</div>
						<div class="collapsible-body">
						<div class="col m6">
							<p>
								
							<label>Previous College</label>
							<input type="text" id="previouscollege" tabindex="39">
							<label>Previous Elementary</label>
							<input type="text" id="previouselementary" tabindex="40">
							<label>Previous Highschool</label>
							<input type="text" id="previoushighschool" tabindex="41">
							</p>
						</div>
							
							
						<div class="col m6">
						    <br><br>
						    <input type="checkbox" class="filled-in" id="visacheck"/ tabindex="42">
						    <label for="visacheck">I am an international student</label>
							<br>
							<label id="lpn" style="display: none">Passport Number</label>
							<input id="passportnumber" type="text" style="display: none"/ tabindex="43">
							<label id="ltov" style="display: none">Type of Visa</label>
							<select id="visa" class="browser-default" style="display: none"/ tabindex="44">
								<option value="" disabled selected>Choose your option</option>
								<?php foreach (($visas?:array()) as $visa): ?>
									<option value="<?php echo $visa; ?>"><?php echo $visa; ?></option>
								<?php endforeach; ?>
							</select><br>
							
							<input type="checkbox" class="filled-in" id="employcheck"/ tabindex="45">
						    <label for="employcheck">I am currently employed</label>
						    <br>
							<label  id="le" style="display: none">Employer</label>
							<input id="employer" type="text" style="display: none"/ tabindex="46">
							<label id="ljt" style="display: none">Job Title</label>
							<input id="jobtitle" type="text" style="display: none"/ tabindex="47"><br>
							
							</p>
						</div>
						</div>
					
				</li>
					
					
			</ul>
		
		
		<a class="btn" id="submit" tabindex="48"><i class="material-icons left">done</i>submit</a>
		
		</form>
		
	
	</div>
</div>

<input type="hidden" value="<?php echo $SESSION['googleid']; ?>" id="google-id">

<script src="<?php echo $RESOURCE . 'js/form.js'; ?>"></script>
<script src="<?php echo $RESOURCE . 'js/toggle.js'; ?>"></script>