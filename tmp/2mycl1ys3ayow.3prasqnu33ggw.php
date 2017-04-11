<div class="container" style="margin-top: 100px;">
    <div class="section">
		<form class="row" id="studentinfo" method="post">
			<ul class="collapsible" data-collapsible="accordion">
				<li>
					<div id="personalinfo" class="collapsible-header active"><i class="material-icons">face</i>Personal Information</div>
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
					<div class="collapsible-header active" id="1" tabindex="1"><i class="material-icons">perm_identity</i>Account Information</div>
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
								<input type="password" id="newpassword" onblur="enableconfirmpassword()" readonly="readonly1" style="pointer-events: none; display:none;" tabindex="5">
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
		</form>
				<li>
					<div class="collapsible-header" id="6"  tabindex="48"><i class="material-icons">file_upload</i>Upload Photo</div>
						<div class="collapsible-body">
						<div class="col m4 offset-m1" style="margin-top: 80px; margin-bottom: 30px;">
							<div class="center">
								<?php if (isset($SESSION['profilepicture'])): ?>
		                          
		                            <label for="profile-pic-input"><img id="profpicture1"style="height:200px; width:200px;" src="<?php echo $SESSION['profilepicture']; ?>"></label>
		                          
		                          <?php else: ?>
		                            <label for="profile-pic-input"><img id="profpicture1" style="height:200px; width:200px;" src="<?php echo $UI . 'img/placeholder.png'; ?>"></label>            
		                          
		                        <?php endif; ?> 
		                    </div>
		                    <div class="center">
								<form id="pic-form" method="post" enctype="multipart/form-data">
								  <input type="file" name="profile-pic-input" id="profile-pic-input" accept="image/jpeg" tabindex="49" style="border:1px solid black;">
								  <input type="text" name="profile-id" id="profile-id" value="<?php echo $SESSION['googleid']; ?>" style="display:none;">
								  <input type="text" name="message" id="message" value="" readonly="readonly1">
								</form>
							</div>
						</div>

						<div class="col m7" style="margin-bottom: 30px;">
							<h3 class="center">Photo Guidelines</h3>
							<ul>
								<h5 class="center">These are the photo specifications for the OSAM profile:</h5>
						<br>

							<li>1. Photo must be square and must be at least 200x200 pixels.</li></a>
							<li>2. There should be no picbadges, twibbons, logos, or any other unnecessary elements.</li>
							<li>3. There should be no eyeglasses or any accessories that may cover facial features.</li>
							<li>4. There should only be one person in the photo.</li>
							<li>5. The background of the photo must be plain (light solid color).</li>
							<li>6. Photo must not be blurred.</li>
							<li>7. Photo must be in standard close-up shot (shoulder level up to tip of hair).</li>
							<li>8. Photo must be colored.</li>
							<li>9. Face must be recognizable. It must not be too dark or too bright.</li>
							<li>10. Face must comprise about 70% of the photo.</li>
							<li>11. The person must be directly facing the camera in normal angle.</li>
							<li>12. Shoulders and head must not be tilted.</li>
							<li>13. Photo must not be improperly cropped nor stretched.</li>
							<li>14. Photo must not have photo effects (borders/sepia tone/glittering effect).</li>
							<li>15. Photo must be recent (taken within the last six months).</li>

						<br>
							<li style="text-indent: 35px">If you are not sure if your photo meets the guidelines, ensure that you can classify your photo as formal. The OSAM System is not a social networking site, it is a university facility that allows students to upload photos instead of submitting 1x1 or 2x2 photos.</li>
							<br>
				            <li style="text-indent: 35px">You might be interested to read <a class="upmaroon" href="http://it.uplbosa.org/2014/10/17-types-of-photos-you-shouldnt-upload.html">17 types of photos you shouldn't upload</a> based on photos uploaded by UPLB students.</li>
				            </ul>
						</div>

						</div>
					
				</li>
					
					
			</ul>
		
		
		<a class="btn" id="submitformbutton" tabindex="48"><i class="material-icons left">done</i>submit</a>
		
	
	</div>
</div>

<input type="hidden" value="<?php echo $SESSION['googleid']; ?>" id="google-id">


<script src="<?php echo $RESOURCE . 'js/jquery.min.js'; ?>"></script>
<script src="<?php echo $RESOURCE . 'js/jquery-ui.min.js'; ?>"></script>
<script src="<?php echo $RESOURCE . 'js/materialize.js'; ?>"></script>
<script src="<?php echo $RESOURCE . 'js/init.js'; ?>"></script>

<script src="<?php echo $RESOURCE . 'js/uplbosa.js'; ?>"></script>
<script src="<?php echo $RESOURCE . 'js/form.js'; ?>"></script>