$url = 'http://guesthouse.cupumanik-local.com';

$(document)
		.ready(
				function() {
					$('#loginbox').modal({
						backdrop : 'static',
						keyboard : false
					});

					/* LOGINBOX ALERTS */
					$('#alertdanger').hide();
					$('#alertsuccess').hide();
					$('#alertwait').hide();

					/* MAIN WINDOW ALERTS */
					$('#warningcontainer').hide();
					$('#admin-content').hide();

					/* ROOM ALERTS */
					$('#roomdanger').hide();
					$('#roomsuccess').hide();
					$('#roomwait').hide();

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
												
												/*LOAD DATA*/
												getRooms();
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

					$('#addroom').click(function() {
						clearAddRoomFields();
						getCategoriesAndShowRoomModal();
					})

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

										/* LOAD DATA */
										getRooms();
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

					$('#addroomform').on('submit', function(e) {
						addRooms();
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

/* start ROOMS/HOUSES */

function clearAddRoomFields() {
	$('#addroomform').trigger('reset');
	$('#addroombtn').html(
			'<span class="glyphicon glyphicon-plus">&nbsp;</span>Tambah Kamar');
	$('#addRoomModalLabel').html('Tambah Kamar/Rumah');
	$('#selectedRoomId').val('');
}

function getCategoriesAndShowRoomModal() {
	$('#warningcontainer')
			.html(
					'<strong>Memuat daftar kategori... </strong><img src="../../assets/ajax-loader.gif" />');
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getCategories.php', true);
	xmlhr.onerror = function(e) {
		$('#warningcontainer')
				.html(
						'<strong>Terjadi kesalahan saat memuat kategori! Silakan refresh halaman ini jika kesalahan tetap terjadi atau hubungi administrator.</strong>');
	}
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				if (xmlhr.responseText) {
					$('#categorylistdiv').html(xmlhr.responseText);
					$('#warningcontainer').hide();
					$('#roombox').modal('show');
				}
			}
		}
	};
	var data = new FormData();
	xmlhr.send(data);
	$('#warningcontainer').show();
}

function getCategoriesWithSelectedItem(id) {
	$('#warningcontainer')
			.html(
					'<strong>Memuat daftar kategori... </strong><img src="../../assets/ajax-loader.gif" />');
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getCategories.php', true);
	xmlhr.onerror = function(e) {
		$('#warningcontainer')
				.html(
						'<strong>Terjadi kesalahan saat memuat kategori! Silakan refresh halaman ini jika kesalahan tetap terjadi atau hubungi administrator.</strong>');
	}
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				if (xmlhr.responseText) {
					$('#categorylistdiv').html(xmlhr.responseText);
					$('select#categorylist option').each(function() {
						this.selected = (this.value == id);
					});
					$('#warningcontainer').hide();
					$('#roombox').modal('show');
				}
			}
		}
	};
	var data = new FormData();
	xmlhr.send(data);
	$('#warningcontainer').show();
}

function addRooms() {
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/addRoom.php', true);
	xmlhr.onerror = function(e) {
		$('#roomdanger').show();
		$('#roomdangermessage')
				.html(
						'Gagal menambahkan kamar/rumah. Ulangi menyimpan atau kontak administrator apabila terjadi kesalahan yang sama.');
	}
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				if (xmlhr.responseText == true) {
					/* POST ADDING */
					$('#roomwait').hide();
					clearAddRoomFields();
					getRooms();
					$('#roombox').modal('hide');
				}
			}
		}
	};
	var data = new FormData();
	data.append('roomname', $('#roomNameTb').val());
	data.append('description', $('#deskripsiTb').val());
	data.append('categoryid', $('#categorylist option:selected').val());
	if ($('#selectedRoomId').val() !== '') {
		data.append('roomid', $('#selectedRoomId').val());
	}

	xmlhr.send(data);
	$('#roomwait').show();
}

function editRoom(id) {
	$('#warningcontainer')
			.html(
					'<strong>Memuat data kamar/rumah... </strong><img src="../../assets/ajax-loader.gif" />');
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getRoomById.php', true);
	xmlhr.onerror = function(e) {
		$('#warningcontainer').show();
		$('#warningcontainer')
				.html(
						'Gagal menambahkan kamar/rumah. Ulangi menyimpan atau kontak administrator apabila terjadi kesalahan yang sama.');
	}
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				$obj = JSON.parse(xmlhr.responseText);
				$('#selectedRoomId').val($obj.roomid);
				getCategoriesWithSelectedItem($obj.categoryid);
				$('#roomNameTb').val($obj.roomname);
				$('#deskripsiTb').val($obj.description);

				/* POST GETTING DATA */
				$('#warningcontainer').hide();
				$('#addroombtn')
						.html(
								'<span class="glyphicon glyphicon-ok">&nbsp;</span>Ubah Kamar');
				$('#addRoomModalLabel').html(
						'Ubah Rumah/Kamar: ' + $obj.roomname);
			}
		}
	};
	var data = new FormData();
	data.append('roomid', id);
	xmlhr.send(data);
	$('#warningcontainer').show();
}

function deleteRoom(id, ordercount) {
	if (ordercount > 0) {
		$('#warningcontainer').show();
		$('#warningcontainer')
				.html(
						'<p class="alert alert-danger"><span class="glyphicon glyphicon-remove-circle"></span>Tidak bisa menghapus kamar/rumah yang terkait dengan pemesanan.</p>');
	} else {
		if (confirm('Yakin Anda akan menghapus kamar/rumah ini?')) {
			$('#warningcontainer')
					.html(
							'<strong>Menghapus data kamar/rumah... </strong><img src="../../assets/ajax-loader.gif" />');
			var xmlhr = new XMLHttpRequest();
			xmlhr.open('POST', $url + '/functions/removeRoom.php', true);
			xmlhr.onerror = function(e) {
				$('#warningcontainer').show();
				$('#warningcontainer')
						.html(
								'Gagal menghapus kamar/rumah. Ulangi menyimpan atau kontak administrator apabila terjadi kesalahan yang sama.');
			}
			xmlhr.onload = function(e) {
				if (xmlhr.readyState == 4) {
					if (xmlhr.status == 200) {
						if (xmlhr.responseText == true) {
							/* POST DELETING */
							$('#warningcontainer').hide();
							getRooms();
						}
					}
				}
			};
			var data = new FormData();
			data.append('roomid', id);
			xmlhr.send(data);
			$('#warningcontainer').show();
		}
	}
}

function getRooms() {
	$('#warningcontainer')
			.html(
					'<strong>Memuat daftar kamar/rumah... </strong><img src="../../assets/ajax-loader.gif" />');
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getRooms.php', true);
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				if (xmlhr.responseText) {
					$('#roomslist').html(xmlhr.responseText);
					$('#warningcontainer').hide();
				}
			}
		}
	};
	var data = new FormData();
	xmlhr.send(data);
	$('#warningcontainer').show();
}

/* end ROOMS/HOUSES */

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
