$url = 'http://guesthouse.cupumanik.id';
var monthNames = [ "Januari", "Februari", "Maret", "April", "Mei", "Juni",
		"Juli", "Agustus", "September", "Oktober", "November", "Desember" ];
$selectedcategoryid = 0;
$selectedorderid = 0;
$selectedroomid = 0;
$(document)
		.ready(
				function() {
					$('[data-toggle="tooltip"]').tooltip();
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

					/* RESERVATION ALERTS */
					$('#orderprogressbar').hide();
					$('#orderalert').hide();

					$('#start-date').datetimepicker({
						locale : 'id',
						sideBySide : true,
						format : 'YYYY/MM/D HH:mm'
					});
					$('#end-date').datetimepicker({
						locale : 'id',
						sideBySide : true,
						format : 'YYYY/MM/D HH:mm'
					});
					$('#start-date').on(
							'dp.change',
							function(e) {
								if ($selectedcategoryid != 0
										&& $selectedorderid != 0
										&& $selectedroomid != 0)
									getAvailableRooms($selectedcategoryid,
											$selectedorderid, $selectedroomid);
								$('#end-date').data('DateTimePicker').minDate(
										e.date);
							});

					$('#end-date').on(
							'dp.change',
							function(e) {
								if ($selectedcategoryid != 0
										&& $selectedorderid != 0
										&& $selectedroomid != 0)
									getAvailableRooms($selectedcategoryid,
											$selectedorderid, $selectedroomid);
							});
					$('#btn-submit').click(function() {
						acceptReservation();
					});

					$('#reservationlink').click(function() {
						$query = $('#sortParam option:selected').val();
						addRoomsDropDown();
						getReservations($query);
					});

					$('#roomlistlink').click(function() {
						getRooms();
					});

					check();

					/* EVENTS */

					$('#loginbtn')
							.click(
									function() {
										$('#alertwait').show();
										var xmlhr = new XMLHttpRequest();
										xmlhr.open('POST', $url
												+ '/functions/login.php', true);
										xmlhr.onload = function(e) {
											if (xmlhr.readyState == 4) {
												if (xmlhr.status == 200) {
													if (xmlhr.responseText == '1') {
														$('#alertdanger')
																.hide();
														$('#alertsuccess')
																.show();
														$('#loginbox').modal(
																'hide');
														$('#login').hide();
														$('#logout').show();
														$('#admin-content')
																.show();

														/* LOAD DATA */
														$query = $(
																'#sortParam option:selected')
																.val();
														getRooms();
														addRoomsDropDown();
														getReservations($query);
													} else {
														$('#alertdanger')
																.show();
														$('#alertsuccess')
																.hide();
														$('#admin-content')
																.hide();
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
										data.append('user', $('#usernameTb')
												.val());
										data.append('pass', $('#passwordTb')
												.val());
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
										$query = $('#sortParam option:selected')
												.val();
										getRooms();
										addRoomsDropDown();
										getReservations($query);
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

					$('#sortParam').on('change', function() {
						$query = $('#sortParam option:selected').val();
						getReservations($query);
					});

					$('#sortform').on('submit', function(e) {
						$query = $('#sortParam option:selected').val();
						getReservations($query);
						e.preventDefault();
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
						'Gagal mengubah kamar/rumah. Ulangi menyimpan atau kontak administrator apabila terjadi kesalahan yang sama.');
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
	xmlhr.onerror = function(e) {
		$('#warningcontainer')
				.html(
						'<strong>Terjadi kesalahan saat memuat kamar/rumah! Silakan refresh halaman ini jika kesalahan tetap terjadi atau hubungi administrator.</strong>');
	}
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

function addRoomsDropDown() {
	$('#warningcontainer')
			.html(
					'<strong>Memuat daftar kamar/rumah... </strong><img src="../../assets/ajax-loader.gif" />');
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getRoomsAsDropDown.php', true);
	xmlhr.onerror = function(e) {
		$('#warningcontainer')
				.html(
						'<strong>Terjadi kesalahan saat memuat kamar/rumah! Silakan refresh halaman ini jika kesalahan tetap terjadi atau hubungi administrator.</strong>');
	}
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				if (xmlhr.responseText) {
					$('#daftarKamarFilter').html(xmlhr.responseText);
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

/* start RESERVATIONS */

function getReservations(filterQuery) {
	$('#warningcontainer')
			.html(
					'<strong>Memuat daftar pemesanan... </strong><img src="../../assets/ajax-loader.gif" />');
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getReservations.php', true);
	xmlhr.onerror = function(e) {
		$('#warningcontainer')
				.html(
						'<strong>Terjadi kesalahan saat memuat pemesanan! Silakan refresh halaman ini jika kesalahan tetap terjadi atau hubungi administrator.</strong>');
	}
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				$('#reservationcontent').html(xmlhr.responseText);
				$('#warningcontainer').hide();
			}
		}
	};
	var data = new FormData();
	data.append('query', filterQuery);
	data.append('search', $('#cariTb').val());
	xmlhr.send(data);
	$('#warningcontainer').show();
}

function detailReservasi(id) {
	$selectedcategoryid = 0;
	$selectedorderid = 0;
	$selectedroomid = 0;
	$('#warningcontainer')
			.html(
					'<strong>Memuat data pemesanan... </strong><img src="../../assets/ajax-loader.gif" />');
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getSingleReservation.php', true);
	xmlhr.onerror = function(e) {
		$('#warningcontainer')
				.html(
						'<strong>Terjadi kesalahan saat membuka detail pemesanan! Silakan refresh halaman ini jika kesalahan tetap terjadi atau hubungi administrator.</strong>');
	}
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				$obj = JSON.parse(xmlhr.responseText);
				$('#jenis-pemesanan').text($obj.categoryname);
				$('#customer-name').text($obj.name);
				$('#customer-address').text($obj.address);
				$('#customer-phone').text($obj.phone);
				$('#customer-email').text($obj.email);
				$('#customer-note').text($obj.info);
				var reservedate = new Date($obj.reservationdate);
				$('#customer-reservation-date').text(
						reservedate.getDate() + ' '
								+ monthNames[reservedate.getMonth()] + ' '
								+ reservedate.getFullYear() + ' '
								+ reservedate.getHours() + ':'
								+ reservedate.getMinutes());

				/* DATE RELATED */
				while ($obj.startdate.indexOf('-') > -1)
					$obj.startdate = $obj.startdate.replace('-', '/');
				while ($obj.enddate.indexOf('-') > -1)
					$obj.enddate = $obj.enddate.replace('-', '/');
				
				var startdate = new Date($obj.startdate);
				var enddate = new Date($obj.enddate);
				$('#start-date').data('DateTimePicker').date(startdate);
				$('#end-date').data('DateTimePicker').date(enddate);
				$('#end-date').data('DateTimePicker').minDate(startdate);
				$selectedcategoryid = $obj.categoryid;
				$selectedorderid = $obj.orderid;
				$selectedroomid = $obj.roomid;
				getAvailableRoomsInitial($selectedcategoryid, $selectedorderid,
						$selectedroomid);
				if ($obj.isapproved == true) {
					$('#btn-submit').hide();
					$('#start-date-input').attr('disabled', true);
					$('#end-date-input').attr('disabled', true);
					$('#pilihKamarDetail').attr('disabled', true);

				} else {
					$('#btn-submit').show();
					$('#start-date-input').removeAttr('disabled');
					$('#end-date-input').removeAttr('disabled');
					$('#pilihKamarDetail').removeAttr('disabled');
				}

				$('#order-modal').modal('show');
				$('#warningcontainer').hide();

			}
		}
	};
	var data = new FormData();
	data.append('id', id);
	xmlhr.send(data);
	$('#warningcontainer').show();
}

function hapusReservasi(id) {
	if (confirm('Yakin akan menghapus pemesanan ini?')) {
		$selectedcategoryid = 0;
		$selectedorderid = 0;
		$selectedroomid = 0;
		$('#warningcontainer')
				.html(
						'<strong>Menghapus pemesanan... </strong><img src="../../assets/ajax-loader.gif" />');
		var xmlhr = new XMLHttpRequest();
		xmlhr.open('POST', $url + '/functions/removeReservation.php', true);
		xmlhr.onerror = function(e) {
			$('#warningcontainer')
					.html(
							'<strong>Terjadi kesalahan saat menghapus pemesanan! Silakan refresh halaman ini jika kesalahan tetap terjadi atau hubungi administrator.</strong>');
		}
		xmlhr.onload = function(e) {
			if (xmlhr.readyState == 4) {
				if (xmlhr.status == 200) {
					if (xmlhr.responseText == true) {
						$query = $('#sortParam option:selected').val();
						getReservations($query);
						$('#warningcontainer').hide();
					} else
						$('#warningcontainer')
								.html(
										'<strong>Terjadi kesalahan saat menghapus pemesanan! Silakan refresh halaman ini jika kesalahan tetap terjadi atau hubungi administrator.</strong>');
				}
			}
		};
		var data = new FormData();
		data.append('orderid', id);
		xmlhr.send(data);
		$('#warningcontainer').show();
	}
}

function getAvailableRooms(categoryId, orderId, roomId) {
	$('#orderalert')
			.html(
					'<strong>Memuat kamar/rumah tersedia... </strong><img src="../../assets/ajax-loader.gif" />');
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getAvailableRoomsInitial.php', true);
	xmlhr.onerror = function(e) {
		$('#orderalert')
				.html(
						'<strong>Terjadi kesalahan saat mencari kamar/rumah tersedia! Silakan refresh halaman ini jika kesalahan tetap terjadi atau hubungi administrator.</strong>');
	}
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				$('#pilihKamarDetail').html(xmlhr.responseText);
				$('#orderalert').hide();

			}
		}
	};
	var data = new FormData();
	data.append('startdate', $('#start-date-input').val());
	data.append('enddate', $('#end-date-input').val());
	data.append('selectedcat', categoryId);
	data.append('orderid', orderId);
	xmlhr.send(data);
	$('#orderalert').show();
}

function getAvailableRoomsInitial(categoryId, orderId, roomId) {
	$('#orderalert')
			.html(
					'<strong>Memuat kamar/rumah tersedia... </strong><img src="../../assets/ajax-loader.gif" />');
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getAvailableRoomsInitial.php', true);
	xmlhr.onerror = function(e) {
		$('#orderalert')
				.html(
						'<strong>Terjadi kesalahan saat mencari kamar/rumah tersedia! Silakan refresh halaman ini jika kesalahan tetap terjadi atau hubungi administrator.</strong>');
	}
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				$('#pilihKamarDetail').html(xmlhr.responseText);
				$('select#pilihKamarDetail option').each(function() {
					this.selected = (this.value == roomId);
				});
				$('#orderalert').hide();

			}
		}
	};
	var data = new FormData();
	data.append('startdate', $('#start-date-input').val());
	data.append('enddate', $('#end-date-input').val());
	data.append('selectedcat', categoryId);
	data.append('orderid', orderId);
	xmlhr.send(data);
	$('#orderalert').show();
}

function acceptReservation() {
	if (confirm('Yakin menerima pemesanan ini? Tanggal dan kamar/rumah tidak dapat diubah setelah diterima!')) {
		$('#orderalert')
				.html(
						'<strong>Menerima pemesanan... </strong><img src="../../assets/ajax-loader.gif" />');
		var xmlhr = new XMLHttpRequest();
		xmlhr.open('POST', $url + '/functions/acceptReservation.php', true);
		xmlhr.onerror = function(e) {
			$('#orderalert')
					.html(
							'<strong>Terjadi kesalahan saat menerima pemesanan! Silakan refresh halaman ini jika kesalahan tetap terjadi atau hubungi administrator.</strong>');
		}
		xmlhr.onload = function(e) {
			if (xmlhr.readyState == 4) {
				if (xmlhr.status == 200) {
					if (xmlhr.responseText == true) {
						$query = $('#sortParam option:selected').val();
						getReservations($query);
						$('#orderalert')
								.html(
										'<span class="glyphicon glyphicon-ok">&nbsp;</span>Pemesanan telah diterima. Tunggu jendela ini menutup...');
						var interval = setInterval(function() {
							$('#order-modal').modal('hide');
							clearInterval(interval);
						}, 3000);
					}
				}
			}
		};
		var data = new FormData();
		data.append('startdate', $('#start-date-input').val());
		data.append('enddate', $('#end-date-input').val());
		data.append('orderid', $selectedorderid);
		data.append('roomid', $('#pilihKamarDetail option:selected').val());
		xmlhr.send(data);
		$('#orderalert').show();
	}
}

/* END RESERVATIONS */

function logout() {
	$('#warningcontainer')
			.html(
					'<strong>Mengeluarkan Anda dari administrator... </strong><img src="../../assets/ajax-loader.gif" />');
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/logout.php', true);
	xmlhr.onerror = function(e) {
		$('#warningcontainer')
				.html(
						'<strong>Terjadi kesalahan saat mengeluarkan Anda dari administrator! Silakan refresh halaman ini jika kesalahan tetap terjadi atau hubungi administrator.</strong>');
	}
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
