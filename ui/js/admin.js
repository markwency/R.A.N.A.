$('#sidenavbutton').click(function(){
      console.log("keepo");
      document.getElementById('slide-out').style.display='';
  });


$('.button-collapse').sideNav({
      menuWidth: 350, // Default is 240
  });
  
  $('.dropdown-button').dropdown({ 
    hover: true,
  });

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

    $.ajax({
      type: 'POST',
      url: 'loadimages',
    
      success: function(data) {

        data = JSON.parse(data);

        for (i = 0; i < data.length; i++) {
          $( "#imagesList" ).append( '<div class="listcontent"><input type="hidden" id="' + i + '" value="'+ data[i].id +'"><a href="#" onclick="gopicture(document.getElementById(' + i + ').value)"><img class="loadedimages" src="'+ data[i].picture +'" style="width:200px; height:200px;"/></a></div>' );
        }
      
      },

      error: function(data) {

        //data = JSON.parse(data);

        alert("error");
      
      }

    });


    $.ajax({
      type: 'POST',
      url: 'loadrejected',
      data: {
        'id': $('#pendingid').val()
      },
      success: function(data) {

        data = JSON.parse(data);

        for (i = 0; i < data.length; i++) {
          $( "#rejectedList" ).append( '<div class="listcontent"><input type="hidden" id="' + i + '" value="'+ data[i].id +'"><img class="loadedimages" src="'+ data[i].picture +'" style="width:200px; height:200px;"/></div>' );
        }

        if(data.length > 0){
          document.getElementById('rejectedheader').style.display='';
        }

      },

      error: function(data) {

        //data = JSON.parse(data);

        alert("error");
      
      }

    });

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

  $('#loginbutton2').click(function(){

    $.ajax({
        type: 'POST',
        url: 'adminlogin',
        data: {
          'username': $('#username2').val(),
          'password': $('#password2').val()
        },

        success: function(data) {

          data = JSON.parse(data);

          if(data == null){

            Materialize.toast('Wrong Username/Password.', 3000);
          
          }else{        
            
            Materialize.toast('Welcome, admin.', 2000);
            setTimeout(function(){
              $.ajax({
                type: 'POST',
                url: 'goadmin',
              
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

  $("#password2").keypress(function(event) {
    if (event.which == 13) {
        event.preventDefault();
        $("#loginbutton2").click();
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

  $('#adminlogoutbutton').click(function(){

    Materialize.toast('Logging out...', 1000);
      setTimeout(function(){
        $.ajax({
          type: 'POST',
          url: 'logout',
        });
        window.location = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost/finalosa/";

      }, 1000);

  });

  $('#adminlogoutbutton2').click(function(){

    Materialize.toast('Logging out...', 1000);
      setTimeout(function(){
        $.ajax({
          type: 'POST',
          url: 'logout',
        });
        window.location = "https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost/finalosa/";

      }, 1000);

  });

  $('#approvalbutton').click(function(){

    $.ajax({
      type: 'POST',
      url: 'goadmin',
    
      success: function(data) {

        data = JSON.parse(data);

        if(data['reroute']){

          window.location = data['reroute'];
        
        }else{        

          Materialize.toast("Ooops, something went wrong.", 2000);
       
        }
      
      }

    });

  });

  $('#goback').click(function(){

    $.ajax({
      type: 'POST',
      url: 'goadmin',
    
      success: function(data) {

        data = JSON.parse(data);

        if(data['reroute']){

          window.location = data['reroute'];
        
        }else{        

          Materialize.toast("Ooops, something went wrong.", 2000);
       
        }
      
      }

    });

  });

  function gopicture(element){

    //alert(element);
    $.ajax({
      type: 'POST',
      url: 'gopicture',
      data: {
        'id': element,
      },
    
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

  document.getElementById('reject').onclick = function() {

    if (!document.getElementById('checkboxes').style.display=='' ) {

      document.getElementById('checkboxes').style.display='';
      document.getElementById('message').style.display='';
      document.getElementById('submitbtn').style.display='';

    } else {

      document.getElementById('checkboxes').style.display='none';
      document.getElementById('message').style.display='none';
      document.getElementById('submitbtn').style.display='none';
      
    }

  };

  $('#submitbutton').click(function(){

    comments = [];
    i = 0;

    if (document.getElementById('Photo must be square and must be at least 200x200 pixels.').checked){
      comments[i] = "Photo must be square and must be at least 200x200 pixels.";
      i++;
    }

    if (document.getElementById('There should be no picbadges, twibbons, logos, or any other unnecessary elements.').checked){
      comments[i] = "There should be no picbadges, twibbons, logos, or any other unnecessary elements.";
      i++;
    }

    if (document.getElementById('There should be no eyeglasses or any accessories that may cover facial features.').checked){
      comments[i] = "There should be no eyeglasses or any accessories that may cover facial features.";
      i++;
    }

    if (document.getElementById('There should only be one person in the photo.').checked){
      comments[i] = "There should only be one person in the photo.";
      i++;
    }

    if (document.getElementById('The background of the photo must be plain (light solid color).').checked){
      comments[i] = "The background of the photo must be plain (light solid color).";
      i++;
    }

    if (document.getElementById('Photo must not be blurred.').checked){
      comments[i] = "Photo must not be blurred.";
      i++;
    }

    if (document.getElementById('Photo must be in standard close-up shot (shoulder level up to tip of hair).').checked){
      comments[i] = "Photo must be in standard close-up shot (shoulder level up to tip of hair).";
      i++;
    }

    if (document.getElementById('Photo must be colored.').checked){
      comments[i] = "Photo must be colored.";
      i++;
    }

    if (document.getElementById('Face must be recognizable. It must not be too dark or too bright.').checked){
      comments[i] = "Face must be recognizable. It must not be too dark or too bright.";
      i++;
    }

    if (document.getElementById('Face must comprise about 70% of the photo.').checked){
      comments[i] = "Face must comprise about 70% of the photo.";
      i++;
    }

    if (document.getElementById('The person must be directly facing the camera in normal angle.').checked){
      comments[i] = "The person must be directly facing the camera in normal angle.";
      i++;
    }

    if (document.getElementById('Shoulders and head must not be tilted.').checked){
      comments[i] = "Shoulders and head must not be tilted.";
      i++;
    }

    if (document.getElementById('Photo must not be improperly cropped nor stretched.').checked){
      comments[i] = "Photo must not be improperly cropped nor stretched.";
      i++;
    }

    if (document.getElementById('Photo must not have photo effects (borders/sepia tone/glittering effect).').checked){
      comments[i] = "Photo must not have photo effects (borders/sepia tone/glittering effect).";
      i++;
    }

    if (document.getElementById('Photo must be recent (taken within the last six months).').checked){
      comments[i] = "Photo must be recent (taken within the last six months).";
      i++;
    }

    if(!$('#textarea1').val() == ''){
      add = $('#textarea1').val();
      comments.push(add);
    }


    $.ajax({
      type: 'POST',
      url: 'rejectpicture',
      data: {
        'id': $('#pendingid').val(),
        comments: comments
      },
          
      success: function(data) {
        
        //alert(data);
        Materialize.toast("Success.", 1000);
        setTimeout(function(){
          $.ajax({
            type: 'POST',
            url: 'goadmin',
          
            success: function(data) {

              data = JSON.parse(data);

              if(data['reroute']){

                window.location = data['reroute'];
              
              }else{        

                Materialize.toast("Ooops, something went wrong.", 1000);
             
              }
            
            }

          });

        }, 1000);
      
      },
      error: function(data){

        Materialize.toast("Ooops, something went wrong", 2000);

      }
    });


  });

  $('#approve').click(function(){

    $.ajax({
      type: 'POST',
      url: 'approvepicture',
      data: {
        'id': $('#pendingid').val()
      },
          
      success: function(data) {
        
        //alert(data);
        Materialize.toast("Success.", 1000);
        setTimeout(function(){
          $.ajax({
            type: 'POST',
            url: 'goadmin',
          
            success: function(data) {

              data = JSON.parse(data);

              if(data['reroute']){

                window.location = data['reroute'];
              
              }else{        

                Materialize.toast("Ooops, something went wrong.", 1000);
             
              }
            
            }

          });

        }, 1000);
      
      },
      error: function(data){

        Materialize.toast("Ooops, something went wrong", 2000);

      }
    });

  });

