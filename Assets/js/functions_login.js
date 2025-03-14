$('.login-content [data-bs-toggle="flip"]').click(function() {
	$('.login-box').toggleClass('flipped');
	return false;
});

document.addEventListener('DOMContentLoaded',function(){
	if (document.querySelector("#formLogin")) {
		let formLogin = document.querySelector("#formLogin");
		formLogin.onsubmit = function(e){
			e.preventDefault();


			let strEmail = document.querySelector('#txtEmail').value;
			let strPassword = document.querySelector('#txtPassword').value;

			if(strEmail == "" || strPassword == "")
			{
				Swal.fire("Por favor", "Escribe usuario y contraseña.", "error");
				return false;
			}else{
				
				var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
				var ajaxUrl = base_url+'/Login/loginUser'; 
				var formData = new FormData(formLogin);
				request.open("POST",ajaxUrl,true);
				request.send(formData);

				request.onreadystatechange = function(){
					if(request.readyState != 4) return;
					if(request.status == 200){
						var objData = JSON.parse(request.responseText);
						if(objData.status)
						{
							window.location = base_url+'/dashboard';
							//window.location.reload(false);
						}else{
							Swal.fire("Atención", objData.msg, "error");
							document.querySelector('#txtPassword').value = "";
						}
					}else{
						Swal.fire("Atención","Error en el proceso", "error");
					}
					
					return false;
				}

				
			}
		}
	}
},false)


document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector("#formLogin")) {
        let formLogin = document.querySelector("#formLogin");

        formLogin.onsubmit = function (e) {
            e.preventDefault();

            let strEmail = document.querySelector('#txtEmail').value.trim();
            let strPassword = document.querySelector('#txtPassword').value.trim();

            // Validación del email con regex
            let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (strEmail === "" || strPassword === "") {
                Swal.fire("Por favor", "Escribe usuario y contraseña.", "error");
                return false;
            } else if (!emailPattern.test(strEmail)) {
                Swal.fire("Error", "Formato de email no válido.", "error");
                return false;
            }

            let request = new XMLHttpRequest();
            let ajaxUrl = base_url + '/Login/loginUser';
            let formData = new FormData(formLogin);
            request.open("POST", ajaxUrl, true);
            request.send(formData);

            request.onreadystatechange = function () {
                if (request.readyState !== 4) return;
                if (request.status === 200) {
                    let objData = JSON.parse(request.responseText);
                    if (objData.status) {
                        window.location = base_url + '/dashboard';
                    } else {
                        Swal.fire("Atención", objData.msg, "error");
                        document.querySelector('#txtPassword').value = "";
                    }
                } else {
                    Swal.fire("Atención", "Error en el proceso", "error");
                }
            }
        }
    }
}, false);

