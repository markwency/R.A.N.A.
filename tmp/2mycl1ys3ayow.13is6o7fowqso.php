<br>
<br>
<br>

<?php if (isset($SESSION['adminlogin'])): ?>
  
  	<?php if (isset($SESSION['pendingid'])): ?>
	  
	  	<div class="row" style="padding-top: 3%;">
	        
	  		<div style="margin-left:50px;">
			  	<!-- <a href="#" id="goback" class="black-text valign-wrapper"><i class="material-icons">keyboard_backspace</i><h5 style="margin-left:10px;">Back</h5></a> -->
			  	<a href="#" id="goback" class="btn"><i class="material-icons left">keyboard_backspace</i>Back</a>
		  	</div>

	        <div class="picture col s12 m2 offset-m4" style="padding-top: 20px; position: relative;">
	       		<div class="row">
	       			<img class="displaypicture" src="<?php echo $SESSION['pendingpicture']; ?>" style="width:200px; height:200px;"/>
	        	</div>
	        </div>

	        <div class="col s12 m4" style="padding-top: 3%; position: relative;">
	        	<h5>Name: <?php echo $SESSION['pendingname']; ?></h5>
	        	<button id="approve" class="loginbtn2 btn btn-large" type="button" name="action">Approve</button>
	  			<button id="reject" class="loginbtn2 btn btn-large" type="button" name="action">Reject</button>
	            <div class="row">
					<div id="checkboxes" class="input-field col s12" style="display:none;">
						<label>Reason/s for rejecting:</label>
						<br><br>
						<input type="checkbox" class="filled-in" id="Photo must be square and must be at least 200x200 pixels."/>
						<label for="Photo must be square and must be at least 200x200 pixels.">Photo must be square and must be at least 200x200 pixels.</label>
						<input type="checkbox" class="filled-in" id="There should be no picbadges, twibbons, logos, or any other unnecessary elements."/>
						<label for="There should be no picbadges, twibbons, logos, or any other unnecessary elements.">There should be no picbadges, twibbons, logos, or any other unnecessary elements."</label>
						<input type="checkbox" class="filled-in" id="There should be no eyeglasses or any accessories that may cover facial features."/>
						<label for="There should be no eyeglasses or any accessories that may cover facial features.">There should be no eyeglasses or any accessories that may cover facial features.</label>
						<input type="checkbox" class="filled-in" id="There should only be one person in the photo."/>
						<label for="There should only be one person in the photo.">There should only be one person in the photo.</label>
						<input type="checkbox" class="filled-in" id="The background of the photo must be plain (light solid color)."/>
						<label for="The background of the photo must be plain (light solid color).">The background of the photo must be plain (light solid color).</label>
						<input type="checkbox" class="filled-in" id="Photo must not be blurred."/>
						<label for="Photo must not be blurred.">Photo must not be blurred.</label>
						<input type="checkbox" class="filled-in" id="Photo must be in standard close-up shot (shoulder level up to tip of hair)."/>
						<label for="Photo must be in standard close-up shot (shoulder level up to tip of hair).">Photo must be in standard close-up shot (shoulder level up to tip of hair).</label>
						<input type="checkbox" class="filled-in" id="Photo must be colored."/>
						<label for="Photo must be colored.">Photo must be colored.</label>
						<input type="checkbox" class="filled-in" id="Face must be recognizable. It must not be too dark or too bright."/>
						<label for="Face must be recognizable. It must not be too dark or too bright.">Face must be recognizable. It must not be too dark or too bright.</label>
						<input type="checkbox" class="filled-in" id="Face must comprise about 70% of the photo."/>
						<label for="Face must comprise about 70% of the photo.">Face must comprise about 70% of the photo.</label>
						<input type="checkbox" class="filled-in" id="The person must be directly facing the camera in normal angle."/>
						<label for="The person must be directly facing the camera in normal angle.">The person must be directly facing the camera in normal angle.</label>
						<input type="checkbox" class="filled-in" id="Shoulders and head must not be tilted."/>
						<label for="Shoulders and head must not be tilted.">Shoulders and head must not be tilted.</label>
						<input type="checkbox" class="filled-in" id="Photo must not be improperly cropped nor stretched."/>
						<label for="Photo must not be improperly cropped nor stretched.">Photo must not be improperly cropped nor stretched.</label>
						<input type="checkbox" class="filled-in" id="Photo must not have photo effects (borders/sepia tone/glittering effect)."/>
						<label for="Photo must not have photo effects (borders/sepia tone/glittering effect).">Photo must not have photo effects (borders/sepia tone/glittering effect).</label>
						<input type="checkbox" class="filled-in" id="Photo must be recent (taken within the last six months)."/>
						<label for="Photo must be recent (taken within the last six months).">Photo must be recent (taken within the last six months).</label>

					</div>
				</div>
				<div id="message" class="row" style="display:none;">
					<div class="input-field col s12">
						<textarea id="textarea1" class="materialize-textarea"></textarea>
						<label for="textarea1">Custom Message</label>
					</div>
				</div>
				<div id="submitbtn" class="row" style="display:none;">
					<div class="col m12">
						<p class="center-align">
				  			<button id="submitbutton" class="loginbtn2 btn btn-large" type="button" name="action">Submit</button>
						</p>
					</div>
				</div>
	        </div>
	    </div>
	    <h5 id="rejectedheader" class="header col s12 center" style="margin-top: 3%; display:none;">Previously rejected pictures:</h5>
	    <div class="row" style="padding-top: 2%;">
	    	<div class="row imglist" id="rejectedList">
  			</div>
	    </div>

	  
	  <?php else: ?>
		<div class="container" style="margin-top: 5%;">
		    <div class="section">
				<h3 class="center upmaroon quicksand"> You are accessing a restricted page.</h3>	
			</div>
		</div>            
	  
	<?php endif; ?>
  
  <?php else: ?>
	<div class="container" style="margin-top: 5%;">
	    <div class="section">
			<h3 class="center upmaroon quicksand"> You are accessing a restricted page.</h3>	
		</div>
	</div>             
  
<?php endif; ?>

<input type="hidden" value="<?php echo $SESSION['pendingid']; ?>" id="pendingid">

<script src="<?php echo $RESOURCE . 'js/jquery.min.js'; ?>"></script>
<script src="<?php echo $RESOURCE . 'js/jquery-ui.min.js'; ?>"></script>
<script src="<?php echo $RESOURCE . 'js/materialize.js'; ?>"></script>
<script src="<?php echo $RESOURCE . 'js/init.js'; ?>"></script>

<script src="<?php echo $RESOURCE . 'js/admin.js'; ?>"></script>