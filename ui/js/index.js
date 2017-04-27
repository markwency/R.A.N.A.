$('#saButton').click(function(){

  Materialize.toast('Retrieving SA inquiries...', 3000);
  console.log("Training SA inquiries...");

    $.ajax({
        type: 'POST',
        url: 'retrieveSA',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('SA inquiries successfully retrieved.', 3000);
          console.log(data);
          
        }
  });

});

$('#slbButton').click(function(){

	Materialize.toast('Retrieving SLB inquiries...', 3000);
  console.log("Training SLB inquiries...");

    $.ajax({
        type: 'POST',
        url: 'retrieveSLB',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('SLB inquiries successfully retrieved.', 3000);
          console.log(data);
          
        }
  });

});

$('#cashLoanButton').click(function(){

  Materialize.toast('Retrieving Cash Loan inquiries...', 3000);
  console.log("Training Cash Loan inquiries...");

    $.ajax({
        type: 'POST',
        url: 'retrieveCashLoan',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('Cash Loan inquiries successfully retrieved.', 3000);
          console.log(data);
          
        }
  });

});

$('#osamButton').click(function(){

  Materialize.toast('Retrieving OSAM inquiries...', 3000);
  console.log("Training OSAM inquiries...");

    $.ajax({
        type: 'POST',
        url: 'retrieveOSAM',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('OSAM inquiries successfully retrieved.', 3000);
          console.log(data);
          
        }
  });

});

$('#regButton').click(function(){

  Materialize.toast('Retrieving Registration inquiries...', 3000);
  console.log("Training Registration inquiries...");

    $.ajax({
        type: 'POST',
        url: 'retrieveRegistration',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('Registration inquiries successfully retrieved.', 3000);
          console.log(data);
          
        }
  });

});


$('#studActButton').click(function(){

	Materialize.toast('Retrieving Student Activity inquiries...', 3000);
  console.log("Training Student Activity inquiries...");

    $.ajax({
        type: 'POST',
        url: 'retrieveStudentActivity',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('Student Activity inquiries successfully retrieved.', 3000);
          console.log(data);
          
        }
  });

});

$('#scholarshipButton').click(function(){

  Materialize.toast('Retrieving Scholarship inquiries...', 3000);
  console.log("Training Scholarship inquiries...");

    $.ajax({
        type: 'POST',
        url: 'retrieveScholarship',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('Scholarship inquiries successfully retrieved.', 3000);
          console.log(data);
          
        }
  });

});

$('#stsButton').click(function(){

  Materialize.toast('Retrieving STS inquiries...', 3000);
  console.log("Training STS inquiries...");

    $.ajax({
        type: 'POST',
        url: 'retrieveSTS',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('Scholarship inquiries successfully retrieved.', 3000);
          console.log(data);
          
        }
  });

});


$('#counselButton').click(function(){

  Materialize.toast('Retrieving Counsel inquiries...', 3000);
  console.log("Training Counseling inquiries...");

    $.ajax({
        type: 'POST',
        url: 'retrieveCounsel',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('Counsel inquiries successfully retrieved.', 3000);
          console.log(data);
          
        }
  });

});

$('#schoolDaysButton').click(function(){

  Materialize.toast('Retrieving School Days inquiries...', 3000);
  console.log("Training School Days inquiries...");

    $.ajax({
        type: 'POST',
        url: 'retrieveSchoolDays',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('School Days inquiries successfully retrieved.', 3000);
          console.log(data);
          
        }
  });

});


$('#saisButton').click(function(){

  Materialize.toast('Retrieving SAIS inquiries...', 3000);
  console.log("Training SAIS inquiries...");

    $.ajax({
        type: 'POST',
        url: 'retrieveSAIS',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('SAIS inquiries successfully retrieved.', 3000);
          console.log(data);
          
        }
  });

});

$('#acadButton').click(function(){

  Materialize.toast('Retrieving Academic Related inquiries...', 3000);
  console.log("Training Academic Related inquiries...");

    $.ajax({
        type: 'POST',
        url: 'retrieveAcad',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('Academic Related inquiries successfully retrieved.', 3000);
          console.log(data);
          
        }
  });

});

$('#otherButton').click(function(){

  Materialize.toast('Retrieving Other Offices inquiries...', 3000);
  console.log("Training Other Offices inquiries...");

    $.ajax({
        type: 'POST',
        url: 'retrieveOther',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('Other Offices inquiries successfully retrieved.', 3000);
          console.log(data);
          
        }
  });

});

$('#closingButton').click(function(){

  Materialize.toast('Retrieving Closing inquiries...', 3000);
  console.log("Training Closing inquiries...");

    $.ajax({
        type: 'POST',
        url: 'retrieveClosing',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('Closing inquiries successfully retrieved.', 3000);
          console.log(data);
          
        }
  });

});

$('#testButton').click(function(){

	Materialize.toast('Creating Test Data...', 3000);

    $.ajax({
        type: 'POST',
        url: 'createTestData',
        success: function(data) {

          data = JSON.parse(data);

          Materialize.toast('Test Data created.', 3000);
          console.log(data);
          
        }
  });

});
