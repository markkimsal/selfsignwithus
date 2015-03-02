    <form  method="POST" action="<?= m_appurl('main/main/keygen') ?>">
    <div class="row">
        <div class="col-sm-6">
                <h3>1. Private Root Key</h3>
                <div class=form-group">
                    <label>Strength
                    <select class="form-control" id="keygen-bits" name="keygen-bits">
                    <option value="1024">1024</option>
                    <option value="2048" selected="selected">2048</option>
                    </select>
                    </label>
				    <label>Type
                    <select class="form-control" id="keygen-type" name="keygen-type">
                    <option value="dsa">dsa</option>
                    <option value="rsa" selected="selected">rsa</option>
                    </select>
                    </label>
				    <label>Expires after
                    <select class="form-control" id="keygen-expire" name="keygen-expire">
                    <option value="1d">1 day</option>
                    <option value="2d">2 days</option>
                    <option value="7d">7 days</option>
                    <option value="30d">30 days</option>
                    <option value="1y">1 year</option>
                    <option value="2y" selected="selected">2 year</option>
                    <option value="3y">3 year</option>
                    <option value="4y">4 year</option>
                    <option value="5y">5 year</option>
                    <option value="7y">7 year</option>
                    <option value="10y">10 year</option>
                    </select>
                    </label>
                </div>
        </div>
        <div class="col-sm-6">
            <div class="panel outputpanel panel-default">
				<div class="panel-heading">
					<h5 class="panel-title">Start by generating a new private key</h5>
				</div>
				<div class="panel-body">
					<button type="submit" class="btn btn-primary">generate</button>
				</div>
            </div>

<!--
            <div class="panel outputpanel panel-success">
				<div class="panel-heading"><h5 class="panel-title">Success</h5>
				</div>
				<div class="panel-body">
					<div class="btn-group">
						<button type="button" class="btn btn-primary">Download Private Key</button>
					</div>
					<?php if (isset($response->keygen)): ?>
						<?php echo $response->keygen[0] ?>
					<?php endif; ?>
				</div>
            </div>
-->
        </div>

    </div>
    </form>
    <form  method="POST" action="<?= m_appurl('main/csr') ?>">
    <div class="row">
        <div class="col-sm-6">
                <h3>2. Signed Root Certificate</h3>
<!--
                <div class=form-group">
                    <label>Country
                    <input type="text" class="form-control" id="csr-country" name="csr-country" placeholder="UK, CA, US, ...">
                    </label>
                </div>
                <div class=form-group">
                    <label>State/Province
                    <input type="text" class="form-control" id="csr-state" name="csr-state" placeholder="...">
                    </label>
                </div>
-->
<!--
                <div class=form-group">
                    <label>City/Locality
                    <input type="text" class="form-control" id="csr-city" name="csr-city" placeholder="...">
                    </label>
                </div>
-->
                <div class=form-group">
                    <label>Your Name
                    <input type="text" class="form-control" id="csr-cn" name="csr-cn" placeholder="Issuer Name" value="Self Sign With Us CA">
                    </label>
                </div>
                <div class=form-group">
                    <label>Organization
                    <input type="text" class="form-control" id="csr-org" name="csr-org" placeholder="Company Name" value="Self Sign With Us">
                    </label>
                </div>
<!--
                <div class=form-group">
                    <label>Department / Unit
                    <input type="text" class="form-control" id="csr-unit" name="csr-unit" placeholder="[optional]">
                    </label>
                </div>
-->
        </div>
        <div class="col-sm-6">
            <div class="panel outputpanel panel-default">
            <div class="panel-heading">
                <h5 class="panel-title">Sign Your Root Certificate</h5>
            </div>
            <div class="panel-body">
                <button type="submit" class="btn btn-primary">generate</button>
            </div>
            </div>
        </div>
    </div>
    </form>

    <form  method="POST" action="<?= m_appurl('main/cert') ?>">
    <div class="row">
        <div class="col-sm-6">
                <h3>3. Your SSL Cert</h3>
                <div class=form-group">
                    <label>Organization Name
                    <input type="text" class="form-control" id="cert-org" name="cert-org" placeholder="Example Inc">
                    </label>
                </div>
                <div class=form-group">
                    <label>Domain or Common Name
                    <input type="text" class="form-control" id="cert-dom" name="cert-dom" placeholder="example.com">
                    </label>
                </div>
        </div>
        <div class="col-sm-6">

         <div class="panel outputpanel panel-default">
         <div class="panel-heading">
            <h5 class="panel-title">Generate and Sign a new SSL Cert</h5>
         </div>
         <div class="panel-body">
            <button type="submit" class="btn btn-primary">generate</button>
         </div>
            </div>
        </div>
    </div>
    </form>
