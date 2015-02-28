<div class="container">
    <form  method="POST" action="<?= m_appurl('main/main/keygen') ?>">
    <div class="row">
        <div class="col-sm-6">
                <h3>1. Private Key Gen</h3>
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
    <form  method="POST" action="<?= m_appurl('main/main/keygen') ?>">
    <div class="row">
        <div class="col-sm-6">
                <h3>2. Certificate Sign Request (CSR)</h3>
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
                <div class=form-group">
                    <label>City/Locality
                    <input type="text" class="form-control" id="csr-city" name="csr-city" placeholder="...">
                    </label>
                </div>
                <div class=form-group">
                    <label>Organization
                    <input type="text" class="form-control" id="csr-org" name="csr-org" placeholder="Company Name">
                    </label>
                </div>
                <div class=form-group">
                    <label>Department / Unit
                    <input type="text" class="form-control" id="csr-unit" name="csr-unit" placeholder="[optional]">
                    </label>
                </div>
                <div class=form-group">
                    <label>Domain or Common Name
                    <input type="text" class="form-control" id="csr-dom" name="csr-dom" placeholder="example.com">
                    </label>
                </div>
        </div>
        <div class="col-sm-6">
            <div class="panel outputpanel">
                CSR output goes here
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6">
                <h3>3. Your SSL Cert</h3>
                <button type="submit" class="btn btn-primary btn-lg">generate</button>
        </div>
        <div class="col-sm-6">
            <div class="panel outputpanel">
                Cert output goes here
            </div>
        </div>
    </div>
    </form>
</div>


