<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>提示</title>  
    <?php include("template/$OJ_TEMPLATE/css.php");?>     


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  <div class="container">
    <?php include("template/$OJ_TEMPLATE/nav.php");?>     
    <div class="jumbotron">
      <h2><?php echo $message; ?></h2>
      <p></p>
    </div>
  </div>
  <?php include("template/$OJ_TEMPLATE/js.php");?>
  </body>
  </html>