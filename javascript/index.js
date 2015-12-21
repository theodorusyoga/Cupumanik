$url = 'http://localhost/Cupumanik';

$(document)
		.ready(
				function() {
					$('#loginbox').modal({
						backdrop: 'static',
						keyboard: false
					});
					$('#alertdanger').hide();
					$('#alertwarning').hide();
					$('#alertsuccess').hide();
					$('#alertwait').hide();
					$('#login').hide();
					$('#logout').hide();
					$('#warningcontainer').hide();
					check();
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
											} else {
												$('#alertdanger').show();
												$('#alertsuccess').hide();
											}
										} else {
											$('#alertdanger').show();
											$('#alertsuccess').hide();
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

					$('#logout')
							.click(
									function() {
										$('#warning')
												.html(
														'<strong>Mengeluarkan Anda dari administator... </strong><img src="../../assets/ajax-loader.gif" />');
										var xmlhr = new XMLHttpRequest();
										xmlhr
												.open(
														'POST',
														$url
																+ '/functions/logout.php',
														true);
										xmlhr.onload = function(e) {
											if (xmlhr.readyState == 4) {
												if (xmlhr.status == 200) {
													if (xmlhr.responseText == '1') {
														$('#loginbox').modal(
																'show');
														$('#login').show();
														$('#logout').hide();
														$('#warningcontainer').hide();
													}
												}
											}
										};
										var data = new FormData();
										xmlhr.send(data);
										$('#warningcontainer').show();
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
									} else {
										$('#loginbox').modal('hide');
										$('#login').hide();
										$('#logout').show();
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
				});
