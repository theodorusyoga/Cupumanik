$url = 'http://guesthouse.cupumanik-local.com';
$selectedcatid = null;
$(document)
		.ready(
				function() {
					/* HIDE ALERTS */
					$('#progressbar').hide();
					$('#alertreservation').hide();
					$('#fail-alert').hide();
					$('#orderprogressbar').hide();
					$('#orderalert').hide();
					
					$('#btn-submit').click(function(){
						addReservation();
					});

					$('#homeonly').click(function() {
						$selectedcatid = 1;
						$('#homeonly').css('background-color', '#E84B3A');
						$('#homeonly .okicon').css('visibility', 'visible');
						$('#roomonly').css('background-color', '');
						$('#roomonly .okicon').css('visibility', 'hidden');
					});

					$('#roomonly').click(function() {
						$selectedcatid = 2;
						$('#roomonly').css('background-color', '#E84B3A');
						$('#roomonly .okicon').css('visibility', 'visible');
						$('#homeonly').css('background-color', '');
						$('#homeonly .okicon').css('visibility', 'hidden');
					});

					$('.scroll').click(
							function() {
								$('html, body').animate(
										{
											scrollTop : $($(this).attr('href'))
													.offset().top - 50
										}, {
											duration : 500
										});
								return false;
							});
					$('#search-input').keydown(function(e) {
						if (e.keyCode == 13 || e.which == 13) {
							search();
						}
					});
					$('#search-btn').click(function() {
						search();
					});
					$('#banner-1').show();
					$('#banner-2').hide();
					$('#banner-3').hide();
					sessionStorage.guesthouseBanner = 1;
					var interval = window.setInterval(function() {
						var index = Number(sessionStorage.guesthouseBanner);
						var nextIndex = index < 3 ? (index + 1) : 1;
						// alert(index);
						$('#banner-' + index).fadeOut(500, function() {
							$('#banner-' + nextIndex).fadeIn(500);
						});
						sessionStorage.guesthouseBanner = nextIndex;
					}, 5000);
					$('.facilities-desc').hide();
					$('#facilities-desc-1').show();
					$('.facilities-icon')
							.bind(
									'mousedown',
									function() {
										var newId = Number($(this)
												.attr('id')
												.replace('facilities-icon-', ''));
										var selectedId = Number($(
												'.facilities-icon.selected')
												.first().attr('id').replace(
														'facilities-icon-', ''));
										if (newId != selectedId) {
											$('#facilities-icon-' + selectedId)
													.removeClass('selected');
											$('#facilities-icon-' + newId)
													.addClass('selected');
											$('#facilities-desc-' + selectedId)
													.hide(
															"slide",
															{
																direction : (newId > selectedId ? "left"
																		: "right")
															},
															300,
															function() {
																$(
																		'#facilities-desc-'
																				+ newId)
																		.show(
																				"slide",
																				{
																					direction : (newId > selectedId ? "right"
																							: "left")
																				},
																				300)
															});
										}
									});
					$('#start-date').datetimepicker({
						locale : 'id',
						sideBySide : true,
						format : 'dddd, YYYY-MM-D HH:mm'
					});
					$('#end-date').datetimepicker({
						locale : 'id',
						sideBySide : true,
						format : 'dddd, YYYY-MM-D HH:mm'
					});
					$('#start-date').on('dp.change', function(e) {
						$('#end-date').data('DateTimePicker').minDate(e.date);
					});
					/*
					 * restrict startdate aku hapus ya, soalnya jadi error :p
					 * *THEO*
					 */
					/*
					 * $('#end-date').on('dp.change', function(e) {
					 * $('#start-date').data('DateTimePicker').maxDate(e.date);
					 * });
					 */
					$('#btn-reservation')
							.click(
									function() {
										/* CHECK AVAILABILITY */
										if ($selectedcatid == null
												|| $('#start-date-input').val() == ''
												|| $('#end-date-input').val() == '') {
											$('#fail-alert')
													.html(
															'<span class="glyphicon glyphicon-warning-sign">&nbsp;</span>Isikan jenis pemesanan (per rumah/kamar) dan tanggal terlebih dahulu!');
											$('#fail-alert').show();
											return;
										} else {
											$('#fail-alert').hide();
											getAvailability();
										}

									});
					/*
					 * $('#btn-submit').on('click', function() { var allFilled =
					 * true; var customerName =
					 * $('input[name=customer-name]').val(); if (!customerName) {
					 * $('#alert-name-empty').removeClass('hide'); allFilled =
					 * false; } else $('#alert-name-empty').addClass('hide');
					 * var customerAddress =
					 * $('input[name=customer-address]').val(); if
					 * (!customerAddress) {
					 * $('#alert-address-empty').removeClass('hide'); allFilled =
					 * false; } else $('#alert-address-empty').addClass('hide');
					 * var customerPhone =
					 * $('input[name=customer-phone]').val(); var customerEmail =
					 * $('input[name=customer-email]').val(); if
					 * (!customerEmail) {
					 * $('#alert-email-empty').removeClass('hide'); allFilled =
					 * false; } else $('#alert-email-empty').addClass('hide');
					 * var customerNote = $('#customer-note').val() var
					 * customerPrice =
					 * $('#order-final').find('.order-total-price').first().text();
					 * if (allFilled) { insertOrder(customerName, customerEmail,
					 * customerAddress, customerPhone, customerNote,
					 * function(priceWithCode) { var price =
					 * accounting.unformat(customerPrice, ',');
					 * $('#fail-alert').addClass('hide'); $('.modal-header
					 * h4').text('Pemesanan Berhasil'); $('#form-order').hide();
					 * $('#order-confirmation').show();
					 * $('#customer-name-success').text(customerName);
					 * $('#customer-address-success').text(customerAddress);
					 * $('#customer-price-success').text(accounting.formatMoney(price,
					 * "Rp ", 2, '.', ','));
					 * $('#customer-email-success').text(customerEmail);
					 * $('#price-with-code').text(accounting.formatMoney(Number(priceWithCode),
					 * "Rp ", 2, '.', ',') + ' *'); $('#btn-submit').hide();
					 * $('#btn-ok').show(); deleteAllOrder(); }, function(error) {
					 * $('#fail-alert').text("Terjadi kesalahan, silakan coba
					 * ulangi pemesanan\n" + error);
					 * $('#fail-alert').removeClass('hide'); }); } });
					 */
					$('#btn-ok').click(function() {
						window.location.reload(true);
					});
					$('.product-item')
							.bind(
									'mousedown',
									function() {
										var background = $(this).find(
												'.product-item-inner').first()
												.css('background-image');
										$('#image-big').css('background-image',
												background);
										$('#image-big').css('background-size',
												'cover');
										$('#gallery-modal').modal({
											backdrop : true,
											keyboard : true
										});
									});
				});

/* Separated functions */

function getAvailability() {
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/checkReservationDate.php', true);
	xmlhr.onerror = function(e){
		alert('Terjadi kesalahan dalam memproses pesanan Anda. Silakan ulangi atau hubungi administrator.');
		$('#progressbar').hide();
	}
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				$roomid = xmlhr.responseText;
				if ($roomid != '0') {

					/* SHOW MODAL AND FORMAT */
					var monthNames = [ "Januari", "Februari", "Maret", "April",
							"Mei", "Juni", "Juli", "Agustus", "September",
							"Oktober", "November", "Desember" ];

					$('#order-modal').modal({
						backdrop : 'static',
						keyboard : false
					});
					$('#order-confirmation').hide();
					$('#btn-ok').hide();

					/* START DATE */
					var fullstartdate = $('#start-date-input').val();
					var allstartdate = fullstartdate.split(',');
					var startdatestr = allstartdate[1];
					var date = new Date(startdatestr);
					$('#startday').html(allstartdate[0]);
					$('#startdate').html(date.getDate());
					$('#startmonth').html(
							monthNames[date.getMonth()] + '<br/>'
									+ date.getFullYear());
					$('#starthour').html(("0" + date.getHours()).slice(-2));
					$('#startminute').html(("0" + date.getMinutes()).slice(-2));

					/* END DATE */
					var fullenddate = $('#end-date-input').val();
					var allenddate = fullenddate.split(',');
					var enddatestr = allenddate[1];
					var enddate = new Date(enddatestr);
					$('#endday').html(allenddate[0]);
					$('#enddate').html(enddate.getDate());
					$('#endmonth').html(
							monthNames[enddate.getMonth()] + '<br/>'
									+ enddate.getFullYear());
					$('#endhour').html(("0" + enddate.getHours()).slice(-2));
					$('#endminute')
							.html(("0" + enddate.getMinutes()).slice(-2));
					$('#alertreservation').hide();	
				} else {
					$('#alertreservation').show();
				}
				$('#progressbar').hide();
			}
		}
	};
	var data = new FormData();

	/* PARSE DATE */
	var fullstartdate = $('#start-date-input').val();
	var allstartdate = fullstartdate.split(',');
	var startdatestr = allstartdate[1];
	var fullenddate = $('#end-date-input').val();
	var allenddate = fullenddate.split(',');
	var enddatestr = allenddate[1];

	data.append('startdate', startdatestr);
	data.append('enddate', enddatestr);
	data.append('selectedcat', $selectedcatid);
	xmlhr.send(data);
	$('#progressbar').show();
}


function addReservation() {
	
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/addReservation.php', true);
	xmlhr.onerror = function(e){
		$('#orderprogressbar').hide();
		alert('Terjadi kesalahan dalam memproses pesanan Anda. Silakan ulangi atau hubungi administrator.');
	}
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				if(xmlhr.responseText == true){
					$('#orderalert').show();
					var interval = setInterval(function(){
						clearInterval(interval);
						location.reload();
					}, 5000);
				}
			}
		}
	};
	var data = new FormData();

	/* PARSE DATE */
	var fullstartdate = $('#start-date-input').val();
	var allstartdate = fullstartdate.split(',');
	var startdatestr = allstartdate[1];
	var fullenddate = $('#end-date-input').val();
	var allenddate = fullenddate.split(',');
	var enddatestr = allenddate[1];

	data.append('startdate', startdatestr);
	data.append('enddate', enddatestr);
	data.append('fullname', $('input[name=customer-name]').val());
	data.append('address', $('input[name=customer-address]').val());
	data.append('phone', $('input[name=customer-phone]').val());
	data.append('email', $('input[name=customer-email]').val());
	data.append('information', $('#customer-note').val());
	data.append('selectedCategoryId', $selectedcatid);
	xmlhr.send(data);
	$('#orderprogressbar').show();
}

