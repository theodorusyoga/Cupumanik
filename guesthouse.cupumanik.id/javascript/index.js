$url = 'http://guesthouse.cupumanik-local.com';

$(document)
		.ready(
				function() {
					$('#loginbox').modal({
						backdrop : 'static',
						keyboard : false
					});
					$('#alertdanger').hide();
					$('#alertsuccess').hide();
					$('#alertwait').hide();
					$('#warningcontainer').hide();
					$('#admin-content').hide();
					check();

					/* EVENTS */

					$('#loginbtn').click(
							function() {
								$('#alertwait').show();
								var xmlhr = new XMLHttpRequest();
								xmlhr.open('POST', $url
										+ '/functions/login.php', true);
								xmlhr.onload = function(e) {
									if (xmlhr.readyState == 4) {
										if (xmlhr.status == 200) {
											if (xmlhr.responseText == '1') {
												$('#alertdanger').hide();
												$('#alertsuccess').show();
												$('#loginbox').modal('hide');
												$('#login').hide();
												$('#logout').show();
												$('#admin-content').show();
											} else {
												$('#alertdanger').show();
												$('#alertsuccess').hide();
												$('#admin-content').hide();
											}
										} else {
											$('#alertdanger').show();
											$('#alertsuccess').hide();
											$('#admin-content').hide();
										}
									}
									$('#alertwait').hide();
								};
								var data = new FormData();
								data.append('user', $('#usernameTb').val());
								data.append('pass', $('#passwordTb').val());
								xmlhr.send(data);
							});

					$('#login').click(function() {
						$('#loginbox').modal('toggle');
					});

					$('#logout').click(function() {
						logout();
					});

					function check() {
						var xmlhr = new XMLHttpRequest();
						xmlhr.open('POST', $url + '/functions/checklogin.php',
								true);
						xmlhr.onload = function(e) {
							if (xmlhr.readyState == 4) {
								if (xmlhr.status == 200) {
									$res = xmlhr.responseText;
									if ($res == false) {
										$('#loginbox').modal('show');
										$('#login').show();
										$('#logout').hide();
										$('#admin-content').hide();
									} else {
										$('#loginbox').modal('hide');
										$('#login').hide();
										$('#logout').show();
										$('#admin-content').show();
									}
								} else {
									$('#login').hide();
									$('#logout').show();
								}
							}
						};
						var data = new FormData();
						xmlhr.send(data);
					}

					$('#loginform').on('submit', function(e) {
						e.preventDefault();
					});

					$('#changepassform')
							.on(
									'submit',
									function(e) {
										if ($('#passwordBaruTb').val() === $(
												'#ulangPasswordBaruTb').val()) {
											changePassword();
										} else {
											$('#warningcontainer').show();
											$('#warningcontainer')
													.html(
															'<strong>Password baru yang Anda berikan tidak sama!</strong>');
										}

										e.preventDefault();
									});

					$('#filter').on('submit', function(e) {
						e.preventDefault();
						refreshFilteredProducts();

					});

				});

function logout() {
	$('#warningcontainer')
			.html(
					'<strong>Mengeluarkan Anda dari administrator... </strong><img src="../../assets/ajax-loader.gif" />');
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/logout.php', true);
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				if (xmlhr.responseText == '1') {
					$('#loginbox').modal('show');
					$('#login').show();
					$('#logout').hide();
					$('#warningcontainer').hide();
					$('#admin-content').hide();
				}
			}
		}
	};
	var data = new FormData();
	xmlhr.send(data);
	$('#warningcontainer').show();
}

function changePassword() {
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/changePassword.php', true);
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				if (xmlhr.responseText == true) {
					/* LOGOUT */
					$('#passwordLamaTb').val('');
					$('#passwordBaruTb').val('');
					$('#ulangPasswordBaruTb').val('');
					logout();
					$('#warningcontainer').hide();
				} else {
					$('#warningcontainer')
							.html(
									'<strong>Password lama Anda mungkin tidak sama dengan password saat ini.</strong>');
					$('#warningcontainer').show();
				}

			} else {
				alert(xmlhr.statusText);
			}
		}
	};
	var data = new FormData();
	data.append('old', $('#passwordLamaTb').val());
	data.append('new', $('#passwordBaruTb').val());
	xmlhr.send(data);
	$('#warningcontainer').show();
	$('#warningcontainer')
			.html(
					'<strong>Mengganti password administrator... </strong><img src="../../assets/ajax-loader.gif" />');
}
