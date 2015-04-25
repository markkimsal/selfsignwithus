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
			<div class="col-md-6 col-sm-6 col-xs-12">
			<div class=" well well-aff">
			<h4>Need a VPS to try out your new cert?</h4>
			<h4><a style="color:#DDF" href="https://www.linode.com/?r=aa9059b45056457c90231e3e50e3e7e222c8b0f9">Try Linode.com</a></h4>
			</div>
			</div>
        </div>
    </div>
        <div class="row">
			<div class="col-xs-12 nav-header">
			    <div class="container">
					<ul><li><a href="https://wiki.asterisk.org/wiki/display/AST/SIP+TLS+Transport">SSL and Asterisk</a></li><li><a href="https://dev.mysql.com/doc/refman/5.0/en/replication-solutions-ssl.html">SSL and MySQL</a></li><li><a href="http://nginx.org/en/docs/http/configuring_https_servers.html">SSL and Nginx</a></li></ul>
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
<a href="https://github.com/markkimsal/selfsignwithus"><img style="position: absolute; top: 0; right: 0; border: 0;" src="https://camo.githubusercontent.com/38ef81f8aca64bb9a64448d0d70f1308ef5341ab/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f72696768745f6461726b626c75655f3132313632312e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_right_darkblue_121621.png"></a>
</body>
</html>
