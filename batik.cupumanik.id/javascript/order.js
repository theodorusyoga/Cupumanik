function addOrder(id, name, singleprice, stock, qty) {
	var order = {
		id : id,
		name : name,
		singleprice : singleprice,
		stock : stock,
		qty : qty
	}

	var list = [];
	if (sessionStorage.batikOrderList)
		list = JSON.parse(sessionStorage.batikOrderList);

	list.push(order);
	sessionStorage.batikOrderList = JSON.stringify(list);
	return list.length;
}

function checkOrderExist(id) {
	if (sessionStorage.batikOrderList) {
		list = JSON.parse(sessionStorage.batikOrderList);
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
	if (sessionStorage.batikOrderList) {
		list = JSON.parse(sessionStorage.batikOrderList);
		list.splice(index, 1);
		sessionStorage.batikOrderList = JSON.stringify(list);
		return list;
	} else
		return null;
}

function deleteAllOrder() {
	if (sessionStorage.batikOrderList)
		sessionStorage.batikOrderList = [];
	return;
}

function updateOrderQty(index, qty) {
	if (sessionStorage.batikOrderList) {
		var list = JSON.parse(sessionStorage.batikOrderList);
		list[index].qty = qty;
		sessionStorage.batikOrderList = JSON.stringify(list);
	}
	return;
};

function getAllOrder() {
	if (sessionStorage.batikOrderList)
		return JSON.parse(sessionStorage.batikOrderList);
	else
		return null;
}

function getOrderCount() {
	if (sessionStorage.batikOrderList) {
		var orderArray = JSON.parse(sessionStorage.batikOrderList);
		return orderArray.length;
	} else
		return 0;
}

function insertOrder(name, email, address, phone, note, success, fail) {
	$url = 'http://batik.cupumanik.id';
	
	var products = [];
	var orderitem = getAllOrder();
	if (orderitem)
	{
		for (i = 0; i < orderitem.length; i++) {
			var single = {
					id: orderitem[i].id,
					amount: orderitem[i].qty
			}
			products.push(single);
		}
	}
	var order = { 
			name : name,
			email: email,
			address : address,
			phone : phone,
			info : note,
			products : products
	};
	var xmlhr = new XMLHttpRequest();
	xmlhr.open('POST', $url + '/functions/insertOrder.php', true);
	xmlhr.onload = function(e) {
		if (xmlhr.readyState == 4) {
			if (xmlhr.status == 200) {
				/*$('#warningcontainer').hide();*/
				success(xmlhr.responseText);
			} else {
				fail(xmlhr.statusText);
			}
		}
	};
	var data = new FormData();
	data.append('jsondata', JSON.stringify(order));
	xmlhr.send(data);
	/*$('#warningcontainer').show();
	$('#warningcontainer')
			.html(
					'<strong>Memperbarui daftar pemesanan... </strong><img src="../../assets/ajax-loader.gif" />');*/
}