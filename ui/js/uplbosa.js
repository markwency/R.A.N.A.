$('.button-collapse').sideNav({
      menuWidth: 350, // Default is 240
  });
  
  $('.dropdown-button').dropdown({ hover: true });

  $(document).ready(function() {
    $(window).on("resize load", function () {
      if ($(window).width() >= 1550) {
        $( "#osalogonav" ).fadeIn("fast");
        document.getElementById('osalogonav2').style.display='none';
      }

      if ($(window).width() < 1550) {
        $( "#osalogonav2" ).fadeIn("fast");
        document.getElementById('osalogonav').style.display='none';
      }

    });
  });


  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });


  function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail());

    var id = profile.getId();
    var fullName = profile.getName();
    var firstName = profile.getGivenName();
    var lastName = profile.getFamilyName();
    var userEmail = profile.getEmail();
    var img = profile.getImageUrl();

    var lastTen = userEmail.substr(userEmail.length - 10); 

    var fromUser = lastTen.toLowerCase();

    if(fromUser  == "@up.edu.ph"){

    	$.ajax({
        type: 'POST',
        url: 'retrieve',
        data: {
          'search': id,
          'fullName': fullName,
          'firstName': firstName,
          'lastName': lastName,
          'userEmail': userEmail,
          'img': img
        },

  			success: function(data) {

          console.log(data);

          data = JSON.parse(data);

          if(data['reroute']){
            alert(data['reroute']);
            Materialize.toast('Please create an account. Redirecting...', 3000);
            setTimeout(function(){
              window.location = data['reroute'];
            }, 3000);
          
          }else{ 				

    				Materialize.toast('Welcome, ' + data.name + '.', 2000);
            $('#loginmodal').closeModal();
            setTimeout(function(){
              $.ajax({
                type: 'POST',
                url: 'gohome',
              
                success: function(data) {

                  data = JSON.parse(data);

                  if(data['reroute']){

                    window.location = data['reroute'];
                  
                  }else{        

                    Materialize.toast("Ooops, something went wrong.", 2000);
                 
                  }
                
                }

              });
            }, 2000);
         
         }
  			
        }

		  });

    }else{
      Materialize.toast('Please enter a valid up.edu.ph account. Logging out...', 3000);
      setTimeout(function(){
        $.ajax({
          type: 'POST',
          url: 'logout',
        });
        window.location = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost/finalosa/";

      }, 3000);
      
    }
  }

  // Wait for the page to load first
  window.onload = function() {

    var logoutbutton = document.getElementById("logoutbutton");
    var logoutbutton2 = document.getElementById("logoutbutton2");
    var editbutton = document.getElementById("editbutton");


    logoutbutton.onclick = function() {

      Materialize.toast('Logging out...', 1000);
      setTimeout(function(){
        $.ajax({
          type: 'POST',
          url: 'logout',
        });
        window.location = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost/finalosa/";

      }, 1000);

    }

    logoutbutton2.onclick = function() {

      Materialize.toast('Logging out...', 1000);
      setTimeout(function(){
        $.ajax({
          type: 'POST',
          url: 'logout',
        });
        window.location = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost/finalosa/";

      }, 1000);

    }

    editbutton.onclick = function() {

      $.ajax({
        type: 'POST',
        url: 'goforms',
      
        success: function(data) {

          data = JSON.parse(data);

          if(data['reroute']){

            window.location = data['reroute'];
          
          }else{        

            Materialize.toast("Ooops, something went wrong.", 2000);
         
          }
        
        }

      });

    } 
  
  }

  $('#loginbutton').click(function(){

    $.ajax({
        type: 'POST',
        url: 'login',
        data: {
          'username': $('#username').val(),
          'password': $('#password').val()
        },

        success: function(data) {

          data = JSON.parse(data);
          
          if(data == null){

            Materialize.toast('Wrong Username/Password.', 3000);
          
          }else{        

            Materialize.toast('Welcome, ' + data.name + '.', 2000);
            $('#loginmodal').closeModal();
            setTimeout(function(){
              $.ajax({
                type: 'POST',
                url: 'gohome',
              
                success: function(data) {

                  data = JSON.parse(data);

                  if(data['reroute']){

                    window.location = data['reroute'];
                  
                  }else{        

                    Materialize.toast("Ooops, something went wrong.", 2000);
                 
                  }
                
                }

              });
            }, 2000);
         
         }
        
        }

      });

  });

  $("#password").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#loginbutton").click();
    }
  });

  function homepage(){

    $.ajax({
      type: 'POST',
      url: 'gohome',
    
      success: function(data) {

        data = JSON.parse(data);

        if(data['reroute']){

          window.location = data['reroute'];
        
        }else{        

          Materialize.toast("Ooops, something went wrong.", 2000);
       
        }
      
      }

    });

  }

  $('#sidenavbutton').click(function(){
      document.getElementById('slide-out').style.display='';
  });