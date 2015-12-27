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
};

function checkOrderExist(id) {
	if (sessionStorage.orderList)
	{
		list = JSON.parse(sessionStorage.orderList);
		var isExist = false;
		for (i = 0; i < list.length; i++)
		{
			if (list[i].id == id)
				isExist = true;
		}
		return isExist;
	}
	else return false;
};

function deleteOrder(id){
	if (sessionStorage.orderList)
	{
		list = JSON.parse(sessionStorage.orderList);
		var index = -1;
		for (i = 0; i < list.length; i++)
		{
			if (list[i].id == id)
				index = i;
		}
		if (index != -1)
			list.splice(index,1);
		sessionStorage.orderList = JSON.stringify(list);
		return list.length;
	}
	else return 0;
};

function updateOrderQty(id, qty) {
	if (sessionStorage.orderList) {
		var list = JSON.parse(sessionStorage.orderList);
		for (i = 0; i < list.length; i++)
		{
			if (list[i].id == id)
				list[i].qty = qty;
		}
		sessionStorage.orderList = JSON.stringify(list);
	}
};

function getAllOrder() {
	if (sessionStorage.orderList)
		return JSON.parse(sessionStorage.orderList);
	else
		return null;
};

function getOrderCount() {
	if (sessionStorage.orderList)
	{
		var orderArray = JSON.parse(sessionStorage.orderList);
		return orderArray.length;
	}
	else
		return 0;
}