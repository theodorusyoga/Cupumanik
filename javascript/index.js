$url = 'http://localhost/Cupumanik';

$(document)
		.ready(
				function() {
					$('#loginbox').modal({
						backdrop : 'static',
						keyboard : false
					});

					$('#alertdanger').hide();
					$('#alertwarning').hide();
					$('#detaildanger').hide();
					$('#detailwait').hide();
					$('#alertsuccess').hide();
					$('#alertwait').hide();
					$('#login').hide();
					$('#logout').hide();
					$('#warningcontainer').hide();
					$('#admin-content').hide();
					$('#imagewarning').hide();
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

					$('#logout')
							.click(
									function() {
										$('#warningcontainer')
												.html(
														'<strong>Mengeluarkan Anda dari administrator... </strong><img src="../../assets/ajax-loader.gif" />');
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
														$('#warningcontainer')
																.hide();
														$('#admin-content')
																.hide();
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

					$('#addproduct').click(function() {
						$('#formdetails').trigger('reset');
						$('#namaProdukTb').val('');
						$('#deskripsiTb').val('');
						$('#jumlahStokTb').val('');
						$('#hargaSatuanTb').val('');
						$('#uploadedimg').removeAttr('src');
						$('#tempid').val(null);
						$('#tambahProdukLabel').html('Tambah Produk');
						$('#detailsbox').modal({
							backdrop : 'static',
							keyboard : false
						});
						$('#detailsbox').modal('show');
					});

					$('#uploadFile')
							.change(
									function() {
										$('#imagewarning').hide();
										var file = this.files[0];
										var ext = file.type;
										var exts = [ 'image/jpeg', 'image/jpg' ];
										if (exts.indexOf(ext) >= 0) {
											var reader = new FileReader();
											reader.onload = function(e) {
												$('#uploadedimg').attr('src',
														e.target.result);
											};
											reader.readAsDataURL(this.files[0]);
										} else {
											$('#uploadedimg').removeAttr('src');
											$('#imagewarning').show();
											$('#imagewarning')
													.html(
															'<span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;Foto/gambar yang dimasukkan harus memiliki ekstensi JPEG/JPG');
										}
									});

					$('#loginform').on('submit', function(e) {
						e.preventDefault();
					});

					$('#formdetails')
							.on(
									'submit',
									function(e) {
										$namaproduk = $('#namaProdukTb').val();
										$cat = $(
												'#selectCategory option:selected')
												.val();
										$desc = $('#deskripsiTb').val();
										$stock = $('#jumlahStokTb').val();
										$price = $('#hargaSatuanTb').val();
										var xmlhr = new XMLHttpRequest();
										
										var data = new FormData(this);
										$func = '';
										if($('#tempid').val() == ''){
											$func = $url + '/functions/addProduct.php';
										}
										else{
											$func = $url + '/functions/updateProduct.php';
											data.append('id', $('#tempid').val());
										}
										data.append('title', $namaproduk);
										data.append('desc', $desc);
										data.append('stock', $stock);
										data.append('categoryid', $cat);
										data.append('price', $price);
										
										xmlhr.open('POST', $func,
												true);
										xmlhr.onload = function(e) {
											if (xmlhr.readyState == 4) {
												if (xmlhr.status == 200) {
													$res = xmlhr.responseText;
													if ($res == true) {
														refreshProducts();
														$('#detailsbox').modal(
																'hide');
														$('#detaildanger')
																.hide();
													} else {
														alert(xmlhr.responseText);
														$('#detaildanger')
																.show();
														$('#detailwarning')
																.html(
																		'Menyimpan data atau mengunggah foto tidak dapat dilakukan.');
													}
												} else {
													$('#detaildanger').show();
													$('#detailwarning')
															.html(
																	'Pengambilan data tidak dapat dilakukan. Hubungi administrator.');
												}
											}
											$('#detailwait').hide();

										};
										
										$('#detailwait').show();
										xmlhr.send(data);
										e.preventDefault();
									});
					
					$('#productlink').click(function(){
						refreshProducts();
					});
				
				});

function detailProduct(id) {
	/* LOAD DETAILS */
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getProductById.php', true);
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				var obj = JSON.parse(xmlhr.responseText);
				$('select#selectCategory option')
				   .each(function() { this.selected = (this.value == obj.catid); });
				$('#formdetails').trigger('reset');
				$('#namaProdukTb').val(obj.title);
				$('#deskripsiTb').val(obj.description);
				$('#jumlahStokTb').val(obj.stock);
				$('#hargaSatuanTb').val(obj.price);
				$('#uploadedimg').attr('src', '../../' + obj.imageurl);
				$('#tempid').val(obj.id);
				
				/* LOAD MODAL */
				$('#tambahProdukLabel').html('Ubah Produk: ' + obj.title);
				$('#detailsbox').modal({
					backdrop : 'static',
					keyboard : false
				});
				$('#detailsbox').modal('show');
				$('#warningcontainer').hide();

			} else {
				$('#warningcontainer')
						.html(
								'<strong>Terjadi kesalahan: </strong>Gagal membuka halaman detail!');
				$('#warningcontainer').show();
			}
		}
	};
	var data = new FormData();
	data.append('id', id);
	$('#warningcontainer')
	.html(
			'<strong>Membuka dialog detail... </strong><img src="../../assets/ajax-loader.gif" />');
	$('#warningcontainer').show();
	xmlhr.send(data);
}

function removeProduct(id, title) {
	if (confirm('Yakin akan menghapus produk ' + title + ' ?')) {
		var xmlhr = new XMLHttpRequest();
		xmlhr.open('POST', $url + '/functions/removeProduct.php', true);
		xmlhr.onload = function(e) {
			if (xmlhr.readyState == 4) {
				if (xmlhr.status == 200) {
					if (xmlhr.responseText == true) {
						refreshProducts();
					} else {
						alert('Gagal menghapus produk!');
					}
				} else {
					alert(xmlhr.statusText);
				}
			}
		};
		var data = new FormData();
		data.append('id', id);
		xmlhr.send(data);
		$('#warningcontainer')
				.html(
						'<strong>Menghapus produk... </strong><img src="../../assets/ajax-loader.gif" />');
		$('#warningcontainer').show();
	}
}

function refreshProducts() {
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getProducts.php', true);
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				$('#productstable').html(xmlhr.responseText);
				$('#warningcontainer').hide();
			} else {
				alert(xmlhr.statusText);
			}
		}
	};
	var data = new FormData();
	xmlhr.send(data);
	$('#warningcontainer')
			.html(
					'<strong>Memperbarui daftar produk... </strong><img src="../../assets/ajax-loader.gif" />');
}