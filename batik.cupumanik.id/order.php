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
<link rel="stylesheet" href="cupumanik-style.css">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
	crossorigin="anonymous">
<link rel="stylesheet"
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-2.1.3.js"></script>
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
				$('#main-order-list').find('.order-item').each(function() {
					$(this).find('.order-single-price').each(function() {
						var singlePrice = Number($(this).text());
						$(this).text(accounting.formatNumber(singlePrice,2,'.',','));
					});
					calculateItemPrice(this);
				});

				var mainTable = $('#main-order-list');
				calculateTotalPrice(mainTable);

				$('.order-qty').change(function() {
					var parenttr = $(this).closest('.order-item');
					calculateItemPrice(parenttr);
					var mainTable = $('#main-order-list');
					calculateTotalPrice(mainTable);
				});
			}
			else {
				printNoOrder();
			}
		}
		else {
			printNoOrder();
		}

		$('#btn-order').on('click', function() {

			$('#order-modal').modal({
				backdrop : 'static',
				keyboard : false
			});
			$('#form-order').show();
			$('#order-confirmation').hide();
			$('#btn-submit').show();
			$('#btn-ok').hide();
			$('#final-order-list').find('.amount').each(function() {
				var amount = Number($(this).text());
				$(this).text(accounting.formatNumber(amount,2,'.',','));
			});
		});
		

		$('#btn-submit').on('click', function() {
			$('.modal-header h4').text('Pemesanan Berhasil');
			$('#form-order').hide();
			$('#order-confirmation').show();
			$('#btn-submit').hide();
			$('#btn-ok').show();
		});

		
		
	});

	function printNoOrder() {
		$('#order-body').html('');
		$('#order-body').html('<p class="alert-warning">Tidak ada pesanan</p>');
	}

	function calculateItemPrice(itemtr) {
		var singlePrice = accounting.unformat($(itemtr).find('.order-single-price').first().text(), ',');
		var orderQty = Number($(itemtr).find('.order-qty').val());
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
		table += '<col class="col-xs-1" />';
		table += '<col class="col-xs-' + (canEditQty ? 5 : 3) + '" />';
		table += '<col class="col-xs-' + (canEditQty ? 2 : 3) + '" />';
		table += '<col class="col-xs-2" />';
		table += '<col class="col-xs-' + (canEditQty ? 2 : 3) + '" />';
		table += '</colgroup>';
		table += '<thead>';
		table += '<tr>';
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
			table += '<td class="number-cell">' + (i + 1).toString() + '</td>';
			table += '<td>' + orderList[i].name + '</td>';
			table += '<td class="price-cell">';
			table += '<span class="currency">Rp</span><span class="amount order-single-price">' + orderList[i].singleprice + '</span>';
			table += '</td>';
			table += '<td>' + (canEditQty ? '<input type="number" min="1" max="' + orderList[i].stock + '" step="1" value="' + orderList[i].qty + '" class="order-qty form-control" />' : '<td class="order-qty-text">' + orderList[i].qty + '</td>') + '</td>';
			table += '<td class="price-cell">';
			table += '<span class="currency">Rp</span><span class="amount order-item-price"></span>';
			table += '</td>';
			table += '</tr>';
		}

		table += '</tbody>';
		table += '<tfoot>';
		table += '<tr>';
		table += '<th>&nbsp;</th>';
		table += '<th colspan="3">Total</th>';
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
		
	}
</script>
<?php
$path = $_SERVER ['DOCUMENT_ROOT'] . '/Cupumanik';
$function = $path . '/functions/functions.php';
$product = $path . '/functions/getProductById.php';
$header = $path . '/batik.cupumanik.id/header.php';
$footer = $path . '/batik.cupumanik.id/footer.php';
include ($function);
include ($product);
include ($header);
include ($footer);
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
						<table id="final-order-list" class="order-list table table-condensed table-striped">
							<colgroup>
								<col class="col-xs-1" />
								<col class="col-xs-3" />
								<col class="col-xs-3" />
								<col class="col-xs-2" />
								<col class="col-xs-3" />
							</colgroup>
							<thead>
								<tr>
									<th>No.</th>
									<th>Nama Barang</th>
									<th>Satuan</th>
									<th>Jumlah</th>
									<th>Harga</th>
								</tr>
							</thead>
							<tbody>
								<tr class="order-item">
									<td class="number-cell">1</td>
									<td>Dasi Batik</td>
									<td class="price-cell"><span class="currency">Rp</span><span
										class="amount">103000</span></td>
									<td class="order-qty-text">3</td>
									<td class="price-cell"><span class="currency">Rp</span><span
										class="amount">309000</span></td>
								</tr>
								<tr class="order-item">
									<td class="number-cell">2</td>
									<td>Jas Batik</td>
									<td class="price-cell"><span class="currency">Rp</span><span
										class="amount">1820000</span></td>
									<td class="order-qty-text">1</td>
									<td class="price-cell"><span class="currency">Rp</span><span
										class="amount">1820000</span></td>
								</tr>
								<tr class="order-item">
									<td class="number-cell">3</td>
									<td>Mini Skirt Batik</td>
									<td class="price-cell"><span class="currency">Rp</span><span
										class="amount">275000</span></td>
									<td class="order-qty-text">2</td>
									<td class="price-cell"><span class="currency">Rp</span><span
										class="amount">550000</span></td>
								</tr>
							</tbody>
							<tfoot>
								<tr>
									<th>&nbsp;</th>
									<th colspan="3">Total</th>
									<th class="price-cell"><span class="currency">Rp</span><span
										class="amount">2679000</span></th>
								</tr>
							</tfoot>
						</table>
						<hr />
						<h4 class="main-title">Isikan data diri anda</h4>
						<form role="form">
							<div class="form-group row">
								<label class="control-label col-xs-3">Nama Lengkap <span class="important-mark">*</span></label>
								<div class="col-xs-9">
									<input type="text" class="form-control input-sm" name="customer-name" required>
								</div>
							</div>
							<div class="form-group row">
								<label class="control-label col-xs-3">Alamat Pengiriman <span class="important-mark">*</span> </label>
								<div class="col-xs-9">
									<input type="text" class="form-control input-sm" name="customer-address" required>
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
								<label class="col-xs-6">Orang Ketiga</label>
							</div>
							<div class="row">
								<label class="col-xs-5">Total Harga</label>
								<label class="col-xs-1">:</label>
								<label class="col-xs-6">Rp 2.679.000,00</label>
							</div>
							<div class="row">
								<label class="col-xs-5">Alamat Pengiriman</label>
								<label class="col-xs-1">:</label>
								<label class="col-xs-6">Orang Ketiga</label>
							</div>
						</div>
						<p>Detail pemesanan sudah dikirim ke email <strong>orangketiga@blablabla.com</strong></p>
						<hr/>
						<p>Harap segera melakukan transfer sejumlah:</p>
						<h2 class="main-title">Rp 2.679.091,00 *</h2>
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