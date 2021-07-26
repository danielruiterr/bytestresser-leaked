<?php

session_start();

define('allow', TRUE);
define('admin', TRUE);

include_once('../inc.php');

if ($Admin->IsLoged() == false) {
	$Alert->ASaveAlert('?', 'error');
	header('Location: /');
	die();
}

/* Answer Ticket */
if (isset($GET['AnswerTicket'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check Ticket ID
	$ticketID = (int) $Secure->SecureTxt($POST['tID']);

	// Check Message
	$Message = $Secure->SecureTxt($_POST['Message']);
	if (empty($Message)) {
		$rMsg = ['error', 'Message is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Save to DB;
	if (!($Support->answOnTicket($ticketID, '', $Admin->AdminData()['id'], $Message)) == false) {
		// Add status 'Open = Open';
		$Support->upStatusOnTicket($ticketID, '3');
		// Activity
		$Support->upActivityOnTicket($ticketID);
		// Alert
		$rMsg = ['success', 'Successfully Executed'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Close Ticket */
if (isset($GET['CloseTicket'])) {
	// Check Ticket ID
	$ticketID = (int) $Secure->SecureTxt($POST['tID']);

	// Save to DB;
	if (!($Support->upStatusOnTicket($ticketID, '0')) == false) {
		// Alert
		$rMsg = ['success', 'Successfully Executed'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Add News */
if (isset($GET['AddNews'])) {
	if($Admin->AdminData()['Type'] < 1) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check Title
	$Title 		= $Secure->AdminSecureTxt($_POST['title']);
	if (empty($Title)) {
		$rMsg = ['error', 'Title is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Message
	$Message 		= $Secure->AdminSecureTxt($_POST['message']);
	if (empty($Message)) {
		$rMsg = ['error', 'Message is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if (!($News->AddNews($Title, $Message)) == false) {
		$rMsg = ['success', 'Successfully Executed'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Change News */
if (isset($GET['ChangeNews'])) {
	if($Admin->AdminData()['Type'] < 1) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Title
	$Title 		= $Secure->AdminSecureTxt($_POST['title']);
	if (empty($Title)) {
		$rMsg = ['error', 'Title is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Message
	$Message 		= $Secure->AdminSecureTxt($_POST['message']);
	if (empty($Message)) {
		$rMsg = ['error', 'Message is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if (!($News->ChangeNews($Title, $Message, $id)) == false) {
		$rMsg = ['success', 'Successfully Executed'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Delete News */
if (isset($GET['DeleteNews'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	if($Admin->AdminData()['Type'] < 1) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

if (!($News->DeleteNews($id)) == false) {
		$rMsg = ['success', 'Successfully Executed'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Add Method */
if (isset($GET['AddMethod'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check Name
	$Name 		= $Secure->SecureTxt($_POST['name']);
	if (empty($Name)) {
		$rMsg = ['error', 'Name is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Layer
	$Layer 		= (int) $Secure->SecureTxt($POST['layer']);
	if (empty($Layer)) {
		$rMsg = ['error', 'Layer is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if(!($Layer) == 7 || !($Layer) == 4) {
		$rMsg = ['error', 'Invalid Layer.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Type
	$Type 		= (int) $Secure->SecureTxt($POST['type']);
	if (empty($Type)) {
		$rMsg = ['error', 'Type is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if(!($Type) == 1 || !($Type) == 2 || !($Type) == 3 || !($Type) == 4) {
		$rMsg = ['error', 'Invalid Type.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Premium
	$Premium 		=  $Secure->SecureTxt($POST['premium']);
	// if (empty($Premium)) {
	// 	$rMsg = ['error', 'Premium is empty.'];
    //     echo json_encode($rMsg);
    //     die();
	// }

	// if(!($Premium) == 0 || !($Premium) == 1) {
	// 	$rMsg = ['error', 'Invalid Premium.'];
    //     echo json_encode($rMsg);
    //     die();
	// }

	// Check Description
	$Description 		= $_POST['description'];
	if (empty($Description)) {
		$rMsg = ['error', 'Description is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Save to DB
	if (!($Methods->AddMethod($Name, $Layer, $Type, $Premium, $Description)) == false) {
		$rMsg = ['success', 'Successfully Executed'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Change Method */
if (isset($GET['ChangeMethod'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Name
	$Name 		= $Secure->SecureTxt($_POST['name']);
	if (empty($Name)) {
		$rMsg = ['error', 'Name is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Layer
	$Layer 		= (int) $Secure->SecureTxt($POST['layer']);
	if (empty($Layer)) {
		$rMsg = ['error', 'Layer is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if(!($Layer) == 7 || !($Layer) == 4) {
		$rMsg = ['error', 'Invalid Layer.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Type
	$Type 		= (int) $Secure->SecureTxt($POST['type']);
	if (empty($Type)) {
		$rMsg = ['error', 'Type is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if(!($Type) == 1 || !($Type) == 2 || !($Type) == 3 || !($Type) == 4) {
		$rMsg = ['error', 'Invalid Type.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Premium
	$Premium 		= (int) $Secure->SecureTxt($POST['premium']);
	// if (empty($Premium)) {
	// 	$rMsg = ['error', 'Premium is empty.'];
    //     echo json_encode($rMsg);
    //     die();
	// }

	// if(!($Premium) == 1 || !($Premium) == 0) {
	// 	$rMsg = ['error', 'Invalid Premium.'];
    //     echo json_encode($rMsg);
    //     die();
	// }

	// Check Description
	$Description 		= $Secure->SecureTxt($_POST['description']);
	if (empty($Description)) {
		$rMsg = ['error', 'Description is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if (!($Methods->ChangeMethod($Name, $Layer, $Type, $Premium, $Description, $id)) == false) {
		$rMsg = ['success', 'Successfully Executed'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Delete Method */
if (isset($GET['DeleteMethod'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if (!($Methods->DeleteMethod($id)) == false) {
		$rMsg = ['success', 'Successfully Executed'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Add Plan */
if (isset($GET['AddPlan'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check Name
	$Name 		= $Secure->SecureTxt($_POST['name']);
	if (empty($Name)) {
		$rMsg = ['error', 'Name is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Price
	$Price 		= (int) $Secure->SecureTxt($POST['price']);
	if (empty($Price)) {
		$rMsg = ['error', 'Price is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if($Price < 0 || $Price > 5000) {
		$rMsg = ['error', 'Invalid Price.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Attack Time
	$AttackTime 		= (int) $Secure->SecureTxt($POST['attacktime']);
	if (empty($AttackTime)) {
		$rMsg = ['error', 'Attack Time is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if($AttackTime < 0 || $AttackTime > 14400) {
		$rMsg = ['error', 'Invalid Attack Time.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Concurrents
	$Concurrents 		= (int) $Secure->SecureTxt($POST['concurrent']);
	if (empty($Concurrents)) {
		$rMsg = ['error', 'Concurrents is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if($Concurrents < 0 || $Concurrents > 50) {
		$rMsg = ['error', 'Invalid Concurrents.'];
        echo json_encode($rMsg);
        die();
	}

	// Check PPS
	$PPS 		= $Secure->SecureTxt($POST['pps']);
	if (empty($PPS)) {
		$rMsg = ['error', 'PPS is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check API
	$API 		= (int) $Secure->SecureTxt($POST['api']);
	if($API != 0 && $API != 1) {
		$rMsg = ['error', 'Invalid API.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Premium
	$Premium 		= (int) $Secure->SecureTxt($POST['premium']);
	if(!($Premium) == 0 && !($Premium) == 1) {
		$rMsg = ['error', 'Invalid Premium.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Layer 4
	$Layer4 		= (int) $Secure->SecureTxt($POST['l4']);
	if(!($Layer4) == 0 && !($Layer4) == 1) {
		$rMsg = ['error', 'Invalid Layer 4.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Layer 7
	$Layer7 		= (int) $Secure->SecureTxt($POST['l7']);
	if(!($Layer7) == 0 && !($Layer7) == 1) {
		$rMsg = ['error', 'Invalid Layer 7.'];
        echo json_encode($rMsg);
        die();
	}

	// Save to DB
	if (!($Plan->AddPlan($Name, $Price, $AttackTime, $Concurrents, $PPS, $API, $Premium, $Layer4, $Layer7)) == false) {
		$rMsg = ['success', 'Successfully Executed!'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error inserting in DB.'];
        echo json_encode($rMsg);
        die();
	}
}

/* Change Plan */
if (isset($GET['ChangePlan'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Name
	$Name 		= $Secure->SecureTxt($_POST['name']);
	if (empty($Name)) {
		$rMsg = ['error', 'Name is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Price
	$Price 		= (int) $Secure->SecureTxt($POST['price']);
	if (empty($Price)) {
		$rMsg = ['error', 'Price is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if($Price < 0 || $Price > 5000) {
		$rMsg = ['error', 'Invalid Price.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Attack Time
	$AttackTime 		= (int) $Secure->SecureTxt($POST['attacktime']);
	if (empty($AttackTime)) {
		$rMsg = ['error', 'Attack Time is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if($AttackTime < 0 || $AttackTime > 14400) {
		$rMsg = ['error', 'Invalid Attack Time.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Concurrents
	$Concurrents 		= (int) $Secure->SecureTxt($POST['concurrent']);
	if (empty($Concurrents)) {
		$rMsg = ['error', 'Concurrents is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if($Concurrents < 0 || $Concurrents > 50) {
		$rMsg = ['error', 'Invalid Concurrents.'];
        echo json_encode($rMsg);
        die();
	}

	// Check PPS
	$PPS 		= $Secure->SecureTxt($POST['pps']);
	if (empty($PPS)) {
		$rMsg = ['error', 'PPS is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check API
	$API 		= (int) $Secure->SecureTxt($POST['api']);
	if($API != 0 && $API != 1) {
		$rMsg = ['error', 'Invalid API.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Premium
	$Premium 		= (int) $Secure->SecureTxt($POST['premium']);
	if(!($Premium) == 0 && !($Premium) == 1) {
		$rMsg = ['error', 'Invalid Premium.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Layer 4
	$Layer4 		= (int) $Secure->SecureTxt($POST['l4']);
	if(!($Layer4) == 0 && !($Layer4) == 1) {
		$rMsg = ['error', 'Invalid Layer 4.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Layer 7
	$Layer7 		= (int) $Secure->SecureTxt($POST['l7']);
	if(!($Layer7) == 0 && !($Layer7) == 1) {
		$rMsg = ['error', 'Invalid Layer 7.'];
        echo json_encode($rMsg);
        die();
	}

	// Save to DB
	if (!($Plan->ChangePlan($Name, $Price, $AttackTime, $Concurrents, $PPS, $API, $Premium, $Layer4, $Layer7, $id)) == false) {
		$rMsg = ['success', 'Successfully Executed!'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error inserting in DB.'];
        echo json_encode($rMsg);
        die();
	}
}

/* Delete Plan */
if (isset($GET['DeletePlan'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// if (!($BlackList->DeleteBlackList($id)) == false) {
	// 	$rMsg = ['success', 'Successfully Executed'];
    //     echo json_encode($rMsg);
    //     die();
	// } else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	// }
}

/* Add BlackList */
if (isset($GET['AddBlackList'])) {
	if($Admin->AdminData()['Type'] < 1) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check Word
	$Word 		= $Secure->SecureTxt($_POST['word']);
	if (empty($Word)) {
		$rMsg = ['error', 'Word/Ip is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Expires
	$Expires 		= $Secure->SecureTxt($POST['expires']);
	if (empty($Expires)) {
		$rMsg = ['error', 'Expires is empty.'];
        echo json_encode($rMsg);
        die();
	}

	$date = new DateTime($Expires);
	$Expirestime = $date->getTimestamp();

	if ($Expirestime < time()) {
		$rMsg = ['error', 'Expires is lower than time now.'];
        echo json_encode($rMsg);
        die();
	}

	// Save to DB
	if (!($BlackList->AddBlackList($Word, $Expirestime)) == false) {
		$rMsg = ['success', 'Successfully Executed'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Change BlackList */
if (isset($GET['ChangeBlackList'])) {
	if($Admin->AdminData()['Type'] < 1) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Word
	$Word 		= $Secure->SecureTxt($_POST['word']);
	if (empty($Word)) {
		$rMsg = ['error', 'Word is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Expires
	$Expires 		= $Secure->SecureTxt($POST['expires']);
	if (empty($Expires)) {
		$rMsg = ['error', 'Expires is empty.'];
        echo json_encode($rMsg);
        die();
	}

	$date = new DateTime($Expires);
	$Expirestime = $date->getTimestamp();

	if (!($BlackList->ChangeBlackList($Word, $Expirestime, $id)) == false) {
		$rMsg = ['success', 'Successfully Executed'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Delete BlackList */
if (isset($GET['DeleteBlackList'])) {
	// Check csrf
	$csrf 		= @$Secure->SecureTxt($POST['_csrf']);
	if ($csrf != $csrftoken) {
		$rMsg = ['error', 'Token is expired!'];
        echo json_encode($rMsg);
        die();
	}

	if($Admin->AdminData()['Type'] < 1) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if (!($BlackList->DeleteBlackList($id)) == false) {
		$rMsg = ['success', 'Successfully Executed'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Add API */
if (isset($GET['AddAPI'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check Name
	$Name 		= $Secure->SecureTxt($_POST['name']);
	if (empty($Name)) {
		$rMsg = ['error', 'Name is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check IP
	$IP 		= $Secure->SecureTxt($POST['ip']);
	if (empty($IP)) {
		$rMsg = ['error', 'IP is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Link
	$Link 		= $Secure->SecureTxt($POST['link']);
	if (empty($Link)) {
		$rMsg = ['error', 'Link is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Layer
	$Layer 		= $Secure->SecureTxt($POST['layer']);
	if (empty($Layer)) {
		$rMsg = ['error', 'Layer is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if($Layer != 4) {
		if($Layer != 7) {
			$rMsg = ['error', 'Layer is invalid.'];
			echo json_encode($rMsg);
			die();
		}
	}

	// Check Slots
	$Slots 		= (int) $Secure->SecureTxt($POST['slots']);
	if (empty($Slots)) {
		$rMsg = ['error', 'Slots are empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Methods
	$Methods 		= $Secure->SecureTxt(implode("|",$POST['methods']));
	if(empty($Methods)) {
		$rMsg = ['error', 'Methods are empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Save to DB
	if (!($Api->AddAPI($Name, $IP, $Secure->encrypt($Link), $Layer, $Slots, $Methods)) == false) {
		$rMsg = ['success', 'Successfully Executed'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Change API */
if (isset($GET['ChangeAPI'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Name
	$Name 		= $Secure->SecureTxt($_POST['name']);
	if (empty($Name)) {
		$rMsg = ['error', 'Name is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check IP
	$IP 		= $Secure->SecureTxt($POST['ip']);
	if (empty($IP)) {
		$rMsg = ['error', 'IP is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Link
	$Link 		= $Secure->SecureTxt($POST['link']);
	if (empty($Link)) {
		$rMsg = ['error', 'Link is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Layer
	$Layer 		= (int) @$Secure->SecureTxt($POST['layer']);
	if (empty($Layer)) {
		$rMsg = ['error', 'Layer is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if($Layer != 4) {
		if($Layer != 7) {
			$rMsg = ['error', 'Layer is invalid.'];
			echo json_encode($rMsg);
			die();
		}
	}

	// Check Slots
	$Slots 		= (int) @$Secure->SecureTxt($POST['slots']);
	if (empty($Slots)) {
		$rMsg = ['error', 'Slots is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Methods
	$Methods 		= @$Secure->SecureTxt(implode("|", $POST['methods']));
	if(empty($Methods)) {
		$rMsg = ['error', 'Methods are empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Status
	$Status 		= (int) @$Secure->SecureTxt($POST['status']);

	if (!($Api->ChangeAPI($Name, $IP, $Secure->encrypt($Link), $Layer, $Slots, $Methods, $Status, $id)) == false) {
		$rMsg = ['success', 'Successfully Executed'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Delete API */
if (isset($GET['DeleteAPI'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if (!($Api->DeleteAPI($id)) == false) {
		$rMsg = ['success', 'Successfully Executed!'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Stop Attack */
if (isset($GET['Stop'])) {
	if($Admin->AdminData()['Type'] < 1) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check
	$ID = (int) @$Secure->SecureTxt($GET['id']);
	// Is valid Attack ID
	if (empty($ID)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if ($ALogs->LogsDataID($ID, 1)['stopped'] != 0) {
		$rMsg = ['error', 'This attack is stopped.'];
        echo json_encode($rMsg);
        die();
	}

	if ($ALogs->LogsDataID($ID, 1)['date'] + $ALogs->LogsDataID($ID, 1)['time'] < time()) {
		$rMsg = ['error', 'This attack is expired.'];
        echo json_encode($rMsg);
        die();
	}
	// Execute
	$Api->AdminStop($ID);
}

/* Change User */
if (isset($GET['ChangeUser'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Username
	$Username = $Secure->SecureTxt($_POST['username']);
	if (empty($Username)) {
		$rMsg = ['error', 'Username is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Plan
	$Plan = (int) @$Secure->SecureTxt($POST['plan']);

	// Check Expire
	$Expire = $Secure->SecureTxt($POST['expire']);
	if (empty($Expire)) {
		$Expire = 0;
	} else {
		// Calculate Expire
		$dateTime = new DateTime($Expire);
		$Expire = $dateTime->format('U');
	}

	// Check Money
	$Money = (int) $Secure->SecureTxt($POST['money']);

	// Check Status
	$Status = (int) $Secure->SecureTxt($POST['status']);

	// Check Seconds
	$Seconds = (int) $Secure->SecureTxt($POST['seconds']);

	// Check Concurrents
	$Concurrents = (int) $Secure->SecureTxt($POST['concurrents']);

	// Check Premium
	$Premium = (int) $Secure->SecureTxt($POST['premium']);

	// Check Turbo
	$Turbo = (int) $Secure->SecureTxt($POST['turbo']);

	// Check for Password Changing
	$newpw1 = $_POST['newpw1'];
	$newpw2 = $_POST['newpw2'];

	$AddonsUpdate = $Seconds."|".$Concurrents."|".$Premium."|".$Turbo;

	if(!empty($newpw1) || !empty($newpw2)) {
		if($newpw1 == $newpw2) {
			// Save to DB;
			$Admin->ChangeUser($id, $Username, $Plan, $Expire, $Money, $Status, $newpw1, $AddonsUpdate);
		} else {
			$rMsg = ['error', 'New passwords are not same.'];
			echo json_encode($rMsg);
			die();
		}
	} else {
		// Save to DB;
		$Admin->ChangeUser($id, $Username, $Plan, $Expire, $Money, $Status, '0', $AddonsUpdate);
	}
}

/* Delete User */
if (isset($GET['DeleteUser'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if (!($Admin->DeleteUser($id)) == false) {
		$rMsg = ['success', 'Successfully Executed!'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Add Admin */
if (isset($GET['AddAdmin'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check Username
	$Username 		= $Secure->SecureTxt($_POST['Username']);
	if (empty($Username)) {
		$rMsg = ['error', 'Username is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Type
	$Type 		= $Secure->SecureTxt($POST['Type']);
	if ($Type != 0 && $Type != 1 && $Type != 2) {
		$rMsg = ['error', 'Type is invalid.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Password
	$Password 		= $_POST['Password'];
	if (empty($Password)) {
		$rMsg = ['error', 'Password is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Save to DB
	if (!($Admin->AddAdmin($Username, $Password, $Type)) == false) {
		$rMsg = ['success', 'Successfully Executed'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Change Admin */
if (isset($GET['ChangeAdmin'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Username
	$Username 		= $Secure->SecureTxt($_POST['Username']);
	if (empty($Username)) {
		$rMsg = ['error', 'Username is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Type
	$Type 		= $Secure->SecureTxt($POST['Type']);
	if ($Type != 0 && $Type != 1 && $Type != 2) {
		$rMsg = ['error', 'Type is invalid.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Password
	$Password 		= $_POST['Password1'];
	$Password2 		= $_POST['Password2'];

	if($Password != $Password2) {
		$rMsg = ['error', 'Passwords are not same.'];
        echo json_encode($rMsg);
        die();
	}

	if (empty($Password)) {
		if (!($Admin->ChangeAdmin($Username, '0', $Type, $id)) == false) {
			$rMsg = ['success', 'Successfully Executed'];
			echo json_encode($rMsg);
			die();
		} else {
			$rMsg = ['error', 'Error'];
			echo json_encode($rMsg);
			die();
		}
	} else {
		if (!($Admin->ChangeAdmin($Username, $Password, $Type, $id)) == false) {
			$rMsg = ['success', 'Successfully Executed'];
			echo json_encode($rMsg);
			die();
		} else {
			$rMsg = ['error', 'Error'];
			echo json_encode($rMsg);
			die();
		}
	}
}

/* Delete Admin */
if (isset($GET['DeleteAdmin'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	if (!($Admin->DeleteAdmin($id)) == false) {
		$rMsg = ['success', 'Successfully Executed'];
        echo json_encode($rMsg);
        die();
	} else {
		$rMsg = ['error', 'Error'];
        echo json_encode($rMsg);
        die();
	}
}

/* Change Users API */
if (isset($GET['ChangeUsersAPI'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check api_key
	$api_key 		= $Secure->SecureTxt($POST['api_key']);
	if (empty($api_key)) {
		$rMsg = ['error', 'API Key is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check AttackTime
	$AttackTime 		= (int) $Secure->SecureTxt($POST['time']);
	if (empty($AttackTime)) {
		$rMsg = ['error', 'Attack Time is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Slots
	$Slots 		= (int) $Secure->SecureTxt($POST['slots']);
	if (empty($Slots)) {
		$rMsg = ['error', 'Slots are empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check Premium
	$Premium 		= (int) $Secure->SecureTxt($POST['premium']);
	if (empty($Premium)) {
		$rMsg = ['error', 'Premium is empty.'];
        echo json_encode($rMsg);
        die();
	}

	// Check whitelist
	$whitelist 		= $Secure->SecureTxt($POST['whitelist']);

	$Admin->ChangeApiAccess($id, $api_key, $AttackTime, $Slots, $Premium, $whitelist);
}

/* Delete Users API */
if (isset($GET['DeleteUsersAPI'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check ID
	$id 		= $Secure->SecureTxt($POST['id']);
	if (empty($id)) {
		$rMsg = ['error', 'ID is empty.'];
        echo json_encode($rMsg);
        die();
	}

	$Admin->DeleteUsersAPI($id);
}

/* Add Users Time */
if (isset($GET['AddTimeAllUsers'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check Time
	$Time 		= (int) $Secure->SecureTxt($GET['Time']);
	if (empty($Time)) {
		$rMsg = ['error', 'Time is empty.'];
        echo json_encode($rMsg);
        die();
	}

	$timeAdd = $Time * 86400;

	$Admin->AddTimeAllUsers($timeAdd);
}

/* Clear */
if (isset($GET['ClearEverything'])) {
	if($Admin->AdminData()['Type'] != 2) {
		$Alert->ASaveAlert('you are not permited.', 'error');
		header('Location: index.php');
		die();
	}

	// Check Type
	$Type 		= @$Secure->SecureTxt($GET['Type']);
	if (empty($Type)) {
		$rMsg = ['error', 'Types: attack_logs, blacklist, logs, news, payments, tickets, users_api'];
        echo json_encode($rMsg);
        die();
	}

	$Admin->ClearLogs($Type);
}

?>