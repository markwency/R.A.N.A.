var originalusername;
var valid = 1;
var newuser = 0;
var correctoldpassword = 0;
var passwordvalid = 1;
var facebookvalid = 1;

$('#submitformbutton').click(function(){

	var namePattern = /^[A-Za-z\-\.]+\s+([A-Za-z\-\.]+\s*)+$/;
	var telephonePattern = /^[0-9]{7}$/;
	var mobilePattern = /^09[0-9]{9}$/;
	var mobilePattern2 = /^\+63[0-9]{10}$/;
	//var studentnumberPattern = /^[0-9]{4}\-[0-9]{5}$/;
	var emailPattern = /^[0-9A-Za-z\-._]+\@[0-9A-Za-z\-._]+$/;
	var siblingsPattern = /^([0-9]|[1-9][0-9]|100)$/;
	
	var errors = 0;
	
	if(!namePattern.test($('#mothername').val().trim()) || !namePattern.test($('#fathername').val().trim())){
		Materialize.toast('Please Enter Your Parents Complete Name.', 3000);
		errors++;
	}

	if(!siblingsPattern.test($('#no_siblings').val().trim())){
		Materialize.toast('Please enter a valid number of siblings.', 3000);
		errors++;
	}

	if(!telephonePattern.test($('#landlinenumber').val().trim())){
		Materialize.toast('Invalid Telephone number.', 3000);
		errors++;
	}

	if(!mobilePattern.test($('#mobilenumber').val().trim()) && !mobilePattern2.test($('#mobilenumber').val().trim())){
		Materialize.toast('Invalid Mobile number.', 3000);
		errors++;
	}
	
	if(!mobilePattern.test($('#contactpersonmobilenumber').val().trim()) && !mobilePattern2.test($('#contactpersonmobilenumber').val().trim())){
		Materialize.toast('Invalid Contact Person Mobile number.', 3000);
		errors++;
	}

	if(!emailPattern.test($('#emailaddress').val().trim())){
		Materialize.toast('Invalid email address.', 3000);
		errors++;
	}
	
	if(!namePattern.test($('#contactperson').val().trim())){
		Materialize.toast('Please enter your Contact Persons Complete Name.', 3000);
		errors++;	
	}
	
	if($('#nickname').val() == '' || $('#maritalstatus').val() == '' || 
	$('#birthplace').val() == '' || $('#religion').val() == '' || 
	$('#nationality').val() == '' || $('#talent').val() == '' || 
	$('#bloodtype').val() == '' || $('#collegeaddress').val() == '' || 
	$('#permanentaddress').val() == '' || $('#region').val() == '' || 
	$('#mobilenumber').val() == '' || $('#emailaddress').val() == '' || 
	$('#contactperson').val() == '' || $('#fathername').val() == '' ||
	$('#fathereducation').val() == '' || $('#fatherwork').val() == '' ||
	$('#fatherbday').val() == '' || $('#mothername').val() == '' ||
	$('#mothereducation').val() == '' || $('#motherwork').val() == '' ||
	$('#motherbday').val() == '' || $('#previouselementary').val() == '' ||
	$('#previoushighschool').val() == ''
	){
		Materialize.toast('Fill Required Fields.', 3000);	
		errors++;	
	}
	
	if(newuser == 1){
		if($('#uname').val() == ''){	
			Materialize.toast('Please provide a username.', 3000);	
			errors++;
		}
		if($('#password2').val() == ''){	
			Materialize.toast('Please provide a password.', 3000);	
			errors++;
		}
	}else{
		if($('#uname').val() == ''){	
			Materialize.toast('Please provide a username.', 3000);	
			errors++;
		}
		if((!$('#oldpassword').val() == '') && $('#newpassword').val() == '' && correctoldpassword == 1){	
			Materialize.toast('Please provide a password.', 3000);	
			errors++;
		}
		if((!$('#oldpassword').val() == '') && correctoldpassword == 0){
			Materialize.toast('Please provide a correct old password.', 3000);	
			errors++;
		}
	}

	if(errors==0){

		if(valid == 1 && facebookvalid == 1 && passwordvalid == 1){

			$.ajax({
		      type: 'POST',
		      url: 'clearimg',
			});

				var isinternational = 0;
				var isemployed = 0;

				if (document.getElementById('visacheck').checked && (!$('#passportnumber').val() == '') && (!$('#visa').val() == '')){
					isinternational = 1;
				}

				if (document.getElementById('employcheck').checked && (!$('#employer').val() == '') && (!$('#jobtitle').val() == '')){
					isemployed = 1;
				}

				if(newuser == 0){
					if (document.getElementById('passwordcheck').checked) {
						$topass =  $('#newpassword').val();
			        } else {
			            $topass = null;
			        }
			    }else{
			    	$topass = $('#password2').val();
			    }
					

				$.ajax({
			        type: 'POST',
			        url: 'submit',
			        data: {
			        	'id': $('#google-id').val(),

						'username': $('#uname').val(),
						'password': $topass,

						'nickname': $('#nickname').val(),
						'talent': $('#talent').val(),
						'scholarship': $('#scholarship').val(),
						'nationality': $('#nationality').val(),
						'religion': $('#religion').val(),
						'birthplace': $('#birthplace').val(),
						'maritalstatus': $('#maritalstatus').val(),
						'biologicalsex': $('#biologicalsex').val(),
						'bloodtype': $('#bloodtype').val(),
						'collegeaddress': $('#collegeaddress').val(),
						'permanentaddress': $('#permanentaddress').val(),
						'mobilenumber': $('#mobilenumber').val(),
						'landlinenumber': $('#landlinenumber').val(),
						'contactperson': $('#contactperson').val(),
						'contactpersonmobilenumber': $('#contactpersonmobilenumber').val(),
						'emailaddress': $('#emailaddress').val(),
						'facebook': $('#facebook').val(),
						'twitter': $('#twitter').val(),
						'mobiledevice': $('#mobiledevice').val(),
						'region': $('#region').val(),
						'mothername': $('#mothername').val(),
						'mothereducation': $('#mothereducation').val(),
						'motherwork': $('#motherwork').val(),
						'motherbday': $('#motherbday').val(),
						'fathername': $('#fathername').val(),
						'fathereducation': $('#fathereducation').val(),
						'fatherwork': $('#fatherwork').val(),
						'fatherbday': $('#fatherbday').val(),
						'no_siblings': $('#no_siblings').val(),
						'previouscollege': $('#previouscollege').val(),
						'previouselementary': $('#previouselementary').val(),
						'previoushighschool': $('#previoushighschool').val(),
						'isinternational': isinternational,
						'passportnumber': $('#passportnumber').val(),
						'isemployed': isemployed,
						'visa': $('#visa').val(),
						'employer': $('#employer').val(),
						'jobtitle': $('#jobtitle').val()
			        },
					
					success: function() {

						Materialize.toast('You have successfully updated your profile.', 3000);
					
					}
			    });
			
		}else{

			if(passwordvalid == 0){

				Materialize.toast("Passwords did not match.", 3000);

			}

			if(facebookvalid == 0){
			
				Materialize.toast('Please input a valid Facebook Username or ID.', 3000);

			}

			if(passwordvalid == 0){
				$('#1').trigger('click');
				if(newuser==1){
					$('#confirmpassword2').focus();
				}else{
					$('#confirmpassword').focus();
				}
			}else if(facebookvalid==0){
				$('#3').trigger('click');
				$('#facebook').focus();				
			}
		}
	}

});

$(document).ready(function(){

	
	$.ajax({
        type: 'POST',
        url: 'getInfo',
        data: {
          'search': $('#google-id').val()
        },
		success: function(data){
			
			data = JSON.parse(data);
			document.getElementById('studnum').readOnly = true;
			document.getElementById('bday').readOnly = true;
			document.getElementById('college').readOnly = true;
			document.getElementById('course').readOnly = true;
			//document.getElementById('lastupdated').readOnly = true;	

			if(data.isinternational == null || data.isinternational == 0){
				document.getElementById("visacheck").checked = false;
				document.getElementById('passportnumber').style.display='none';
				document.getElementById('visa').style.display='none';
				document.getElementById('lpn').style.display='none';
				document.getElementById('ltov').style.display='none';
			}else{
				document.getElementById("visacheck").checked = true;
				document.getElementById('passportnumber').style.display='';
				document.getElementById('visa').style.display='';
				document.getElementById('lpn').style.display='';
				document.getElementById('ltov').style.display='';
			}

			if(data.isemployed == null || data.isemployed == 0){
				document.getElementById("employcheck").checked = false;
				document.getElementById('employer').style.display='none';
				document.getElementById('jobtitle').style.display='none';
				document.getElementById('le').style.display='none';
				document.getElementById('ljt').style.display='none';
			}else{
				document.getElementById("employcheck").checked = true;
				document.getElementById('employer').style.display='';
				document.getElementById('jobtitle').style.display='';
				document.getElementById('le').style.display='';
				document.getElementById('ljt').style.display='';
			}
			
			$('#fullname').val(data.fullname);
			$('#studnum').val(data.studnum);
			$('#bday').val(data.bday);
			$('#college').val(data.college);
			$('#course').val(data.course);

			if(data.lastupdated == null){
				$('#lastupdated').val("0000-00-00 00:00:00");
			}else{
				$('#lastupdated').val(data.lastupdated);
			}

			originalusername = data.username;
			$('#uname').val(data.username);
			$('#lastaccessed').val(data.lastaccessed);

			if(data.password == null){
				document.getElementById('newuserpassword').style.display='';
				newuser = 1;
			}else{

				document.getElementById('olduserpassword').style.display='';
				newuser = 0;

			}

			$('#nickname').val(data.nickname);
			$('#talent').val(data.talent);
			$('#scholarship').val(data.scholarship);
			$('#nationality').val(data.nationality);
			$('#religion').val(data.religion);
			$('#birthplace').val(data.birthplace);
			$('#maritalstatus').val(data.maritalstatus);
			$('#biologicalsex').val(data.biologicalsex);
			$('#bloodtype').val(data.bloodtype);

			$('#collegeaddress').val(data.collegeaddress);
			$('#permanentaddress').val(data.permanentaddress);
			$('#mobilenumber').val(data.mobilenumber);
			$('#landlinenumber').val(data.landlinenumber);
			$('#contactperson').val(data.contactperson);
			$('#contactpersonmobilenumber').val(data.contactpersonmobilenumber);
			$('#emailaddress').val(data.emailaddress);
			$('#facebook').val(data.facebook);
			$('#twitter').val(data.twitter);
			$('#biologicalsex').val(data.biologicalsex);
			$('#mobiledevice').val(data.mobiledevice);
			$('#region').val(data.region);

			$('#mothername').val(data.mothername);
			$('#mothereducation').val(data.mothereducation);
			$('#motherwork').val(data.motherwork);
			$('#motherbday').val(data.motherbday);

			$('#fathername').val(data.fathername);
			$('#fathereducation').val(data.fathereducation);
			$('#fatherwork').val(data.fatherwork);
			$('#fatherbday').val(data.fatherbday);
			
			if(data.no_siblings == null){
				$('#no_siblings').val(0);	
			}else{
				$('#no_siblings').val(data.no_siblings);
			}
			
			$('#previouscollege').val(data.previouscollege);
			$('#previouselementary').val(data.previouselementary);
			$('#previoushighschool').val(data.previoushighschool);
			$('#passportnumber').val(data.passportnumber);

			$('#visa').val(data.visa);
			$('#employer').val(data.employer);
			$('#jobtitle').val(data.jobtitle);
			
		}
		
    });	

});

function usernamechecker(){

	if(originalusername != $('#uname').val()){
		$.ajax({
		  type: "POST",
		  url: "checkusername",
		  data: {
		  	'username': $('#uname').val()
		  },
		  success: function(data) {

	          //console.log(data);

	          if(data == "reject"){

	            Materialize.toast('Username already taken.', 3000);
	            $("#uname").focus()
	          
	          }else if(data == "accept" && (!$('#uname').val() == "")){

	            Materialize.toast('Username accepted.', 3000);
	         
	         }
	        
	        }
		});
	}
}

function checkpassword(){

	$.ajax({
		  type: "POST",
		  url: "checkpassword",
		  data: {
		  	'id': $('#google-id').val(),
		  	'password': $('#oldpassword').val()
		  },
		  success: function(data) {

	          //console.log(data);

	          if(data == "reject"){

	            Materialize.toast('Password is incorrect.', 3000);
	            document.getElementById('newpassword').readOnly = true;
				document.getElementById('newpassword').style.pointerEvents = "none";
				document.getElementById('confirmpassword').readOnly = true;
				document.getElementById('confirmpassword').style.pointerEvents = "none";
				$('#newpassword').val("");
				$('#confirmpassword').val("");
				valid = 0;
				passwordvalid = 0;
				correctoldpassword = 0;
	          
	          }else if(data == "accept"){

	          	//Materialize.toast('Password is correct.', 3000);
	            document.getElementById('newpassword').readOnly = false;
				document.getElementById('newpassword').style.pointerEvents = "auto";
				document.getElementById('confirmpassword').readOnly = false;
				document.getElementById('confirmpassword').style.pointerEvents = "auto";
				correctoldpassword = 1;
	         
	         }
	        
	        }
		});

}

function passwordchecker(){

	if ($("#newpassword").val() != $("#confirmpassword").val()) {
	  	Materialize.toast("Passwords did not match.", 2000);
	  	valid = 0;
	  	passwordvalid = 0;
	  	//$("#confirmpassword").focus()
	}else{
		valid = 1;
		passwordvalid = 1;
	}

}

function enableconfirmpassword(){

	if ($("#password").val() != $("#confirmpassword").val()) {
	  	valid = 0;
	  	passwordvalid = 0;
	  	//$("#confirmpassword").focus()
	}else{
		valid = 1;
		passwordvalid = 1;
	}

}

function passwordchecker2(){

	if ($("#password2").val() != $("#confirmpassword2").val()) {
	  	Materialize.toast("Passwords did not match.", 2000);
	  	valid = 0;
	  	passwordvalid = 0;
	  	//$("#confirmpassword").focus()
	}else{
		valid = 1;
		passwordvalid = 1;
	}

}

function enableconfirmpassword2(){

	document.getElementById('confirmpassword2').readOnly = false;
	document.getElementById('confirmpassword2').style.pointerEvents = "auto";

	if ($("#password2").val() != $("#confirmpassword2").val()) {
	  	valid = 0;
	  	passwordvalid = 0;
	  	//$("#confirmpassword").focus()
	}else{
		valid = 1;
		passwordvalid = 1;
	}

}

document.getElementById('passwordcheck').onclick = function() {

    if ( this.checked ) {

    	document.getElementById('oldpasswordlabel').style.display='';
		document.getElementById('oldpassword').style.display='';
		document.getElementById('newpasswordlabel').style.display='';
		document.getElementById('newpassword').style.display='';
		document.getElementById('newpasswordconfirmlabel').style.display='';
		document.getElementById('confirmpassword').style.display='';

    } else {

        document.getElementById('oldpasswordlabel').style.display="none";
		document.getElementById('oldpassword').style.display="none";
		document.getElementById('newpasswordlabel').style.display="none";
		document.getElementById('newpassword').style.display="none";
		document.getElementById('newpasswordconfirmlabel').style.display="none";
		document.getElementById('confirmpassword').style.display="none";
		document.getElementById('newpassword').readOnly = true;
		document.getElementById('newpassword').style.pointerEvents = "none";
		document.getElementById('confirmpassword').readOnly = true;
		document.getElementById('confirmpassword').style.pointerEvents = "none";
		valid = 1;
		$('#oldpassword').val("");
		$('#newpassword').val("");
		$('#confirmpassword').val("");
		//$('#passportnumber').val("");
    
    }

};

document.getElementById('visacheck').onclick = function() {

    if ( this.checked ) {

    	document.getElementById('passportnumber').style.display='';
		document.getElementById('visa').style.display='';
		document.getElementById('lpn').style.display='';
		document.getElementById('ltov').style.display='';

    } else {

        document.getElementById('passportnumber').style.display='none';
		document.getElementById('visa').style.display='none';
		document.getElementById('lpn').style.display='none';
		document.getElementById('ltov').style.display='none';
		$('#visa').val("");
		//$('#passportnumber').val("");
    
    }

};

document.getElementById('employcheck').onclick = function() {

    if ( this.checked ) {

        document.getElementById('employer').style.display='';
		document.getElementById('jobtitle').style.display='';
		document.getElementById('le').style.display='';
		document.getElementById('ljt').style.display='';

    } else {

        document.getElementById('employer').style.display='none';
		document.getElementById('jobtitle').style.display='none';
		document.getElementById('le').style.display='none';
		document.getElementById('ljt').style.display='none';
		//$('#employer').val("");
		//$('#jobtitle').val("");
    
    }

};

function verifyfacebook(){

	document.getElementById('submitformbutton').style.pointerEvents = "none";

	if($('#facebook').val() == ''){
		
		document.getElementById('submitformbutton').style.pointerEvents = "";
		valid = 1;
		facebookvalid = 1;
	
	}else{

		document.getElementById('fbloader').style.display = '';


		$.ajax({
		    url : "https://graph.facebook.com/" + $('#facebook').val() + "/picture",
		    statusCode: {
		        200: function() {
					document.getElementById('fbloader').style.display = 'none';
					Materialize.toast('Facebook username is valid.', 3000);
					document.getElementById('submitformbutton').style.pointerEvents = "";
					valid = 1;
					facebookvalid = 1;
		        },

	            404: function() {
		            //alert( "user id not exist" );
		            var url = "https://www.facebook.com/" + $('#facebook').val();
		            

					$.ajax({
					  type: "POST",
					  url: "geturl",
					  data: {
					  	'url': url
					  },
					  success: function(data) {

						document.getElementById('fbloader').style.display = 'none';
						Materialize.toast('Facebook username is valid.', 3000);
						document.getElementById('submitformbutton').style.pointerEvents = "";
						valid = 1;
						facebookvalid = 1;

					  },
					  error: function(data) {

					     document.getElementById('fbloader').style.display = 'none';
					     Materialize.toast('Please input a valid Facebook Username or ID.', 3000);
					     valid = 0;
					     facebookvalid = 0;
					     document.getElementById('submitformbutton').style.pointerEvents = "";


					  }
					});
		        }
			}
		});
	}	
};

$(document).on('keydown', '#passwordcheck', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 9) { 	

		if($("#passwordcheck").prop('checked') == false){
			$('#2').trigger('click');
		}

	} 
});

$(document).on('keydown', '#confirmpassword', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 9) { 	

		$('#2').trigger('click');

	} 
});

$(document).on('keydown', '#confirmpassword2', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 9) { 	

		$('#2').trigger('click');

	} 
});

$(document).on('keydown', '#bloodtype', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 9) { 	

		$('#3').trigger('click');

	} 
});

$(document).on('keydown', '#region', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 9) { 	

		$('#4').trigger('click');

	} 
});

$(document).on('keydown', '#no_siblings', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 9) { 	

		$('#5').trigger('click');

	} 
});

$(document).on('keydown', '#jobtitle', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 9) { 	

		$('#6').trigger('click');

	} 
});

$(document).on('keydown', '#employcheck', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 9) { 	

		if($("#employcheck").prop('checked') == false){
			$('#6').trigger('click');
		}

	} 
});

//shift tab

$(document).on('keydown', '#5', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 13) { 	

		$('#5').trigger('click');

	}
});

$(document).on('keydown', '#4', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 13) { 	

		$('#4').trigger('click');
		
	}
});

$(document).on('keydown', '#3', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 13) { 	

		$('#3').trigger('click');
		
	}
});

$(document).on('keydown', '#2', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 13) { 	

		$('#2').trigger('click');
		
	}
});

$(document).on('keydown', '#1', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 13) { 	

		$('#1').trigger('click');
		
	}
});

$(document).on('keydown', '#passwordcheck', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 13) { 	

		$('#passwordcheck').trigger('click');

		if($("#passwordcheck").prop('checked') == true){
			document.getElementById('oldpasswordlabel').style.display='';
			document.getElementById('oldpassword').style.display='';
			document.getElementById('newpasswordlabel').style.display='';
			document.getElementById('newpassword').style.display='';
			document.getElementById('newpasswordconfirmlabel').style.display='';
			document.getElementById('confirmpassword').style.display='';
		}else{
			document.getElementById('oldpasswordlabel').style.display="none";
			document.getElementById('oldpassword').style.display="none";
			document.getElementById('newpasswordlabel').style.display="none";
			document.getElementById('newpassword').style.display="none";
			document.getElementById('newpasswordconfirmlabel').style.display="none";
			document.getElementById('confirmpassword').style.display="none";
			document.getElementById('newpassword').readOnly = true;
			document.getElementById('newpassword').style.pointerEvents = "none";
			document.getElementById('confirmpassword').readOnly = true;
			document.getElementById('confirmpassword').style.pointerEvents = "none";
			valid = 1;
			$('#oldpassword').val("");
			$('#newpassword').val("");
			$('#confirmpassword').val("");
		}
	}
});

$(document).on('keydown', '#visacheck', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 13) { 	

		$('#visacheck').trigger('click');

		if($("#visacheck").prop('checked') == true){
			document.getElementById('passportnumber').style.display='';
			document.getElementById('visa').style.display='';
			document.getElementById('lpn').style.display='';
			document.getElementById('ltov').style.display='';
		}else{
			document.getElementById('passportnumber').style.display='none';
			document.getElementById('visa').style.display='none';
			document.getElementById('lpn').style.display='none';
			document.getElementById('ltov').style.display='none';
			$('#visa').val("");
		}
	}
});

$(document).on('keydown', '#employcheck', function(e) { 
	var keyCode = e.keyCode || e.which; 

	if (keyCode == 13) { 	

		$('#employcheck').trigger('click');

		if($("#employcheck").prop('checked') == true){
			document.getElementById('employer').style.display='';
			document.getElementById('jobtitle').style.display='';
			document.getElementById('le').style.display='';
			document.getElementById('ljt').style.display='';
		}else{
			document.getElementById('employer').style.display='none';
			document.getElementById('jobtitle').style.display='none';
			document.getElementById('le').style.display='none';
			document.getElementById('ljt').style.display='none';
		}
	}
});

$("#submitformbutton").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#submitformbutton").click();
    }
  });

  $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 100,
  	format: 'yyyy-mm-dd'
  });

  ;(function ($) {
  $.fn.collapsible = function(options) {
    var defaults = {
        accordion: undefined
    };

    options = $.extend(defaults, options);


    return this.each(function() {

      var $this = $(this);

      var $panel_headers = $(this).find('> li > .collapsible-header');

      var collapsible_type = $this.data("collapsible");

      // Turn off any existing event handlers
       $this.off('click.collapse', '> li > .collapsible-header');
       $panel_headers.off('click.collapse');


       /****************
       Helper Functions
       ****************/

      // Accordion Open
      function accordionOpen(object) {
        $panel_headers = $this.find('> li > .collapsible-header');
        if (object.hasClass('active')) {
            object.parent().addClass('active');
        }
        if (object.parent().hasClass('active')){
          object.siblings('.collapsible-body').stop(true,false).slideDown({ duration: 350, easing: "easeOutQuart", queue: false, complete: function() {$(this).css('height', '');}});
        }
        else{
          object.siblings('.collapsible-body').stop(true,false).slideUp({ duration: 350, easing: "easeOutQuart", queue: false, complete: function() {$(this).css('height', '');}});
        }

        $panel_headers.not(object).removeClass('active').parent().removeClass('active');
        $panel_headers.not(object).parent().children('.collapsible-body').stop(true,false).slideUp(
          {
            duration: 350,
            easing: "easeOutQuart",
            queue: false,
            complete:
              function() {
                $(this).css('height', '');
              }
          });
      }

      // Expandable Open
      function expandableOpen(object) {
        if (object.hasClass('active')) {
            object.parent().addClass('active');
        }
        else {
            object.parent().removeClass('active');
        }
        if (object.parent().hasClass('active')){
          object.siblings('.collapsible-body').stop(true,false).slideDown({ duration: 350, easing: "easeOutQuart", queue: false, complete: function() {$(this).css('height', '');}});
        }
        else{
          object.siblings('.collapsible-body').stop(true,false).slideUp({ duration: 350, easing: "easeOutQuart", queue: false, complete: function() {$(this).css('height', '');}});
        }
      }

      /**
       * Check if object is children of panel header
       * @param  {Object}  object Jquery object
       * @return {Boolean} true if it is children
       */
      function isChildrenOfPanelHeader(object) {

        var panelHeader = getPanelHeader(object);

        return panelHeader.length > 0;
      }

      /**
       * Get panel header from a children element
       * @param  {Object} object Jquery object
       * @return {Object} panel header object
       */
      function getPanelHeader(object) {

        return object.closest('li > .collapsible-header');
      }

      /*****  End Helper Functions  *****/



      // Add click handler to only direct collapsible header children
      $this.on('click.collapse', '> li > .collapsible-header', function(e) {
        var $header = $(this),
            element = $(e.target);

        if (isChildrenOfPanelHeader(element)) {
          element = getPanelHeader(element);
        }

        element.toggleClass('active');

        if (options.accordion || collapsible_type === "accordion" || collapsible_type === undefined) { // Handle Accordion
          accordionOpen(element);
        } else { // Handle Expandables
          expandableOpen(element);

          if ($header.hasClass('active')) {
            expandableOpen($header);
          }
        }
      });

      // Open first active
      var $panel_headers = $this.find('> li > .collapsible-header');
      if (options.accordion || collapsible_type === "accordion" || collapsible_type === undefined) { // Handle Accordion
        accordionOpen($panel_headers.filter('.active').first());
      }
      else { // Handle Expandables
        $panel_headers.filter('.active').each(function() {
          expandableOpen($(this));
        });
      }

    });
  };

  $(document).ready(function(){
    $('.collapsible').collapsible();
  });
}( jQuery ));

$('#profile-pic-input').change(function(){
  if($('#profile-pic-input').val() != ''){

  	$('#message').val("Uploading...");

    var formData = new FormData($('#pic-form')[0]);
    
    $.ajax({
        url: "upload",
        type: 'POST',
        data: formData,
        success: function (data) {
        	data = JSON.parse(data);
        	if(data[0] == "success"){
	        	$('#message').val(data[1]);
	        	document.getElementById('profpicture1').src = "#";
	        	document.getElementById("profpicture1").src = data[2]+"?time="+new Date().getTime();
        	}else{
        		$('#message').val(data[1]);
        	}
        },
        error: function (data) {
            Materialize.toast("Ooops, something went wrong.", 2000);
        },
        cache: false,
        contentType: false,
        processData: false
    });
	
  }
});


function submit_post_via_hidden_form(url, params) {
    var f = $("<form target='_blank' method='POST' style='display:none;'></form>").attr({
        action: url
    }).appendTo(document.body);

    for (var i in params) {
        if (params.hasOwnProperty(i)) {
            $('<input type="hidden" />').attr({
                name: i,
                value: params[i]
            }).appendTo(f);
        }
    }

    f.submit();

    f.remove();
}