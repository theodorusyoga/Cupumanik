$url = 'http://localhost/Cupumanik';

$(document).ready(function() {
	check();
	$('#loginbtn').click(function() {
		var xmlhr = new XMLHttpRequest();
		xmlhr.open('POST', $url + '/functions/login.php', true);
		xmlhr.onload = function(e) {
			if (xmlhr.readyState == 4) {
				if (xmlhr.status == 200) {
					alert(xmlhr.responseText);
				} else {
					alert(xmlhr.statusText);
				}
			}
		};
		var data = new FormData();
		data.append('user', 'admin');
		data.append('pass', 'pass@word1');
		xmlhr.send(data);
	});
	
	function check(){
		var xmlhr = new XMLHttpRequest();
		xmlhr.open('POST', $url + '/functions/checklogin.php', true);
		xmlhr.onload = function(e) {
			if (xmlhr.readyState == 4) {
				if (xmlhr.status == 200) {
					$res = xmlhr.responseText;
					if($res == false){
						$('#loginbox').modal('toggle');
					}
				} else {
					alert(xmlhr.statusText);
				}
			}
		};
		var data = new FormData();
		xmlhr.send(data);
	}
});

