<br>
<br>
<br>

<?php if (isset($SESSION['adminlogin'])): ?>
  
	<h5 class="header col s12 center" style="margin-top: 3%;"><u>Pending for Approval:</u></h5>
  	<div class="row imglist" id="imagesList" style="margin-top: 3%;">
  	</div>
  
  <?php else: ?>
  	<?php if (isset($SESSION['googleid'])): ?>
      
        <div class="container" style="margin-top: 5%;">
		    <div class="section">
				<h3 class="center upmaroon quicksand"> You are accessing a restricted page.</h3>	
			</div>
		</div>
      
      <?php else: ?>
      	<div class="container" style="margin-top: 3%;">
		    <div class="section">
					<ul class="collapsible" data-collapsible="accordion">
						<li>
							<div id="personalinfo" class="collapsible-header active"><i class="material-icons">warning</i>Admin Login</div>
								<div class="collapsible-body">
								<form class="col s12" style="width:40%; margin-left:30%; margin-top: 2%;">
								  <div class="row">
								      <div class="input-field col s12">
								          <input id="username2" type="text" class="validate" tabindex="1">
								          <label for="username2">Username</label>
								      </div>
								  </div>
								  <div class="row">
								      <div class="input-field col s12">
								          <input id="password2" type="password" class="validate" tabindex="2">
								          <label for="password2">Password</label>
								      </div>
								  </div>
								  <div class="row">
								      <div class="col m12">
								          <p class="center-align">
								              <button id="loginbutton2" class="loginbtn2 btn btn-large" type="button" name="action">Login</button>
								          </p>
								      </div>
								  </div>
								</form> 
								</div>
							
						</li>					
					</ul>						
			</div>
		</div>      
      
    <?php endif; ?>              
  
<?php endif; ?>

<input type="hidden" value="<?php echo $SESSION['pendingid']; ?>" id="pendingid">

<script src="<?php echo $RESOURCE . 'js/jquery.min.js'; ?>"></script>
<script src="<?php echo $RESOURCE . 'js/jquery-ui.min.js'; ?>"></script>
<script src="<?php echo $RESOURCE . 'js/materialize.js'; ?>"></script>
<script src="<?php echo $RESOURCE . 'js/init.js'; ?>"></script>

<script src="<?php echo $RESOURCE . 'js/admin.js'; ?>"></script>