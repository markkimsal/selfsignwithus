<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>selfsignwithus</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo m_turl();?>components/Bootflat/css/bootstrap.min.css" rel="stylesheet">
<!--
    <link href="<?php echo m_turl();?>components/Bootflat/css/site.min.css" rel="stylesheet">
-->

    <!-- Custom CSS -->
    <link href="<?php echo m_turl();?>css/sswu.css" rel="stylesheet">
    <link href="<?php echo m_turl();?>css/sswu-site.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<header>
    <div class="container">
        <div class="row">
            <div class="page-header"> 
                <h1>Self Sign with Us</h1>
            </div>
        </div>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <form>
                <h3>1. Public Private Key Gen</h3>
                <div class=form-group">
                    <label>Strength
                    <select class="form-control" id="keygen-bits">
                    <option value="1024">1024</option>
                    <option value="2048" selected="selected">2048</option>
                    </select>
                    </label>
				    <label>Type
                    <select class="form-control" id="keygen-type">
                    <option value="dsa">dsa</option>
                    <option value="rsa" selected="selected">rsa</option>
                    </select>
                    </label>

                </div>

            </form>
        </div>
        <div class="col-sm-6">
            <div class="panel">
                keygen output goes here
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-6">
            <form>

                <h3>2. Certificate Sign Request (CSR)</h3>
                <div class=form-group">
                    <label>Country
                    <input type="text" class="form-control" id="csr-country" placeholder="UK, CA, US, ...">
                    </label>
                </div>
                <div class=form-group">
                    <label>State/Province
                    <input type="text" class="form-control" id="csr-state" placeholder="...">
                    </label>
                </div>
                <div class=form-group">
                    <label>City/Locality
                    <input type="text" class="form-control" id="csr-city" placeholder="...">
                    </label>
                </div>
                <div class=form-group">
                    <label>Organization
                    <input type="text" class="form-control" id="csr-org" placeholder="Company Name">
                    </label>
                </div>
                <div class=form-group">
                    <label>Department / Unit
                    <input type="text" class="form-control" id="csr-unit" placeholder="[optional]">
                    </label>
                </div>
                <div class=form-group">
                    <label>Domain or Common Name
                    <input type="text" class="form-control" id="csr-dom" placeholder="example.com">
                    </label>
                </div>
            </form>
        </div>
        <div class="col-sm-6">
            <div class="panel">
                CSR output goes here
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
            <form>

                <h3>3. Your SSL Cert</h3>
                <button type="submit" class="btn btn-primary btn-lg">generate</button>
            </form>
        </div>
        <div class="col-sm-6">
            <div class="panel">
                Cert output goes here
            </div>
        </div>
    </div>
</div>

</body>
</html>
