<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Easily create and manage your self signed certificates">
    <meta name="keywords" content="self sign, self-signed, certificate, ssl, keygen, generator, manage, easy">
    <meta name="author" content="">

    <title>Self Signed SSL Certificates | Self Sign With Us</title>

    <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo m_turl();?>components/Bootflat/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo m_turl();?>components/Bootflat/css/site.min.css" rel="stylesheet">
<!--
-->

    <!-- Custom CSS -->
    <link href="<?php echo m_turl();?>css/sswu-site.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrap">
<header>
    <div class="container">
        <div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
			<img src="<?php echo m_turl();?>img/sswu-logo.png"/>
            <div class="tagline">Self Sign with Us</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 well well-aff">
			<h4>Need a VPS to try out your new cert?</h4>
			<h4><a style="color:#DDF" href="https://www.linode.com/?r=aa9059b45056457c90231e3e50e3e7e222c8b0f9">Try Linode.com</a></h4>
			</div>
        </div>
    </div>
</header>

<?php Metrofw_Template::parseSection('sparkmsg'); ?>

<div class="container">
<?php Metrofw_Template::parseSection('main'); ?>
</div>
</div>

<div class="container footersswu">
	<footer class="copyright clearfix"><p><b>Self Sign With Us</b>&nbsp;&nbsp;never stores your keys or certs to disk. Everything is streamed from memcache to FIFO pipes and expires after 10 min.</p>
	</footer>
</div>
</body>
</html>
