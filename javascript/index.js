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
					$('#newcategorydiv').hide();
					check();
					
					$('#mulaiTb').datepicker();
					$('#mulaiTb').datepicker("option", "showAnim", "slideDown");
					$('#mulaiTb').datepicker("option", "dateFormat", "yy/m/d");
					$('#akhirTb').datepicker();
					$('#akhirTb').datepicker("option", "showAnim", "slideDown");
					$('#akhirTb').datepicker("option", "dateFormat", "yy/m/d");
					
					/*EVENTS*/
					
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
										if ($('#tempid').val() == '') {
											$func = $url
													+ '/functions/addProduct.php';
										} else {
											$func = $url
													+ '/functions/updateProduct.php';
											data.append('id', $('#tempid')
													.val());
										}
										data.append('title', $namaproduk);
										data.append('desc', $desc);
										data.append('stock', $stock);
										data.append('categoryid', $cat);
										data.append('price', $price);

										xmlhr.open('POST', $func, true);
										xmlhr.onload = function(e) {
											if (xmlhr.readyState == 4) {
												if (xmlhr.status == 200) {
													$res = xmlhr.responseText;
													if ($res == true) {
														refreshFilteredProducts();
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

					$('#productlink').click(function() {
						refreshProducts();
					});

					$('#filter').on('submit', function(e) {
						e.preventDefault();
						refreshFilteredProducts();

					});

					$('#sortParam').on('change', function() {
						refreshFilteredProducts();
					});
					
					$('#sortOrderParam').on('change', function(){
						refreshFilteredOrders();
					});
					
					$('#mulaiTb').on('change', function(){
						refreshFilteredOrders();
					})
					
					$('#akhirTb').on('change', function(){
						refreshFilteredOrders();
					})

					$('#addcategory').click(function() {
						$('#newcategorydiv').fadeIn('fast');
					});

					$('#closeaddcat').click(function() {
						$('#newcategorydiv').fadeOut('fast');
					});

					$('#addcatform').on('submit', function(e) {
						addCategory();
						e.preventDefault();
					});

				});

function addCategory() {
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/addCategory.php', true);
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				if (xmlhr.responseText == true) {
					refreshCategories();
					$('#newcategorydiv').fadeOut('fast');
					$('#addcatform').trigger('reset');
				} else {
					$('#warningcontainer')
							.html(
									'<strong>Terjadi kesalahan: </strong>Gagal menyimpan kategori!');
					$('#warningcontainer').show();
				}
			} else {
				$('#warningcontainer')
						.html(
								'<strong>Terjadi kesalahan: </strong>Gagal menyimpan kategori!');
				$('#warningcontainer').show();
			}
		}
	};
	var data = new FormData();
	data.append('catname', $('#newcategoryTb').val());
	$('#warningcontainer')
			.html(
					'<strong>Menyimpan kategori... </strong><img src="../../assets/ajax-loader.gif" />');
	$('#warningcontainer').show();
	xmlhr.send(data);
}

function detailProduct(id) {
	/* LOAD DETAILS */
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getProductByIdJson.php', true);
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				var obj = JSON.parse(xmlhr.responseText);
				$('select#selectCategory option').each(function() {
					this.selected = (this.value == obj.catid);
				});
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

function changeCategory(id) {
	$catname = $('#catname_' + id).html();
	$textbox = '<input type="textbox" id="changecatTb" class="form-control" value="'
			+ $catname + '"></input>';
	$button = '<button onclick=\"updateCategory(' + id
			+ ')\" class=\"btn\">Simpan</button>';
	$('#catname_' + id).html('');
	$('#buttoncat_' + id).html('');
	$('#catname_' + id).html($textbox);
	$('#buttoncat_' + id).html($button);
}

function updateCategory(id) {
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/updateCategory.php', true);
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				if (xmlhr.responseText == true) {
					refreshCategories();
					$('#warningcontainer').hide();
				} else {
					$('#warningcontainer')
							.html(
									'<strong>Terjadi kesalahan dalam memperbarui data kategori.</strong>');
					$('#warningcontainer').show();
				}

			} else {
				alert(xmlhr.statusText);
			}
		}
	};
	var data = new FormData();
	data.append('catid', id);
	data.append('categoryname', $('#changecatTb').val());
	xmlhr.send(data);
	$('#warningcontainer')
			.html(
					'<strong>Mengubah data kategori... </strong><img src="../../assets/ajax-loader.gif" />');
}

function removeCategory(id) {
	if (confirm('Apakah Anda yakin akan menghapus data kategori ini?')) {
		var xmlhr = new XMLHttpRequest();
		xmlhr.open('POST', $url + '/functions/removeCategory.php', true);
		xmlhr.onload = function(e) {
			if (xmlhr.readyState == 4) {
				if (xmlhr.status == 200) {
					if (xmlhr.responseText == true) {
						refreshCategories();
						$('#warningcontainer').hide();
					} else {
						$('#warningcontainer')
								.html(
										'<strong>Terjadi kesalahan dalam menghapus data kategori.</strong>Kategori tidak dapat dihapus jika masih ada produk di dalam kategori tersebut.');
						$('#warningcontainer').show();
					}

				} else {
					alert(xmlhr.statusText);
				}
			}
		};
		var data = new FormData();
		data.append('catid', id);
		xmlhr.send(data);
		$('#warningcontainer')
				.html(
						'<strong>Menghapus data kategori... </strong><img src="../../assets/ajax-loader.gif" />');
	}
}

function refreshCategories() {
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getCategories.php', true);
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				$('#tablecat').html(xmlhr.responseText);
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
					'<strong>Memperbarui daftar kategori... </strong><img src="../../assets/ajax-loader.gif" />');
}

function refreshFilteredProducts() {
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getFilteredProducts.php', true);
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
	data.append('title', $('#cariTb').val());
	data.append('sort', $('#sortParam option:selected').val());
	xmlhr.send(data);
	$('#warningcontainer')
			.html(
					'<strong>Memperbarui daftar produk... </strong><img src="../../assets/ajax-loader.gif" />');
}

function refreshFilteredOrders(){
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getOrders.php', true);
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				$('#orderstable').html(xmlhr.responseText);
				$('#warningcontainer').hide();
			} else {
				alert(xmlhr.statusText);
			}
		}
	};
	var data = new FormData();
	data.append('sort', $('#sortOrderParam option:selected').val());
	data.append('mulai', $('#mulaiTb').val());
	data.append('akhir', $('#akhirTb').val());
	xmlhr.send(data);
	$('#warningcontainer')
			.html(
					'<strong>Memperbarui daftar pemesanan... </strong><img src="../../assets/ajax-loader.gif" />');
}
