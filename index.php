<?php

require('app/lib/base.php');
$f3 = Base::instance();
$web = \Web::instance();
$f3->config('app/config.ini');
$f3->config('app/routes.ini');
$f3->run();

?>