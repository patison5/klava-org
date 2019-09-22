function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   

    document.cookie = name+'=; Max-Age=-99999999;';  
}



window.onload = function () {

	var btn = document.getElementById('authorisation__btn-js');

	btn.addEventListener('click', function (e) {
		e.preventDefault();

		var form   = document.getElementById('login-form');
		var inputs = document.getElementsByClassName('order__input-text');

		var email = inputs[0].value;
		var pass  = inputs[1].value;

		var formData = new FormData();
			formData.append("email", email);
			formData.append("pass",  pass);

		var request = new XMLHttpRequest();
		request.open('POST', 'http://localhost/klava-org/auth.php');

		// при изменении состояния запроса
	    request.addEventListener('readystatechange', function() {

			if (this.readyState == 4 && this.status == 200) {
				var data;

				if (this.responseText) {
					data = JSON.parse(this.responseText);

					console.log(data)

					if (data.status) {
						document.location.reload(true);
					}
				} else {
					console.warn("get bad data from server");
				}
				
			}
	    });

	     //отправляем запрос на сервер
    	request.send(formData);
	});
}