<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title><?php echo $title; ?> - <?php echo $SITE; ?></title>

  <!-- CSS  -->
  <link href="<?php echo $RESOURCE . 'img/osa-logo.png'; ?>" type="image/png" rel="icon">
  <link href="<?php echo $RESOURCE . 'css/icons/icons.css'; ?>" rel="stylesheet">
  <link href="<?php echo $RESOURCE . 'css/materialize.css'; ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo $RESOURCE . 'css/style.css'; ?>" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>
  <body>
    <h3 class="center upmaroon">Retrospective Artificially intelligent <br> Network Assistant (R.A.N.A.)</h3>
    <div class="center">
    <h5 class="upmaroon">Create Training Data:</h5>
    </div> 
    <div class="row">
      <div class="col s2 offset-s4">
        <ul>
          <li><a id="saButton" class="waves-effect waves-light inquiryButton btn" style="margin-top: 5px; display: block;">SA</a></li>
          <li><a id="slbButton" class="waves-effect waves-light inquiryButton btn" style="margin-top: 5px; display: block;">SLB</a></li>
          <li><a id="closingButton" class="waves-effect waves-light inquiryButton btn" style="margin-top: 5px; display: block;">Closing</a></li>
          <li><a id="cashLoanButton" class="waves-effect waves-light inquiryButton btn" style="margin-top: 5px; display: block;">Cash Loan</a></li>
          <li><a id="osamButton" class="waves-effect waves-light inquiryButton btn" style="margin-top: 5px; display: block;">OSAM</a></li>
          <li><a id="regButton" class="waves-effect waves-light inquiryButton btn" style="margin-top: 5px; display: block;">Registration</a></li>
          <li><a id="studActButton" class="waves-effect waves-light inquiryButton btn" style="margin-top: 5px; display: block;">Student Activity</a></li>
        </ul>
      </div>
      <div class="col s2">
        <ul>
          <li><a id="scholarshipButton" class="waves-effect waves-light inquiryButton btn" style="margin-top: 5px; display: block;">Scholarship</a></li>
          <li><a id="stsButton" class="waves-effect waves-light inquiryButton btn" style="margin-top: 5px; display: block;">STS</a></li>
          <li><a id="counselButton" class="waves-effect waves-light inquiryButton btn" style="margin-top: 5px; display: block;">Counseling</a></li>
          <li><a id="schoolDaysButton" class="waves-effect waves-light inquiryButton btn" style="margin-top: 5px; display: block;">School Days</a></li>
          <li><a id="saisButton" class="waves-effect waves-light inquiryButton btn" style="margin-top: 5px; display: block;">SAIS</a></li>
          <li><a id="acadButton" class="waves-effect waves-light inquiryButton btn" style="margin-top: 5px; display: block;">Academic Related</a></li>
          <li><a id="otherButton" class="waves-effect waves-light inquiryButton btn" style="margin-top: 5px; display: block;">Other Offices</a></li>
        </ul>
      </div>
    </div>
  <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s6 offset-s3">
          <input id="inquiry" type="text" class="validate">
          <label for="inquiry">Inquiry</label>
        </div>
      </div>
    </form>
  </div>

  <div class="row">
      <div class="center">
        <a id="testButton" class="waves-effect waves-light inquiryButton btn">Classify</a>
        <h5 class="upmaroon">Classification:</h5><p id="classification"></p>
      </div>
  </div>

  <script src="<?php echo $RESOURCE . 'js/jquery.min.js'; ?>"></script>
  <script src="<?php echo $RESOURCE . 'js/jquery-ui.min.js'; ?>"></script>
  <script src="<?php echo $RESOURCE . 'js/materialize.js'; ?>"></script>
  <script src="<?php echo $RESOURCE . 'js/index.js'; ?>"></script>
  

  </body>
</html>