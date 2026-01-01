function Register() {
	var steps = new Array();
	this.username = function(){
		$("#username_error").html('<img src="'+Config.FileURL+'images/checking.gif">');
		var uid = $("input[name=uname]").val();
		if(uid.length < 5){
			UI.alert('Kullanıcı adınız 5 karakterden uzun olmalıdır.');
			$("#username_error").html('<img src="'+Config.FileURL+'images/exclamation.png">');
			steps[0] = 0;
		}else if(uid.length > 12){
			UI.alert('Kullanıcı adınız 12 karakterden uzun olmamalıdır.');
			$("#username_error").html('<img src="'+Config.FileURL+'images/exclamation.png">');
			steps[0] = 0;
		}else{
			$.ajax({
                url: ''+Config.AjaxURL+'?action=checkaccount',
                dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: {account:uid},
                success: function( data, textStatus, jQxhr ){
					if(data == "1"){
						UI.alert('Bu kullanıcı adı kullanılıyor.');
						$("#username_error").html('<img src="'+Config.FileURL+'images/exclamation.png">');
						steps[0] = 0;
					}else{
						$("#username_error").html('<img src="'+Config.FileURL+'images/accept.png">');
						steps[0] = 1;
					}   
                },
                error: function( jqXhr, textStatus, errorThrown ){
                    UI.alert('Kullanıcı adı kontrol edilemiyor.');
					steps[0] = 0;
                }
            });
		}
	};
	
	this.email = function() {
		$("#email_error").html('<img src="'+Config.FileURL+'images/checking.gif" data-tip="Bekleyiniz...">');
		var email = $("input[name=email]").val();
		var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if (filter.test(email)) {
			$("#email_error").html('<img src="'+Config.FileURL+'images/accept.png">');
			steps[1] = 1;
		}else{
			$("#email_error").html('<img src="'+Config.FileURL+'images/exclamation.png">');
			UI.alert('Geçersiz bir email adresi girdiniz.');
			steps[1] = 0;
		}
	};	
	
	this.password1 = function() {
		$("#password_error").html('<img src="'+Config.FileURL+'images/checking.gif">');
		var password = $("input[name=password]").val();
		var number = 0; var upper = 0;
		for(var i = 0;i < password.length; i++){
			if(isNaN(password[i]) && password[i] == password[i].toUpperCase()){
				upper = 1;
			}
			if(!isNaN(password[i])){
				number = 1;
			}
		}
		var filter = /^([a-zA-Z0-9_\*\-])+$/;
		if (!filter.test(password)) { 
			$("#password_error").html('<img src="'+Config.FileURL+'images/exclamation.png">');
			UI.alert('Şifreniz a - Z 0 - 9 _ * -  karakterlerinden oluşabilir.');
			steps[2] = 0;
		}else if(password.length < 5){
			$("#password_error").html('<img src="'+Config.FileURL+'images/exclamation.png">');
			UI.alert('Şifrenizde en az 5 karakterden oluşabilir.');
			steps[2] = 0;
		}else if(password.length > 12){
			$("#password_error").html('<img src="'+Config.FileURL+'images/exclamation.png">');
			UI.alert('Şifrenizde en fazla 12 karakterden oluşabilir.');
			steps[2] = 0;
		}else if(upper == 0){
			$("#password_error").html('<img src="'+Config.FileURL+'images/exclamation.png">');
			UI.alert('Şifrenizde en az 1 büyük harf bulunmalıdır.');
			steps[2] = 0;
		}else if(number == 0){
			$("#password_error").html('<img src="'+Config.FileURL+'images/exclamation.png">');
			UI.alert('Şifrenizde en az 1 rakam bulunmalıdır.');
			steps[2] = 0;
		}else{
			$("#password_error").html('<img src="'+Config.FileURL+'images/accept.png">');
			steps[2] = 1;
		}
	};
	
	this.password2 = function() {
		var password1 = $("input[name=password]").val();
		var password2 = $("input[name=password2]").val();
		if(password1 != password2){
			$("#password2_error").html('<img src="'+Config.FileURL+'images/exclamation.png">');
			UI.alert('Şifreleriniz eşleşmiyor.');
			steps[3] = 0;
		}else{
			$("#password2_error").html('<img src="'+Config.FileURL+'images/accept.png">');
			steps[3] = 1;
		}
	};
	
	this.phone = function() {
		var phone = $("input[name=phonenumber]").val().replace("(", "").replace(")", "").replace(" ", "").replace(" ", "").replace(" ", "").replace(" ", "").replace(" ", "").replace(" ", "");
		if(phone.length != 11 ){
			$("#phone_error").html('<img src="'+Config.FileURL+'images/exclamation.png">');
			UI.alert('Telefon numaranız geçersiz, Girmeniz gereken format  ` 0 (530) 999 99 99 ´ şeklinde olmalıdır.');
			steps[4] = 0;
		}else{
			$("#phone_error").html('<img src="'+Config.FileURL+'images/accept.png">');
			steps[4] = 1;
		}
	};

	this.captcha = function() {
        var captcha = $("input[name=captcha]").val();
        if(captcha.length < 5){
            $("#captcha_error").html('<img src="'+Config.FileURL+'images/exclamation.png">');
            UI.alert('Lütfen resimdeki onay kodunu giriniz.');
            steps[5] = 0;
        }else{
            $("#captcha_error").html('<img src="'+Config.FileURL+'images/accept.png">');
            steps[5] = 1;
        }
	}


    this.send = function() {
        var rCount = 0;
        for (i = 0; i < steps.length; i++) {
            if(steps[i] == 1){
                rCount++;
            }
        }

        if(rCount < 5 ){
            UI.alert('Bütün bilgileri doğru şekilde doldurunuz.');
        }else{

            $("#register-form").submit();

        }
    };

	this.send2 = function() {
		var rCount = 0;
		for (i = 0; i < steps.length; i++) {
			if(steps[i] == 1){
				rCount++;
			}
		}


		if(rCount < 2 ){
			UI.alert('Bütün bilgileri doğru şekilde doldurunuz.');
		}else{

			$("#register-form").submit();

		}
	};
}
