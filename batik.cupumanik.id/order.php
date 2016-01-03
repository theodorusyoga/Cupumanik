<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Daftar Belanja</title>
<link href='https://fonts.googleapis.com/css?family=Raleway'
	rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Noto+Sans'
	rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Alegreya'
	rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="cupumanik-batik.min.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
	crossorigin="anonymous">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="../javascript/accounting.js"></script>
<script src="../javascript/order.js"></script>
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
	crossorigin="anonymous"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var bodyContent = "";
		var orderList = getAllOrder();
		if (orderList) {
			if (orderList.length > 0) {
				printOrderTable('#order-body', orderList, true);
				events();
			}
			else {
				printNoOrder();
			}
		}
		else {
			printNoOrder();
		}
	});

	function events()
	{

		$('.order-qty-edit').change(function() {
			var parenttr = $(this).closest('.order-item');
			var index = Number(parenttr.find('.number-cell').first().text());
			var qty = Number($(this).val());
			updateOrderQty((index-1), qty);
			calculateItemPrice(parenttr);
			calculateTotalPrice('#order-body');
		});
		$('.btn-delete-order').click(function() {
			var parenttr = $(this).closest('.order-item');
			var index = Number(parenttr.find('.number-cell').first().text());
			var name = parenttr.find('.order-name').first().text();
			var c = confirm("Anda yakin ingin menghapus pesanan " + name.toString() + "?");
			if (c) {
				var newOrder = deleteOrder((index-1));
				if (newOrder) {
					if (newOrder.length > 0) {
						printOrderTable('#order-body', newOrder, true);
						events();
					}
					else {
						printNoOrder();
					}
					$('#order-item-count').text(newOrder.length);
				}
				else {
					printNoOrder();
					$('#order-item-count').text(0);
				}
			}
		});
		$('#btn-order').on('click', function() {
			$('#order-modal').modal({
				backdrop : 'static',
				keyboard : false
			});
			$('#order-confirmation').hide();
			$('#btn-ok').hide();
			var orderList = getAllOrder();
			if (orderList) {
				if (orderList.length > 0) {
					printOrderTable('#order-final', orderList, false);
					$('#form-order').show();
					$('#btn-submit').show();
					$('input[name=customer-name]').val(null);
					$('input[name=customer-address]').val(null);
					$('input[name=customer-phone]').val(null);
					$('input[name=customer-email]').val(null);
					$('#customer-note').val(null);
					$('#alert-name-empty').addClass('hide');
					$('#alert-address-empty').addClass('hide');
					$('#alert-email-empty').addClass('hide');
					$('#fail-alert').addClass('hide');
				}
			}
		});
		$('#btn-submit').on('click', function() {
			var allFilled = true;
			var customerName = $('input[name=customer-name]').val();
			if (!customerName) {
			      $('#alert-name-empty').removeClass('hide');
			      allFilled = false;
			}
			else $('#alert-name-empty').addClass('hide');
			var customerAddress = $('input[name=customer-address]').val();
			if (!customerAddress) {
			      $('#alert-address-empty').removeClass('hide');
			      allFilled = false;
			}
			else $('#alert-address-empty').addClass('hide');
			var customerPhone = $('input[name=customer-phone]').val();
			var customerEmail = $('input[name=customer-email]').val();
			if (!customerEmail) {
			      $('#alert-email-empty').removeClass('hide');
			      allFilled = false;
			}
			else $('#alert-email-empty').addClass('hide');
			var customerNote = $('#customer-note').val()
			var customerPrice = $('#order-final').find('.order-total-price').first().text();
			if (allFilled) {
				insertOrder(customerName, customerEmail, customerAddress, customerPhone, customerNote,
					function(priceWithCode) {
						var price = accounting.unformat(customerPrice, ',');
						$('#fail-alert').addClass('hide');
						$('.modal-header h4').text('Pemesanan Berhasil');
						$('#form-order').hide();
						$('#order-confirmation').show();
						$('#customer-name-success').text(customerName);
						$('#customer-address-success').text(customerAddress);
						$('#customer-price-success').text(accounting.formatMoney(price, "Rp ", 2, '.', ','));
						$('#customer-email-success').text(customerEmail);
						$('#price-with-code').text(accounting.formatMoney(Number(priceWithCode), "Rp ", 2, '.', ',') + ' *');
						$('#btn-submit').hide();
						$('#btn-ok').show();
						deleteAllOrder();
					}, function(error) {
						$('#fail-alert').text("Terjadi kesalahan, silakan coba ulangi pemesanan\n" + error);
						$('#fail-alert').removeClass('hide');
					});
			}
		});
		$('#btn-ok').click(function() {
			window.location.reload(true);
		});
	}

	function printNoOrder() {
		$('#order-body').html('');
		$('#order-body').html('<p class="alert alert-warning">Tidak ada pesanan</p>');
	}

	function calculateItemPrice(itemtr) {
		var singlePrice = accounting.unformat($(itemtr).find('.order-single-price').first().text(), ',');
		var orderQtyElement = $(itemtr).find('.order-qty').first();
		var orderQty = Number( orderQtyElement.hasClass('order-qty-edit') ? orderQtyElement.val() : orderQtyElement.text() ) ;
		var itemPrice = singlePrice * orderQty;
		$(itemtr).find('.order-item-price').first().text(accounting.formatNumber(itemPrice, 2, '.', ','));
	}

	function calculateTotalPrice(parentTable) {
		var totalPrice = 0;
		$(parentTable).find('.order-item-price').each(function() {
			var itemPrice = accounting.unformat($(this).text(), ',');
			totalPrice += itemPrice;
		});
		$(parentTable).find('.order-total-price').text(accounting.formatNumber(totalPrice, 2, '.', ','));
	}

	function printOrderTable(parent, orderList, canEditQty)
	{
		var table = '';
		table += '<table id="' + (canEditQty ? 'main-order-list' : 'final-order-list') + '" class="order-list table table-condensed table-striped">';
		table += '<colgroup>';
		if (canEditQty)
			table += '<col class="col-xs-1" />';
		table += '<col class="col-xs-1" />';
		table += '<col class="col-xs-' + (canEditQty ? 4 : 3) + '" />';
		table += '<col class="col-xs-' + (canEditQty ? 2 : 3) + '" />';
		table += '<col class="col-xs-2" />';
		table += '<col class="col-xs-' + (canEditQty ? 2 : 3) + '" />';
		table += '</colgroup>';
		table += '<thead>';
		table += '<tr>';
		if (canEditQty)
			table += '<th style="width: 50px !important;"></th>';
		table += '<th>No.</th>';
		table += '<th>Nama Barang</th>';
		table += '<th>Satuan</th>';
		table += '<th>Jumlah</th>';
		table += '<th>Harga</th>';
		table += '</tr>';
		table += '</thead>';
		table += '<tbody>';

		for (i=0; i< orderList.length; i++) {
			
			table += '<tr class="order-item">';
			if (canEditQty)
				table += '<td style="width: 50px !important;"><button class="btn btn-danger btn-sm btn-delete-order"><span class="glyphicon glyphicon-remove"></span></button></td>';
			table += '<td class="number-cell">' + (i + 1).toString() + '</td>';
			table += '<td><span class="order-id" style="display: none;">' + orderList[i].id + '</span><span class="order-name">' + orderList[i].name + '</span></td>';
			table += '<td class="price-cell">';
			table += '<span class="currency">Rp</span><span class="amount order-single-price">' + accounting.formatNumber(orderList[i].singleprice,2,'.',',') + '</span>';
			table += '</td>';
			table += '<td>' + (canEditQty ? '<input type="number" min="1" max="' + orderList[i].stock + '" step="1" value="' + orderList[i].qty + '" class="order-qty order-qty-edit form-control" />' : '<span class="order-qty">' + orderList[i].qty + '</span>') + '</td>';
			table += '<td class="price-cell">';
			table += '<span class="currency">Rp</span><span class="amount order-item-price"></span>';
			table += '</td>';
			table += '</tr>';
		}

		table += '</tbody>';
		table += '<tfoot>';
		table += '<tr>';
		table += '<th>&nbsp;</th>';
		table += '<th colspan="' + (canEditQty ? 4 : 3) + '">Total</th>';
		table += '<th class="price-cell"><span class="currency">Rp</span>';
		table += '<span class="amount order-total-price">2679000</span></th>';
		table += '</tr>';
		table += '</tfoot>';
		table += '</table>';

		if (canEditQty) {
			table += '<br />';
			table += '<button role="submit" id="btn-order" class="btn btn-info">Pesan</button>';
			table += '<br />';
			table += '<p class="order-info">* Sebelum memesan, pastikan pesanan anda sudah benar. ';
			table += 'Anda tidak bisa lagi mengubah pesanan anda setelah melakukan proses pemesanan</p>';
		}

		$(parent).html('');
		$(parent).html(table);
		$(parent).find('.order-item').each(function() {
			calculateItemPrice(this);
		});
		calculateTotalPrice(parent);
	}
</script>
<?php
	include_once( $_SERVER ['DOCUMENT_ROOT'].'/include.php');
?>
</head>
<body>
	<?php 
		echo getBatikHeader();
	?>
	
	<div class="main-body">
		<h2 class="main-title">Daftar Belanja Anda</h2>
		<br />
		<div id="order-body">
		</div>
	</div>

	<div id="order-modal" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title main-title">Form Pemesanan</h4>
				</div>
				<div class="modal-body">
					<div id="form-order">
						<div id="order-final">
						</div>
						<hr />
						<p id="fail-alert" class="alert alert-danger hide"></p>
						<h4 class="main-title">Isikan data diri anda</h4>
						<form role="form">
							<div class="form-group row">
								<label class="control-label col-xs-3">Nama Lengkap <span class="important-mark">*</span></label>
								<div class="col-xs-9">
									<input type="text" class="form-control input-sm" name="customer-name" required>
									<p id="alert-name-empty" class="text-danger bg-danger hide">Nama wajib diisi!</p>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-xs-3">Alamat Pengiriman <span class="important-mark">*</span> </label>
								<div class="col-xs-9">
									<input type="text" class="form-control input-sm" name="customer-address" required>
									<p id="alert-address-empty" class="text-danger bg-danger hide">Alamat wajib diisi!</p>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-xs-3">Nomor Telepon/HP</label>
								<div class="col-xs-9">
									<input type="text" class="form-control input-sm" name="customer-phone">
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-xs-3">Email <span class="important-mark">*</span> </label>
								<div class="col-xs-9">
									<input type="text" class="form-control input-sm" name="customer-email" required>
									<p id="alert-email-empty" class="text-danger bg-danger hide">Email wajib diisi!</p>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-xs-3">Keterangan/Informasi Tambahan </label>
								<div class="col-xs-9">
									<textarea rows="4" class="form-control input-sm" id="customer-note"></textarea>
								</div>
							</div>
						</form>
					</div>
					<div id="order-confirmation">
						<div class="order-summary">
							<div class="row">
								<label class="col-xs-5">Kode Pemesanan</label>
								<label class="col-xs-1">:</label>
								<label class="col-xs-6">82VCM7K91</label>
							</div>
							<div class="row">
								<label class="col-xs-5">Nama Pemesan</label>
								<label class="col-xs-1">:</label>
								<label id="customer-name-success" class="col-xs-6">Orang Ketiga</label>
							</div>
							<div class="row">
								<label class="col-xs-5">Total Harga</label>
								<label class="col-xs-1">:</label>
								<label id="customer-price-success" class="col-xs-6">Rp 2.679.000,00</label>
							</div>
							<div class="row">
								<label class="col-xs-5">Alamat Pengiriman</label>
								<label class="col-xs-1">:</label>
								<label id="customer-address-success" class="col-xs-6">Orang Ketiga</label>
							</div>
						</div>
						<p>Detail pemesanan sudah dikirim ke email <strong id="customer-email-success">orangketiga@blablabla.com</strong></p>
						<hr/>
						<p>Harap segera melakukan transfer sejumlah:</p>
						<h2 id="price-with-code" class="main-title">Rp 2.679.091,00 *</h2>
						<p>Ke rekening <strong>111111111111111 (Cupumanik Batik)</strong> paling lambat 24 jam setelah pemesanan ini dilakukan. 
						Jika dalam 24 jam pengiriman tidak dilakukan, pemensanan dianggap batal.</p>
						<br/>
						<small>* tambahan 2 angka sebagai kode pemesanan</small>
					</div>
				</div>
				<div class="modal-footer">
					<button id="btn-submit" class="btn btn-info">Proses Pemesanan</button>
					<button id="btn-ok" class="btn btn-success">OK</button>
				</div>
			</div>

		</div>
	</div>

	<?php 
		echo getBatikFooter();
	?>
</body>
</html>