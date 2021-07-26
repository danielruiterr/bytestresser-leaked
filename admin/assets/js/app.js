/* Answer Ticket */
function AnswerTicket() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#AnswerTicket'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?AnswerTicket',
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
					location.reload();
				}, 4000);
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

/* Close Ticket */
function CloseTicket() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#AnswerTicket'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?CloseTicket',
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
					window.location = 'ticket_list.php';
				}, 3000);
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

/* Add News */
function AddNews() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#AddNews'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?AddNews',
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
					window.location = 'news_list.php';
				}, 3000);
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

/* Change News */
function ChangeNews() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangeNews'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?ChangeNews',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			// Alert
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Delete News */
function DeleteNews() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangeNews'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?DeleteNews',
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
					window.location = 'news_list.php';
				}, 3000);
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

/* Add Method */
function AddMethod() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#AddMethod'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?AddMethod',
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
					window.location = 'method_list.php';
				}, 3000);
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

/* Change Method */
function ChangeMethod() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangeMethod'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?ChangeMethod',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			// Alert
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Delete Method */
function DeleteMethod() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangeMethod'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?DeleteMethod',
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
					window.location = 'method_list.php';
				}, 3000);
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

/* Add Plan */
function AddPlan() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#AddPlan'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?AddPlan',
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
					window.location = 'plan_list.php';
				}, 3000);
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

/* Change Plan */
function ChangePlan() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangePlan'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?ChangePlan',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			// Alert
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Delete Plan */
function DeletePlan() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangePlan'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?DeletePlan',
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
					window.location = 'plan_list.php';
				}, 3000);
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

/* Add BlackList */
function AddBlackList() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#AddBlackList'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?AddBlackList',
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
					window.location = 'blacklist_list.php';
				}, 3000);
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

/* Change BlackList */
function ChangeBlackList() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangeBlackList'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?ChangeBlackList',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			// Alert
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Delete BlackList */
function DeleteBlackList() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangeBlackList'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?DeleteBlackList',
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
					window.location = 'plan_list.php';
				}, 3000);
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

/* Add API */
function AddAPI() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#AddAPI'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?AddAPI',
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
					window.location = 'api_list.php';
				}, 3000);
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

/* Change API */
function ChangeAPI() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangeAPI'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?ChangeAPI',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			// Alert
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Delete API */
function DeleteAPI() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangeAPI'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?DeleteAPI',
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
					window.location = 'api_list.php';
				}, 3000);
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
	// Send ajax request
	$.ajax({
		url        : 'process.php?Stop&id='+id,
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			if (res[0] == 'success') {
				location.reload();
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

/* Change User */
function ChangeUser() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangeUser'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?ChangeUser',
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
					location.reload();
				}, 4000);
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

/* Delete User */
function DeleteUser() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangeUser'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?DeleteUser',
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
					window.location = 'user_list.php';
				}, 3000);
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

/* Add Admin */
function AddAdmin() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#AddAdmin'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?AddAdmin',
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
					window.location = 'admin_list.php';
				}, 3000);
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

/* Change Admin */
function ChangeAdmin() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangeAdmin'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?ChangeAdmin',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			// Alert
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Delete Admin */
function DeleteAdmin() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangeAdmin'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?DeleteAdmin',
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
					window.location = 'admin_list.php';
				}, 3000);
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

/* Change Users API */
function ChangeUsersAPI() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangeUsersAPI'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?ChangeUsersAPI',
		type       : 'POST',
		contentType: false,
		cache      : false,
		processData: false,
		data       : formData,
		success    : function (r) {
			// console.log(r);
			// return false;
			var res = JSON.parse(r);
			// Alert
			Notify(res[1],res[0]);
			return false;
		},
		error: function (err) {
			return false;
		}
	});
}

/* Delete Users API */
function DeleteUsersAPI() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#ChangeUsersAPI'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?DeleteUsersAPI',
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
					window.location = 'usersapi_list.php';
				}, 3000);
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

/* Clearer */
function Clearer() {
	// Create ajax form
	let formData = new FormData(document.querySelector('#Clearer'));
	// Send ajax request
	$.ajax({
		url        : 'process.php?ClearEverything',
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
					window.location = 'clearer.php';
				}, 3000);
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