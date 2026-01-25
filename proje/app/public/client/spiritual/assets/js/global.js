// Twitter















!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");















// Facebook















(function(d, s, id) {







  var js, fjs = d.getElementsByTagName(s)[0];







  if (d.getElementById(id)) return;







  js = d.createElement(s); js.id = id;







  js.src = "sdk.js#xfbml=1&appId=344050019105684&version=v2.0"/*tpa=http://connect.facebook.net/pt_PT/sdk.js#xfbml=1&appId=344050019105684&version=v2.0*/;







  fjs.parentNode.insertBefore(js, fjs);







}(document, 'script', 'facebook-jssdk'));















// Youtube















var youTubeChannelURL = "https://www.youtube.com/channel/UCk3PeFJjdDEuuHigsYoM-TQ";







//optional parameters-----------------------------------------------







var youTubePlaylistURL = "";







var youmaxDefaultTab = "featured";







var youmaxColumns = 1;	







var youmaxWidgetWidth = 480;







//var youmaxWidgetHeight = 1000;







var showFeaturedVideoOnLoad = true;







var showVideoInLightbox = true;







function goClicked() {







	$('#youmax').empty().append(' loading ...');







	youTubeChannelURL=$('#youTubeChannelUrl').val();







	youTubePlaylistURL=$('#youTubePlaylistUrl').val();







	youmaxFeaturedPlaylistId = null;







	prepareYoumax();







}







$(window).load(function(){$('#youmax-header>img').wrap('<a href="'+youTubeChannelURL+'" target="_blank" />');});















// Embed Youtube















$(document).ready(function(){	















	$('#midContentBigForumYoutubeContainer A').each(function(){







		var value = $(this).attr("href");







		value = value.replace('feature=player_embedded&','');







		if (value.match('(http(s)?://)?(www.)?youtube|youtu\.be')) 







		{







			if (value.match('embed')) { youtube_id = value.split(/embed\//)[1].split('"')[0]; }







			else { youtube_id = value.split(/v\/|v=|youtu\.be\//)[1].split(/[?&]/)[0]; }







			value = "http://www.youtube.com/v/"+youtube_id;







			var htmlInput = "<object width=\"450\" height=\"300\"><param name=\"movie\" value=\""+value+"\"></param><param name=\"allowScriptAccess\" value=\"always\"></param><embed src=\""+value+"\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" width=\"450\" height=\"300\"></embed></object>";







			$(this).after("<p>"+htmlInput+"</p>");







		}







	});















});























$(document).ready(function () {







	







	// Get CSRF Cookie Value







	$.fn.crsfCookie = function() {







		return $.cookie("csrf_cookie_name");







	};







	







	// Page Base URL







	jQuery.url = function(url) {







		return jQuery("base").attr("href")+url.substr(1);







	}







	







	// Scroll to Div







	jQuery.fn.extend({







		scrollTo : function(speed, easing)







		{







			return this.each(function(){







				var targetOffset = $(this).offset().top;







				$('html,body').animate({scrollTop: targetOffset}, speed, easing);







			});







		}







	});















	// Get Top Players Ranking







	var getTopPlayersRanking = function() {







		$.get(jQuery.url("/metin2/request/top5jugadores"), function(result) {







			$.each( result.message, function( key, value ) {







				$("#rankings").append(







					"<div class=\"rightsidebarContentName\">" + value.name + "</div>" + "<div class=\"rightsidebarContentLevel\"><font color=\"#4CA34B\"> Lv " + value.level + "</font></div>"







				).hide().fadeIn(400);







			});







		}, "json");







	};







	







	// Get Top Guilds Ranking







	var getTopGuildsRanking = function() {







		$.get(jQuery.url("/metin2/request/top5gremios"), function(result) {







			$.each( result.message, function( key, value ) {







				$("#rankings").append(







					"<div class=\"rightsidebarContentName\">" + value.name + "</div>" + "<div class=\"rightsidebarContentLevel\"><font color=\"#4CA34B\"> Lv " + value.level + "</font></div>"







				).hide().fadeIn(400);







			});







		}, "json");







	};







	







	$("#guilds").click(function(){



		$("#rankings2").show("");



		$("#rankings").hide("");







	});























	$("#players").click(function(){



		$("#rankings").show("");



		$("#rankings2").hide("");



	});







	











	







	// Get Online Players







	







	$.get(jQuery.url("/request/statistic/data/online"), function(result) {







		$("#onlinePlayers").html(result.message).hide().fadeIn(400);







	}, "json");







	







	// Get Online Players 24







	







	$.get(jQuery.url("/request/statistic/data/online_24"), function(result) {







		$("#onlinePlayers24").html(result.message).hide().fadeIn(400);







	}, "json");







	







	// Get Accounts







	







	$.get(jQuery.url("/request/statistic/data/accounts"), function(result) {







		$("#totalAccounts").html(result.message).hide().fadeIn(400);







	}, "json");







	







	// Authentication Sidebar







	







	$("form#leftSideLoginForm").submit(function(e) {







		e.preventDefault();







		







		var $this = $(this);







		var $form = $(e.target);







		var $submitBtn = $this.find("button[type=\"submit\"]");







		







		$($submitBtn).prop("disabled", true);















		var checkInputCsrf = $this.find("input[name=\"csrf_test_name\"]");















		if (checkInputCsrf)







		{







			$("input[name=\"csrf_test_name\"]").remove();







		}







		







		$inputCsrf = $("<input type=\"hidden\" name=\"csrf_test_name\"/>").val($.fn.crsfCookie);







		$($form).append($inputCsrf);







		







		$.post($form.attr("action"), $form.serialize(), function(result) {







			if (result.status == "success"){







				jQuery(window).attr("location", result.message);







			}else{







				$($submitBtn).prop("disabled", false);







				jQuery("#leftSideLoginMessage").html(result.message).hide().fadeIn(800);







			}







		}, "json");







	});







	







	// Snow







	







	//$(document).snowfall("clear");







	//$(document).snowfall({shadow : true, flakeCount:200});







	







});



function kayitol(){ 



var veriler = $('#yenihesap').serialize(); 



$.ajax({ 



type: "POST", 



url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/yenihesap.php", 



data: veriler, 



success:function(cevap){ 



$("#sonuc").html(""+cevap); 



} 



})};



function giris(){ 



var veriler = $('#giris').serialize(); 



$.ajax({ 



type: "POST", 



url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/giris.php", 



data: veriler, 



success:function(cevap){ 



$("#sonuc_giris").html(""+cevap); 



} 



})};



function cikis(){ 



var veriler = $('#cikis').serialize(); 



$.ajax({ 



type: "POST", 



url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/cikis.php", 



data: veriler, 



success:function(cevap){ 



$("#sonuc_cikis").html(""+cevap); 



} 



})};



function sifredegis()
{
	var veriler = $('#sifredegis').serialize(); 
	$.ajax({ 
		type: "POST", 
		url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/sifredegis.php", 
		data: veriler, 
		success:function(cevap){ 
			$("#sonuc").html(""+cevap); 
		} 
	})
};


function phonechange()
{
	var veriler = $('#phonechange').serialize(); 
	$.ajax({ 
		type: "POST", 
		url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/phonechange.php", 
		data: veriler, 
		success:function(cevap){ 
			$("#sonuc").html(""+cevap); 
		} 
	})
};


function smsonay()
{
	var veriler = $('#smsonay').serialize(); 
	$.ajax({ 
		type: "POST", 
		url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/smsonay.php", 
		data: veriler, 
		success:function(cevap){ 
			$("#sonuc").html(""+cevap); 
		} 
	})
};


function macsilonay()
{
	var veriler = $('#macsilonay').serialize(); 
	$.ajax({ 
		type: "POST", 
		url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/macsilonay.php", 
		data: veriler, 
		success:function(cevap){ 
			$("#sonuc").html(""+cevap); 
		} 
	})
};





function maildegis(){ 



var veriler = $('#maildegis').serialize(); 



$.ajax({ 



type: "POST", 



url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/maildegis.php", 



data: veriler, 



success:function(cevap){ 



$("#sonuc").html(""+cevap); 



} 



})};



function silmekod(){ 



var veriler = $('#silmekod').serialize(); 



$.ajax({ 



type: "POST", 



url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/silmekod.php", 



data: veriler, 



success:function(cevap){ 



$("#sonuc").html(""+cevap); 



} 



})};



function smsal(){
	var veriler = $('#smsal').serialize(); 
	$.ajax({ 
		type: "POST", 
		url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/smsal2.php", 
		data: veriler, 
		success:function(cevap){ 
			$("#sonuc").html(""+cevap); 
		} 
	})
};


function depo(){
	var veriler = $('#depo').serialize(); 
	$.ajax({ 
		type: "POST", 
		url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/depo.php", 
		data: veriler, 
		success:function(cevap){ 
			$("#sonuc").html(""+cevap); 
		} 
	})
};




function itemkilitsif(){ 
	var veriler = $('#itemkilitsif').serialize(); 
	$.ajax({ 
		type: "POST", 
		url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/itemkilitsif.php", 
		data: veriler, 
		success:function(cevap){ 
			$("#sonuc").html(""+cevap); 
		}
	})
};


function guvenlik(){ 
	var veriler = $('#guvenlik').serialize(); 
	$.ajax({ 
		type: "POST", 
		url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/guvenlik.php", 
		data: veriler, 
		success:function(cevap){ 
			$("#sonuc").html(""+cevap); 
		}
	})
};

function sunuttumphone(){ 
	var veriler = $('#sunuttumphone').serialize();
	$.ajax({ 
		type: "POST", 
		url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/sunuttumphone.php", 
		data: veriler, 
		success:function(cevap){ 
			$("#sonuc").html(""+cevap);
		}
	})
};

function sunuttum(){ 



var veriler = $('#sunuttum').serialize(); 



$.ajax({ 



type: "POST", 



url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/sunuttum.php", 



data: veriler, 



success:function(cevap){ 



$("#sonuc").html(""+cevap); 



} 



})};

function turnuva(urun){ 



var veriler = $('#turnuva'+urun).serialize(); 



$.ajax({ 



type: "POST", 



url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/turnuva.php", 



data: veriler, 



success:function(cevap){ 



$("#sonuc").html(""+cevap); 



} 



})};

function sgunuttum(){ 



var veriler = $('#sgunuttum').serialize(); 



$.ajax({ 



type: "POST", 



url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/sgunuttum.php", 



data: veriler, 



success:function(cevap){ 



$("#sonuc").html(""+cevap); 



} 



})};



function bug(){ 



var veriler = $('#bug').serialize(); 



$.ajax({ 



type: "POST", 



url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/bug.php", 



data: veriler, 



success:function(cevap){ 



$("#sonuc").html(""+cevap); 



} 



})};



function vstur(urun){ 



var veriler = $('#vstur'+urun).serialize(); 



$.ajax({ 



type: "POST", 



url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/vstur.php", 



data: veriler, 



success:function(cevap){ 



$("#sonuc").html(""+cevap); 



} 



})};
function ajanbul(){ 

var veriler = $('#ajanbul').serialize(); 

$.ajax({ 

type: "POST", 

url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/ajan.php", 

data: veriler, 

success:function(cevap){ 

$("#sonuc").html(""+cevap); 

} 

})};
function itembul(){ 

var veriler = $('#itembul').serialize(); 

$.ajax({ 

type: "POST", 

url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/item.php", 

data: veriler, 

success:function(cevap){ 

$("#sonuc").html(""+cevap); 

} 

})};

function kuponbozdur(){ 



var veriler = $('#kuponbozdur').serialize(); 



$.ajax({ 



type: "POST", 



url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/kuponbozdur.inc.php", 



data: veriler, 



success:function(cevap){ 



$("#sonuc").html(""+cevap); 



} 



})};

function gunuttum(){ 



var veriler = $('#sorucevap').serialize(); 



$.ajax({ 



type: "POST", 



url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/sorucevap.php", 



data: veriler, 



success:function(cevap){ 



$("#sonuc").html(""+cevap); 



} 



})};

function guvenlipckapat(){ 



var veriler = $('#guvenlipc').serialize(); 



$.ajax({ 



type: "POST", 



url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/guvenlipc.php", 



data: veriler, 



success:function(cevap){ 



$("#sonuc").html(""+cevap); 



} 



})};

function ticaretgecmisi(){ 



var veriler = $('#ticgecmis').serialize(); 



$.ajax({ 



type: "POST", 



url: "http://site.m2-need.com/assets/themes/eternia2/js/inc/post/ticgecmis.php", 



data: veriler, 



success:function(cevap){ 



$("#sonuc").html(""+cevap); 



} 



})};