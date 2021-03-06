// Functions
$(document).ready(function() {
    $("#Login > div.mt-3.d-grid > div > div:nth-child(1) > button").click(function(){
        Login();
    }); 

    $("#Register > div.mt-3.d-grid > div > div:nth-child(1) > button").click(function(){
        Register();
    }); 

    $("#Register > div:nth-child(5) > div > button").click(function(){
        CaptchaRegister();
    });

    $("#CreateTicket > div.card-body > div:nth-child(4) > div > div > button").click(function(){
        CaptchaTicket();
    });

    $("#Login > div:nth-child(4) > div > button").click(function(){
        CaptchaLogin();
    });

    $("#CreateTicket > div.card-footer.text-right > button").click(function(){
        CreateTicket();
    });

    $("#layout-wrapper > div.main-content > div > div > div > div.col-md-8 > div > div:nth-child(2) > div.p-3.chat-input-section > div > div.col-auto > button").click(function(){
        AnswerTicket();
    });

    $("#CloseTicket > div > button").click(function(){
        CloseTicket();
    });

    $("#Details4 > div.row > div:nth-child(1) > button").click(function(){
		$('#Details4 > div.row > div:nth-child(1) > button').html('<i class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i> Send Attack');
        StartLayer4();
    });

    $("#Details7 > div.row > div:nth-child(1) > button").click(function(){
		$('#Details7 > div.row > div:nth-child(1) > button').html('<i class="bx bx-hourglass bx-spin font-size-16 align-middle me-2"></i> Send Attack');
        StartLayer7();
    });

    $('#example1 > tbody > tr > td > form > button').click(function(event){
    	var jes = event.target;
		var ok = $(jes).parents('form').attr('id');
		var res = ok.split("Stop");
		Stop(res[1]);
    });

    $("#layout-wrapper > div.main-content > div > div > div:nth-child(2) > div.col-xl-7.col-lg-12.col-md-12 > div > div.card-header > div.card-options > div > div > div > button").click(function(){
        StopAll();
    });

    $("#layout-wrapper > div.main-content > div > div > div:nth-child(2) > div:nth-child(2) > div > div.card-footer.text-right > button").click(function(){
        ChangePassword();
    });

    $('#layout-wrapper > div.main-content > div > div > div.row.row-sm > div > div > div.card-body > div.text-center.plan-btn > form > button').click(function(event){
    	var jes = event.target;
		var ok = $(jes).parents('form').attr('id');
		var res = ok.split("Pay");
		Pay(res[1]);
    });

    $("#bl1 > div.form-group.text-right > div > div:nth-child(2) > button").click(function(){
        BlacklistMonthly();
    });

    $("#bl2 > div.form-group.text-right > div > div:nth-child(2) > button").click(function(){
        BlacklistLifeTime();
    });

    $("#layout-wrapper > div.main-content > div > div > div > div:nth-child(3) > div > div.card-body > div.form-group.text-right > div > div:nth-child(2) > button").click(function(){
        AddSeconds();
    });

    $("#layout-wrapper > div.main-content > div > div > div > div:nth-child(4) > div > div.card-body > div.form-group.text-right > div > div:nth-child(2) > button").click(function(){
        AddConcurrents();
    });

    $("#AddPremium > div > div > div:nth-child(2) > button").click(function(){
        AddPremium();
    });

    $("#AddTurbo > div > div > div:nth-child(2) > button").click(function(){
        AddTurbo();
    });

    $("#DepositS > div.text-center.mt-4 > button").click(function(){
        DepositS();
    });

    $("#DepositC > div.text-center.mt-4 > button").click(function(){
        DepositC();
    });

    $("#GenerateAPI > div.card-footer.text-right > button").click(function(){
        GenerateApi();
    });

    $('#layout-wrapper > div.main-content > div > div > div:nth-child(2) > div > div > div.card-body > div > table > tbody > tr > td:nth-child(6) > form > button').click(function(event){
    	var jes = event.target;
		var ok = $(jes).parents('form').attr('id');
		var res = ok.split("RemoveApi");
		RemoveApi(res[1]);
    });
});

// Layer7 Precheck
$('#precheck1').on('change', function(){
	if(this.checked)
	 {
		$('#AdvancedLayer7 > div:nth-child(2) > div:nth-child(2)').css({
			display: 'none'
		});

		$("#AdvancedLayer7 > div:nth-child(2) > div:nth-child(1)").addClass("col-12");
    }
});

$('#precheck0').on('change', function(){
	if(this.checked)
	 {
		$('#AdvancedLayer7 > div:nth-child(2) > div:nth-child(2)').css({
			display: 'block'
		});

		$("#AdvancedLayer7 > div:nth-child(2) > div:nth-child(1)").removeClass("col-12");
    }
});

// Layer7 Precheck
$('#AdvancedLayer7 > div:nth-child(1) > div:nth-child(1) > div:nth-child(3) > input').on('change', function(){
	if(this.checked)
	 {
		$('#AdvancedLayer7 > div:nth-child(3)').css({
			display: 'none'
		});
    }
});

$('#AdvancedLayer7 > div:nth-child(1) > div:nth-child(1) > div:nth-child(4) > input').on('change', function(){
	if(this.checked)
	 {
		$('#AdvancedLayer7 > div:nth-child(3)').css({
			display: 'block'
		});
    }
});

// Login
function Login() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#Login'));
	// Send ajax request
	$.ajax({
		url        : 'functions/Login',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function(){ window.location.href = 'home'; }, 2000);
			} else if(res[0] == 'error') {
				CaptchaLogin();
			}
			// Alert
			toastr[res[0]](res[1], '')
			// swal(res[0], res[1], res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

// Register
function Register() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#Register'));
	// Send ajax request
	$.ajax({
		url        : 'functions/Register',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function(){ window.location.href = 'login'; }, 3000);
			} else if(res[0] == 'error') {
				CaptchaRegister();
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

// Captcha Refresh
function CaptchaRegister() {
	// $('#CaptchaImg').html('request/captcha/');
	document.getElementById("CaptchaImg").src = "request/captcha/";
	return false;
}

// Captcha Refresh
function CaptchaTicket() {
	// $('#CaptchaImg').html('request/captcha/');
	document.getElementById("CaptchaImg").src = "../request/captcha/";
	return false;
}

// Captcha Refresh
function CaptchaLogin() {
	// $('#CaptchaImg').html('request/captcha/');
	document.getElementById("CaptchaImg").src = "request/captcha/";
	return false;
}

// Create Ticket
function CreateTicket() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#CreateTicket'));
	// Send ajax request
	$.ajax({
		url        : '../functions/CreateTicket',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function(){ window.location.replace("/support"); }, 1000);
			} else if(res[0] == 'error') {
				CaptchaTicket();
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Answer Ticket */
function AnswerTicket() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#AnswerTicket'));
	// Send ajax request
	$.ajax({
		url        : '../../functions/AnswerTicket',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function(){ location.reload(); }, 1000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

// Close Ticket
function CloseTicket() {
	// Close ajax form
	let formData = new FormData(document.querySelector('#CloseTicket'));
	// Send ajax request
	$.ajax({
		url        : '../../functions/CloseTicket',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function(){ window.location.replace("/support"); }, 1000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Layer4 Attack */
function StartLayer4() {
	// toastr['info']("Attack is prepairing.", "Info")
	// Create ajax form
	let formData = new FormData(document.querySelector('#Details4'));
	// Send ajax request
	$.ajax({
		url        : 'functions/StartLayer4',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() { location.reload(); }, 1000);
			}
			// Alert
			toastr[res[0]](res[1], '');
			$('#Details4 > div.row > div:nth-child(1) > button').html('Send Attack');
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

function IpPort() {
	var str = $("#address").val();
	var res = str.split(":");
	if(res[1] !== 'undefined') {
		$("#address").val(res[0]);
		$('#port').val(res[1]);
	}
}

/* Layer7 Attack */
function StartLayer7() {
	// toastr['info']("Attack is prepairing.", "Info")
	// Create ajax form
	let formData = new FormData(document.querySelector('#Details7'));
	// Send ajax request
	$.ajax({
		url        : 'functions/StartLayer7',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() { window.location.replace("hub"); }, 1000);
			}
			// Alert
			toastr[res[0]](res[1], '');
			$('#Details7 > div.row > div:nth-child(1) > button').html('Send Attack');
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Stop Attack */
function Stop(id) {
	// toastr['info']("Stop is prepairing.", "Info")
	// Create ajax form
	let formData = new FormData(document.querySelector('#Stop'+id));
	console.log(formData);
	// Send ajax request
	$.ajax({
		url        : 'functions/Stop',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() { window.location.reload(); }, 1000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Stop All Attacks */
function StopAll() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#Details7'));
	// Send ajax request
	$.ajax({
		url        : 'functions/StopAll',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() { window.location.reload(); }, 1000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Change Password */
function ChangePassword() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangePassword'));
	// Send ajax request
	$.ajax({
		url        : 'functions/ChangePassword',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() { window.location.replace("page"); }, 1000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Buy Plan */
function Pay(id) {
	// Create ajax form
	let formData = new FormData(document.querySelector('#Pay'+id));
	// Send ajax request
	$.ajax({
		url        : 'functions/Pay/'+id,
		type       : 'POST',
		contentType: false,
		cache      : false,
		data       : formData,
		processData: false,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() { window.location.reload(); }, 2000);
			}
			if (res[2] == 'true') {
				setTimeout(function() {
					window.location.reload();
				}, 2000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Buy Blacklist Monthly */
function BlacklistMonthly() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#bl1'));
	// Send ajax request
	$.ajax({
		url        : 'functions/BlacklistMonthly',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() { window.location.replace("shop"); }, 2000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Buy Blacklist Life Time */
function BlacklistLifeTime() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#bl2'));
	// Send ajax request
	$.ajax({
		url        : 'functions/BlacklistLifeTime',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() { window.location.replace("shop"); }, 2000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Buy Seconds */
function AddSeconds() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#addSeconds'));
	// Send ajax request
	$.ajax({
		url        : 'functions/AddSeconds',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() { window.location.replace("shop"); }, 2000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Buy Concurrents */
function AddConcurrents() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#addConcurrents'));
	// Send ajax request
	$.ajax({
		url        : 'functions/AddConcurrents',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() { window.location.replace("shop"); }, 2000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Buy Premium */
function AddPremium() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#AddPremium'));
	// Send ajax request
	$.ajax({
		url        : 'functions/AddPremium',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() { window.location.replace("shop"); }, 2000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Buy Turbo */
function AddTurbo() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#AddTurbo'));
	// Send ajax request
	$.ajax({
		url        : 'functions/AddTurbo',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() { window.location.replace("shop"); }, 2000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Add Balance */
function DepositS() {
	// toastr['info']("Invoice is prepairing.", "Info")
	// Create ajax form
	let formData = new FormData(document.querySelector('#DepositS'));
	// Send ajax request
	$.ajax({
		url        : 'functions/Deposit',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() {
					window.location.replace("invoice/"+res[2]);
				}, 2000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Add Balance */
function DepositC() {
	// toastr['info']("Invoice is prepairing.", "Info")
	// Create ajax form
	let formData = new FormData(document.querySelector('#DepositC'));
	// Send ajax request
	$.ajax({
		url        : 'functions/Deposit',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() {
					window.location.replace("invoice/"+res[2]);
				}, 2000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

// /* Cancel Invoice */
// function CancelInvoice() {
// 	// Create ajax form
// 	let formData = new FormData(document.querySelector('#CancelInvoice'));
// 	// Send ajax request
// 	$.ajax({
// 		url        : 'functions/CancelInvoice',
// 		type       : 'POST',
// 		contentType: false,
// 		cache      : false,
// 		processData: false,
// 		data       : formData,
// 		success    : function (r) {
// 			// console.log(r);
// 			// return false;
// 			var res = JSON.parse(r);
// 			if (res[0] == 'success') {
// 				setTimeout(function() { window.location.replace("home"); }, 1000);
// 			}
// 			// Alert
// 			toastr[res[0]](res[1], '')
// 			return false;
// 		},
// 		error: function (err) {
// 			return false;
// 		}
// 	});
// }

/* Remove Api */
function RemoveApi(id) {
	// Create ajax form
	let formData = new FormData(document.querySelector('#RemoveApi'+id));
	// Send ajax request
	$.ajax({
		url        : 'functions/RemoveApi/'+id,
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() { window.location.replace("api"); }, 1000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* GenerateAPI */
function GenerateApi() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#GenerateAPI'));
	// Send ajax request
	$.ajax({
		url        : 'functions/GenerateAPI',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() {
					window.location.reload();
				}, 1000);
			}
			// Alert
			toastr[res[0]](res[1], '')
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

function AttackTimer(dateval, time, id){
	var downloadTimer = setInterval(function(){
		if(time <= 0){
			clearInterval(downloadTimer);
			$("#"+id).remove();
		} else {
			$("#countdown-" + dateval).html(new Date(time * 1000).toISOString().substr(11, 8));
		}
		time -= 1;
	}, 1000);
}

$(document).ready(function() {
    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
});

console.log('Application started!');