
// Bootstrap Tooltip Aktifleþtirme
// 04.01.2017
$(function () {
	$('[data-toggle="tooltip"]').tooltip({
	container: 'body',
	html: true,
	})
})


// Þifre Oluþturma Fonksiyonu
// 06.01.2017
function SifreOlustur(sl) {  
	var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";  
	var string_length = sl - 1;  
	var randomstring = '';  
	for (var i=0; i<string_length; i++) 		
	{  
		var rnum = Math.floor(Math.random() * chars.length);  
		randomstring += chars.substring(rnum,rnum+1);  
	}
	randomstring += Math.floor((Math.random() * 10) + 1);
	
	document.getElementById("sifre").value = randomstring; 
	document.getElementById("sifre2").value = randomstring;  
}  

// Karakter Silme Kodu Oluþturma Fonksiyonu
// 06.01.2017
function KodOlustur(sl) {  
	var chars = "0123456789";  
	var string_length = sl;  
	var randomstring = '';  
	for (var i=0; i<string_length; i++) 
	{  
		var rnum = Math.floor(Math.random() * chars.length);  
		randomstring += chars.substring(rnum,rnum+1);  
	}  
	
	document.getElementById("kod").value = randomstring; 
}  

// Þifre Göster / Gizle Fonksiyonu
// 06.01.2017
var sifredurum = 0;
function sifregoster()
{
	if(sifredurum == 0)
	{
		document.getElementById('sifre').type = 'text';
		document.getElementById('sifre2').type = 'text';
		document.getElementById('gosterbtn').className = 'glyphicon glyphicon-eye-close';
		sifredurum = 1;
	}
	else
	{
		document.getElementById('sifre').type = 'password';
		document.getElementById('sifre2').type = 'password';
		document.getElementById('gosterbtn').className = 'glyphicon glyphicon-eye-open';
		sifredurum = 0;
	}
}