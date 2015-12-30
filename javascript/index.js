$url = 'http://localhost/Cupumanik';

$(document)
		.ready(
				function() {
					$('#loginbox').modal({
						backdrop : 'static',
						keyboard : false
					});
					$('#orderdetailsbox').modal({
						backdrop : 'static',
						keyboard : false
					});
					$('#orderdetailsbox').modal('hide');
					$('#alertdanger').hide();
					$('#alertwarning').hide();
					$('#detaildanger').hide();
					$('#detailwait').hide();
					$('#orderdanger').hide();
					$('#orderwait').hide();
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
						getCategoriesDropDown();
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
						getCategoriesDropDown();
					});

					$('#orderlink').click(function() {
						refreshFilteredOrders();
					});

					$('#categorylink').click(function() {
						refreshCategories();
					});

					$('#filter').on('submit', function(e) {
						e.preventDefault();
						refreshFilteredProducts();

					});

					$('#sortParam').on('change', function() {
						refreshFilteredProducts();
					});

					$('#sortOrderParam').on('change', function() {
						refreshFilteredOrders();
					});

					$('#mulaiTb').on('change', function() {
						refreshFilteredOrders();
					})

					$('#akhirTb').on('change', function() {
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

function getCategoriesDropDown() {
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/printCategoriesDd.php', true);
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				$options = xmlhr.responseText;
				$('#selectCategory').html($options);
				$('#catparam').html($options);
				$('#warningcontainer').hide();
			} else {
				$('#warningcontainer')
						.html(
								'<strong>Terjadi kesalahan: </strong>Gagal memuat kategori!');
				$('#warningcontainer').show();
			}
		}
	};
	var data = new FormData();
	$('#warningcontainer')
			.html(
					'<strong>Memuat kategori... </strong><img src="../../assets/ajax-loader.gif" />');
	$('#warningcontainer').show();
	xmlhr.send(data);
}

function detailOrder(id) {
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/getOrderDetailById.php', true);
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				var obj = JSON.parse(xmlhr.responseText);
				/* LOAD DATA */
				$('#namaPemesanLabel').text(obj.custname);
				$('#alamatLabel').text(obj.address);
				$('#phoneLabel').text(obj.phone);
				$('#emailLabel').text(obj.email);
				$('#informasiLabel').text(obj.information);
				$('#tanggalLabel').text(obj.date);
				if (obj.isprocessed === true) {
					$('#statusLabel')
							.html(
									'<span class="glyphicon glyphicon-ok">&nbsp;</span>Sudah Diproses');
					$('#tandaiBtn').attr('disabled', 'true');
					$('#tandaiBtn').html('Sudah Diproses');
					$('#tandaiBtn').attr('class', 'btn btn-success');
				} else {
					$('#statusLabel').html('Belum Diproses');
					$('#tandaiBtn').removeAttr('disabled');
					$('#tandaiBtn')
							.html(
									'<span class="glyphicon glyphicon-ok">&nbsp;</span>Tandai Sudah Diproses');
					$('#tandaiBtn').attr('class', 'btn btn-primary');
					$('#tandaiBtn').attr('onclick',
							'markFinished(' + obj.id + ')');
				}

				$productcols = '';
				$productcols += '<table class="table table-hover">' + '<tr>'
						+ '<th>No.</th>' + '<th>&nbsp;</th>'
						+ '<th>Nama Produk</th>' + '<th>Harga Satuan</th>'
						+ '<th>Jumlah</th>' + '<th>Harga Total</th>' + '</tr>';

				if (obj.products.length > 0) {
					$('#productdetails').html('');
					$subtotal = 0;
					for (var i = 0; i < obj.products.length; i++) {
						$totalprice = 0;
						$productcols += '<tr>';
						$productcols += '<td>' + (i + 1) + '</td>';
						$productcols += '<td><img src="../../'
								+ obj.products[i].imageurl
								+ '" style="max-width: 100px;"></td>';
						$productcols += '<td>' + obj.products[i].productname
								+ '</td>';
						$productcols += '<td>'
								+ accounting.formatMoney(obj.products[i].price,
										'IDR', '.', ',') + '</td>';
						$productcols += '<td>' + obj.products[i].amount
								+ '</td>';
						$totalprice += obj.products[i].price
								* obj.products[i].amount;
						$subtotal += $totalprice;
						$productcols += '<td>'
								+ accounting.formatMoney($totalprice, 'IDR',
										'.', ',') + '</td>';
						$productcols += '</tr>';
					}
					$productcols += '<tr>';
					if(!obj.randomnum)
						obj.randomnum = 0;
					$productcols += '<td colspan="5"><label class="pull-right">Total Pemesanan + angka unik <span style="color:red;">' + obj.randomnum +'</span>:</label></td>';
					$productcols += '<td>'
							+ accounting
									.formatMoney(($subtotal + obj.randomnum), 'IDR', '.', ',')
							+ '</td>';
					$productcols += '</tr>';
				}

				$productcols += '</table>';
				$('#productdetails').html($productcols);

				/* LOAD MODAL */
				$('#orderdetailstitle').html(
						'Detail Pemesanan oleh: ' + obj.custname);
				$('#orderdetailsbox').modal({
					backdrop : 'static',
					keyboard : false
				});
				$('#orderdetailsbox').modal('show');
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
					'<strong>Membuka detail pemesanan... </strong><img src="../../assets/ajax-loader.gif" />');
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
				getCategoriesDropDown();
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
	$('#warningcontainer').show();
	$('#warningcontainer')
			.html(
					'<strong>Memperbarui daftar produk... </strong><img src="../../assets/ajax-loader.gif" />');
}

function markFinished(id) {
	if (confirm('Anda yakin pemesanan ini sudah diproses dan dilakukan?')) {
		var xmlhr = new XMLHttpRequest();
		xmlhr.open('POST', $url + '/functions/updateOrder.php', true);
		xmlhr.onload = function(e) {
			if (xmlhr.readyState == 4) {
				if (xmlhr.status == 200) {
					if (xmlhr.responseText == true) {
						refreshFilteredOrders();
						$('#warningcontainer').hide();
						$('#orderdetailsbox').modal('hide');
					} else {
						$('#warningcontainer')
								.html(
										'<strong>Terjadi kesalahan dalam menandai pemesanan.</strong>');
						$('#warningcontainer').show();
					}

				} else {
					alert(xmlhr.statusText);
				}
			}
		};
		var data = new FormData();
		data.append('orderid', id);
		data.append('isprocessed', 1);
		xmlhr.send(data);
		$('#warningcontainer').show();
		$('#warningcontainer')
				.html(
						'<strong>Menandai pemesanan sudah dilakukan... </strong><img src="../../assets/ajax-loader.gif" />');
	}
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
	$('#warningcontainer').show();
	$('#warningcontainer')
			.html(
					'<strong>Mengubah data kategori... </strong><img src="../../assets/ajax-loader.gif" />');
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
		$('#warningcontainer').show();
		$('#warningcontainer')
				.html(
						'<strong>Menghapus data kategori... </strong><img src="../../assets/ajax-loader.gif" />');
	}
}

function removeOrder(id, custname) {
	if (confirm('Apakah Anda yakin akan menghapus pemesanan dari '
			+ custname
			+ '? Seluruh daftar produk beserta jumlah pemesanan akan terhapus. Data yang terhapus TIDAK DAPAT dilihat kembali.')) {
		var xmlhr = new XMLHttpRequest();
		xmlhr.open('POST', $url + '/functions/removeOrder.php', true);
		xmlhr.onload = function(e) {
			if (xmlhr.readyState == 4) {
				if (xmlhr.status == 200) {
					if (xmlhr.responseText == true) {
						refreshFilteredOrders();
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
		data.append('id', id);
		xmlhr.send(data);
		$('#warningcontainer').show();
		$('#warningcontainer')
				.html(
						'<strong>Menghapus data pemesanan... </strong><img src="../../assets/ajax-loader.gif" />');
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
	$('#warningcontainer').show();
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
	$('#warningcontainer').show();
	$('#warningcontainer')
			.html(
					'<strong>Memperbarui daftar produk... </strong><img src="../../assets/ajax-loader.gif" />');
}

function refreshFilteredOrders() {
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
	$('#warningcontainer').show();
	$('#warningcontainer')
			.html(
					'<strong>Memperbarui daftar pemesanan... </strong><img src="../../assets/ajax-loader.gif" />');
}
