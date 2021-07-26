<?php

if(!defined('allow')) {
   header("HTTP/1.0 404 Not Found");
}

if(!defined('f2fb13944d119855993e5f7cca43f0ea')) {
	die('Brate. Ne moze panel bez includes.php :P Sorri ali takva su pravila.');
}

class Alert {

	public function SaveAlert($msg_txt, $msg_mode) {
		if ($msg_mode == 'success') {
			$_SESSION['msg_success'] = $msg_txt;
		} else if ($msg_mode == 'error') {
			$_SESSION['msg_error'] = $msg_txt;
		} else if ($msg_mode == 'info') {
			$_SESSION['msg_info'] = $msg_txt;
		} else if ($msg_mode == 'warning') {
			$_SESSION['msg_warning'] = $msg_txt;
		} else {
			echo "Error.";
		}
	}

	public function PrintAlert() {
		//empty.
		$eAlert = '';

		if (isset($_SESSION['msg_success'])) {
			$eMSG = $_SESSION['msg_success'];

			$eAlert = '<script type="text/javascript">
			setTimeout(function(){ 
				toastr["success"]("'.$eMSG.'", "")
			});
		</script>';
		} else if (isset($_SESSION['msg_error'])) {
			$eMSG = $_SESSION['msg_error'];

			$eAlert = '<script type="text/javascript">
			setTimeout(function(){ 
				toastr["error"]("'.$eMSG.'", "")
			});
		</script>';
		} else if (isset($_SESSION['msg_info'])) {
			$eMSG = $_SESSION['msg_info'];

			$eAlert = '<script type="text/javascript">
			setTimeout(function(){ 
				toastr["info"]("'.$eMSG.'", "")
			});
		</script>';
		} else if (isset($_SESSION['msg_warning'])) {
			$eMSG = $_SESSION['msg_warning'];

			$eAlert = '<script type="text/javascript">
				setTimeout(function(){ 
					toastr["warning"]("'.$eMSG.'", "")
				});
			</script>';
		} else {
			$eMSG = "";
		}

		return $eAlert;
	}

	public function ASaveAlert($msg_txt, $msg_mode) {
		if ($msg_mode == 'success') {
			$_SESSION['msg_success'] = $msg_txt;
		} else if ($msg_mode == 'error') {
			$_SESSION['msg_error'] = $msg_txt;
		} else if ($msg_mode == 'info') {
			$_SESSION['msg_info'] = $msg_txt;
		} else if ($msg_mode == 'warning') {
			$_SESSION['msg_warning'] = $msg_txt;
		} else {
			echo "Error.";
		}
	}

	public function APrintAlert() {
		//empty.
		$eAlert = '';

		if (isset($_SESSION['msg_success'])) {
			$eMSG = $_SESSION['msg_success'];

			$eAlert = '<script type="text/javascript">
			setTimeout(function(){ 
				Notify("'.$eMSG.'", "success");
			});
		</script>';
		} else if (isset($_SESSION['msg_error'])) {
			$eMSG = $_SESSION['msg_error'];

			$eAlert = '<script type="text/javascript">
			setTimeout(function(){ 
				Notify("'.$eMSG.'", "error");
			});
		</script>';
		} else if (isset($_SESSION['msg_info'])) {
			$eMSG = $_SESSION['msg_info'];

			$eAlert = '<script type="text/javascript">
			setTimeout(function(){ 
				Notify("'.$eMSG.'", "info");
			});
		</script>';
		} else if (isset($_SESSION['msg_warning'])) {
			$eMSG = $_SESSION['msg_warning'];

			$eAlert = '<script type="text/javascript">
				setTimeout(function(){ 
					Notify("'.$eMSG.'", "warning");
				});
			</script>';
		} else {
			$eMSG = "";
		}

		return $eAlert;
	}

	public function RemoveAlert() {
		unset($_SESSION['msg_success']);
		unset($_SESSION['msg_error']);
		unset($_SESSION['msg_info']);
		unset($_SESSION['msg_warning']);
	}
}

?>
