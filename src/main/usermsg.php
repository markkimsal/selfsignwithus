<?php

Class Main_Usermsg {


	public function template($response) {
		$msg = $response->get('sparkmsg');
		if (count($msg)) {
			echo '
<div class="container">
';
			foreach ($msg as $_m) {
				$_type =  $_m['type'];
				if ($_type == 'warn') {
					$_type = 'warning';
				}
				echo '  <div class="alert alert-'.$_type.' alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><p>'.$_m['msg'].'</p></div>';
			}
			echo '
</div>
';
		}
	}
}
