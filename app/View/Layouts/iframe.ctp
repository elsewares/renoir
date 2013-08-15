<head>

    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="http://<?php echo CakeRequest::host() ?>/wp-content/themes/PholioWork/style.css" />
    <link rel="stylesheet" type="text/css" href="http://<?php echo CakeRequest::host() ?>/matisse/css/bootstrap.css" />
    <link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    
    <style type="text/css">
    body { font-family: "PT Serif" !important; }
    .navwrap,
    .navwrap a { font-family: "PT Serif" !important; }
    h1, h2, h3, h4, h5, h6 { font-family: "PT Serif" !important; }
    </style>

    <link type="text/css" rel="stylesheet/less" href="<?php echo '/matisse/css/matisse.less' ?>" />
    <?php echo $this->Html->script('less-1.2.2'); ?>
</head>
<body class="iframed">
  <?php if(!isset($modal)): ?>
    <div class="from_matisse container">  
      <?php echo $this->Session->flash(); ?>
      <?php echo $this->Session->flash('auth'); ?>

      <?php echo $this->fetch('content'); ?>
      <?php echo $this->element('hidden_matisse'); ?>
    </div>
  <?php else: ?>
    <div class="modal_matisse">
      <?php echo $this->fetch('content'); ?>
      <?php echo $this->element('hidden_matisse'); ?>
    </div>
  <?php endif; ?>
</body>