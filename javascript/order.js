function addOrder(id, name, singleprice, stock, qty) {
	var order = {
		id : id,
		name : name,
		singleprice : singleprice,
		stock : stock,
		qty : qty
	}

	var list = [];
	if (sessionStorage.orderList)
		list = JSON.parse(sessionStorage.orderList);

	list.push(order);
	sessionStorage.orderList = JSON.stringify(list);
	return list.length;
}

function checkOrderExist(id) {
	if (sessionStorage.orderList) {
		list = JSON.parse(sessionStorage.orderList);
		var isExist = false;
		for (i = 0; i < list.length; i++) {
			if (list[i].id == id)
				isExist = true;
		}
		return isExist;
	} else
		return false;
}

function deleteOrder(index) {
	if (sessionStorage.orderList) {
		list = JSON.parse(sessionStorage.orderList);
		list.splice(index, 1);
		sessionStorage.orderList = JSON.stringify(list);
		return list;
	} else
		return null;
}

function deleteAllOrder() {
	if (sessionStorage.orderList)
		sessionStorage.orderList = [];
	return;
}

function updateOrderQty(index, qty) {
	if (sessionStorage.orderList) {
		var list = JSON.parse(sessionStorage.orderList);
		list[index].qty = qty;
		sessionStorage.orderList = JSON.stringify(list);
	}
	return;
};

function getAllOrder() {
	if (sessionStorage.orderList)
		return JSON.parse(sessionStorage.orderList);
	else
		return null;
}

function getOrderCount() {
	if (sessionStorage.orderList) {
		var orderArray = JSON.parse(sessionStorage.orderList);
		return orderArray.length;
	} else
		return 0;
}

function insertOrder() {
	$url = 'http://localhost/Cupumanik';
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/insertOrder.php', true);
	xmlhr.onload = function(e) {
		alert(xmlhr.responseText);
		if (xmlhr.readyState == 4) {
			
			if (xmlhr.status == 200) {
				/*$('#warningcontainer').hide();*/
			} else {
				alert(xmlhr.statusText);
			}
		}
	};
	var data = new FormData();
	data
			.append(
					'jsondata',
					'{ "name" : "Raisa", "email" : "raisa@mail.com", "address" : "Jalanku tak seindah jalanmu", "phone" : "08111111111", "info" : "jangan lupa bonusnya kakak :3", "products" : [{"id" : 23, "amount" : 5}, {"id" : 1, "amount" : 7}]}');
	xmlhr.send(data);
	/*$('#warningcontainer').show();
	$('#warningcontainer')
			.html(
					'<strong>Memperbarui daftar pemesanan... </strong><img src="../../assets/ajax-loader.gif" />');*/
}