// Login
function Login() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#Login'));
	// Send ajax request
	$.ajax({
		url        : '/process?Login',
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
				setTimeout(function(){ window.location.href = 'login'; }, 2000);
			}
			// Alert
			$.toast(res[1],res[0]);
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
		url        : '/process?Register',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			console.log(r);
			return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function(){ window.location.href = 'panel'; }, 3000);
			} else if(res[0] == 'error') {
				setTimeout(function(){ window.location.href = 'register'; }, 2000);
			}
			// Alert
			$.toast(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

// Create Ticket
function CreateTicket() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#CreateTicket'));
	// Send ajax request
	$.ajax({
		url        : '/process?CreateTicket',
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
			Notify(res[1],res[0]);
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
		url        : '/process?AnswerTicket',
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
				Ticket(res[2]);
			}
			// Alert
			Notify(res[1],res[0]);
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
		url        : '/process?CloseTicket',
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
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Layer4 Attack */
function Layer4() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#Attack4'));
	// Send ajax request
	$.ajax({
		url        : '/process?Layer4',
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
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Layer7 Attack */
function Layer7() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#Attack7'));
	// Send ajax request
	$.ajax({
		url        : '/process?Layer7',
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
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Stop Attack */
function Stop(id) {
	// Create ajax form
	let formData = new FormData(document.querySelector('#Stop'+id));
	// Send ajax request
	$.ajax({
		url        : '/process?Stop&id='+id,
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
			Notify(res[1],res[0]);
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
	let formData = new FormData(document.querySelector('#StopAll'));
	// Send ajax request
	$.ajax({
		url        : '/process?StopAll',
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
			Notify(res[1],res[0]);
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
		url        : '/process?ChangePassword',
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
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Buy Plan */
function BuyPlan(id) {
	// Send ajax request
	$.ajax({
		url        : '/process?BuyPlan&planID='+id,
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() { window.location.replace("upgrade"); }, 1000);
			}
			// Alert
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Add Balance */
function AddBalance() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#AddBalanceF'));
	// Send ajax request
	$.ajax({
		url        : '/process?AddBalance',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			$('#cryptocoin').val("Select");
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				setTimeout(function() {
					window.location.replace("invoice?id="+res[2]);
				}, 2000);
			}
			// Alert
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Remove Api */
function ApiRemove(id) {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ApiRemove'+id));
	// Send ajax request
	$.ajax({
		url        : '/process?ApiRemove&id='+id,
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
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* NewApiAccess */
function NewApiAccess() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#NewApiAccess'));
	// Send ajax request
	$.ajax({
		url        : '/process?NewApiAccess',
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
					window.location.replace("api");
				}, 1000);
			}
			// Alert
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Nmap Tool */
function Tools_NMAP() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#NMAPForm'));
	// Change Result
	$('#results').val('/processing...');
	// Send ajax request
	$.ajax({
		url        : '/process?Tools_NMAP',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			// Result
			$('#results').val(res[2]);
			// Alert
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* GetProtection Tool */
function Tools_GetProtection() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#GetProtectionForm'));
	// Change Result
	$('#results').val('/processing...');
	// Send ajax request
	$.ajax({
		url        : '/process?Tools_GetProtection',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			// Result
			$('#results').val(res[2]);
			// Alert
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Ping Tool */
function Tools_Ping() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#PingForm'));
	// Change Result
	$('#results').val('/processing...');
	// Send ajax request
	$.ajax({
		url        : '/process?Tools_Ping',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			// Result
			$('#results').val(res[2]);
			// Alert
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* HTTP Tool */
function Tools_HTTP() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#HTTPForm'));
	// Change Result
	$('#results').val('/processing...');
	// Send ajax request
	$.ajax({
		url        : '/process?Tools_HTTP',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			// Result
			$('#results').val(res[2]);
			// Alert
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

// On click input

$('#username-login').on("keyup", function(e) {
    if (e.keyCode == 13) {
        Login();
    }
});

$('#password-login').on("keyup", function(e) {
    if (e.keyCode == 13) {
        Login();
    }
});

$('#username-register').on("keyup", function(e) {
    if (e.keyCode == 13) {
        Register();
    }
});

$('#password1-register').on("keyup", function(e) {
    if (e.keyCode == 13) {
        Register();
    }
});

$('#password2-register').on("keyup", function(e) {
    if (e.keyCode == 13) {
        Register();
        return false;
    }
});