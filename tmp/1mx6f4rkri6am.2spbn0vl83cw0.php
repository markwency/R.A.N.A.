<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title><?php echo $title; ?> - <?php echo $SITE; ?></title>

  <!-- CSS  -->
  <link href="<?php echo $RESOURCE . 'css/icons/icons.css'; ?>" rel="stylesheet">
  <link href="<?php echo $RESOURCE . 'css/materialize.css'; ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="<?php echo $RESOURCE . 'css/style.css'; ?>" type="text/css" rel="stylesheet" media="screen,projection"/>

</head>
  <body>
    <ul>
      <li><a id="saButton" class="waves-effect waves-light inquiryButton btn">SA</a></li>
      <li><a id="slbButton" class="waves-effect waves-light inquiryButton btn">SLB</a></li>
      <li><a id="closingButton" class="waves-effect waves-light inquiryButton btn">Closing</a></li>
      <li><a id="testButton" class="waves-effect waves-light inquiryButton btn">Create Test Data</a></li>
    </ul>
  <script src="<?php echo $RESOURCE . 'js/jquery.min.js'; ?>"></script>
  <script src="<?php echo $RESOURCE . 'js/jquery-ui.min.js'; ?>"></script>
  <script src="<?php echo $RESOURCE . 'js/materialize.js'; ?>"></script>
  <script src="<?php echo $RESOURCE . 'js/rana.js'; ?>"></script>
  

  </body>
</html>