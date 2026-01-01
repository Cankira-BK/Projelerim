$(document).ready(function(){
	$(function () {
		$('[data-toggle="tooltip"]').tooltip({
			container: 'body',
			html: true,
		})
	});
	$('[data-toggle="tooltips"]').tooltip({
		template:'<div class="tooltips" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
	});
	$(function() {
		$("#top").click(function() {
			$("html,body").stop().animate({
				scrollTop: "0"
			}, 1000);
		});
	});
	$(window).scroll(function() {
		var uzunluk = $(document).scrollTop();
		if (uzunluk > 300) $("#top").fadeIn(500);
		else {
			$("#top").fadeOut(500);
		}
	});
	$('#snrtr_aramaKutusu').on('keyup',function(){
		var key = $(this).val();
		var url = $(this).data('url');
		if (key.length>3) {
			$.ajax({
				type: 'post',
				url: url+'/Index/Search',
				data: {go:"search",key},
				success: function(response){
					$('#snrtr_aramaSonuc').html(response.response);
					$('#snrtr_aramaSonuc').fadeIn();
				},
				dataType: 'json'
			});
		}else {
			$('#aramaSonuc').fadeOut();
		}
	});
});
