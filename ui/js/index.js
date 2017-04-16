$('#saButton').click(function(){

  Materialize.toast('Retrieving SA inquiries...', 3000);

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

$('#closingButton').click(function(){

  Materialize.toast('Retrieving Closing inquiries...', 3000);

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
