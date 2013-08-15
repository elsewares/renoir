<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>HangItUp Chicago Admin</title>
    <meta name="description" content="Art rentals and purchases from Chicagoland artists.">
    <meta name="author" content="HangItUp Chicago & elsewar.es">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic' rel='stylesheet' type='text/css' />
    <link href="<?php echo $this->webroot; ?>css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo $this->webroot; ?>css/backend.css" rel="stylesheet" />
    <link type="text/css" rel="stylesheet/less" href="<?php echo '/matisse/css/matisse.less' ?>" />
    <?php echo $this->Html->script('bootstrap.js'); echo $this->Html->script('less-1.2.2.js'); ?>

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
  </head>

  <body>

    <?php echo $this->element('topbar'); ?>
    
    <div class="container content">
    
      <?php echo $this->Session->flash(array('element' => 'flash')); ?>
      
      <?php echo $this->fetch('content'); ?>
      
      <?php echo $this->element('footer'); ?>

    </div> <!-- /container -->

  </body>
</html>

