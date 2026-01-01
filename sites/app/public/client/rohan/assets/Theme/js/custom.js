$(document).ready(function() {
		function ScrolClass() {
		if($(this).scrollTop() >= 50) {
			$('.topMenu').addClass('topMenu-fixed');
		} else {
			$('.topMenu').removeClass('topMenu-fixed');
		}
  }
  $(window).scroll(function() {
    ScrolClass();
  });
  $(document).ready(function() {
    ScrolClass();
  });

	$(".buttonDrop").click(function(){
		$("."+$(this).attr("data-class")).toggleClass("active");
		$(this).toggleClass("active");
	});

	$('.tab-button').click(function(){
		$('.tab-button').removeClass('active');
		$(this).addClass('active');
		$('.tab-block').removeClass('active');
		$('#'+$(this).attr('data-tab')).addClass('active');
	});
	$('.tab-button-media').click(function(){
		$('.tab-button-media').removeClass('active');
		$(this).addClass('active');
		$('.tab-block-media').removeClass('active');
		$('#'+$(this).attr('data-tab')).addClass('active');
	});

	$('.toTop').click(function() {
      $('body,html').animate({scrollTop:0},800);
  });

	$('#submit_payment_method').on('submit', function(e){
		e.preventDefault();
		var method = $('#payment_method option:selected').val();
		var pack = $('#pack').val();
		window.location.href = base_url + 'donate/'+encodeURIComponent(method)+'/'+encodeURIComponent(pack);
	});

	var swiper = new Swiper('.swiper-slider', {
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: 'true',
		},
		speed: 1000,
		autoplay: true,
	});

	var swiper = new Swiper('.swiper-carousel-1', {
		slidesPerView: 3,
			spaceBetween: 30,
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
		speed: 1000,
		autoplay: true,
		breakpoints: {
			640: {
				slidesPerView: 2,
				spaceBetween: 20,
			},
			768: {
				slidesPerView: 3,
				spaceBetween: 40,
			},
			1024: {
				slidesPerView: 4,
				spaceBetween: 50,
			},
		}
	});

	if (typeof server_events !== 'undefined') {
		var initEvents = function() {
			var eventBody = $('.eventBody');
			$.each(server_events, function (eventName, event) {
				var eventClass = eventName.replace(/\s/g,'')+'-Event';
				eventBody.append("<li class='top-list "+eventClass+"'><span class='top-event-name'>"+eventName+"</span> <span class='top-event-time eventTime'>-</span></li>")
			});
		}

		var eventUpdate = function() {
			moment.tz.setDefault("Europe/Riga");

			var st = moment();
			var et = moment().endOf('day')

			var todayWeekday = st.day();

			var secondsUntilEndOfDay = moment.duration(et.diff(st)).asSeconds();

			$.each(server_events, function (eventName, event) {

				var eventClass = eventName.replace(/\s/g,'')+'-Event';
				var closestEvent = false;
				var eventDuration = false;
				var firstEvent = false;
				var dayIsSet = false;

				// search for closest time for each event
				$.each(event.times, function(index, time){
					var t = moment(time, 'hh:mm');
					var duration = moment.duration(st.diff(t));
					var diff = duration.asSeconds();

					if((closestEvent == false && diff < 0) || (diff > closestEvent && diff < 0)){
						closestEvent = diff;
						eventDuration = duration;
					}
				});

				// if no event left for today, set first event for next day
				if(eventDuration == false){

					$.each(event.times, function(index, time){
						var h = time.substr(0, 2);
						var m = time.substr(3, 2);
						var t = moment().add(secondsUntilEndOfDay, 'seconds').add({hours: h, minutes: m});
						var duration = moment.duration(st.diff(t));

						eventDuration = duration;

						return false;

					});

				}

				var hours = Math.abs(eventDuration.hours());
				var minutes = Math.abs(eventDuration.minutes());
				var seconds = Math.abs(eventDuration.seconds());

				if(event.days != 0){
					$.each(event.days, function(index, day){

						if(todayWeekday < day){

							var wd = moment().weekday(day-1).add({hours: hours, minutes: minutes, seconds: seconds});

							var duration = moment.duration(st.diff(wd));

							eventDuration = duration;

							dayIsSet = true;

							return false;
						}

					});

					if(dayIsSet == false){
						$.each(event.days, function(index, day){
								var wd = moment().day(7+day).add({hours: hours, minutes: minutes, seconds: seconds});
								var duration = moment.duration(st.diff(wd));
								eventDuration = duration;
								return false;
						});
					}

				}

				var days = Math.abs(eventDuration.days());

				var eventTime = '';

				if(days > 0)
					eventTime = eventTime + days + 'd ';
				if(hours > 0)
					eventTime = eventTime + hours + 'h ';

				eventTime = eventTime + minutes + 'm ' + seconds + 's';

				var eventTimeString = eventTime;

				var openText = event.openText == true ? '(Opened) ' : '';

				if(days == 0 && hours == 0 && 60 > minutes)
					eventTimeString = "<span style='color:#ffb86b;'>"+eventTime+"</span>";

				if(days == 0 && hours == 0 && 30 > minutes)
					eventTimeString = "<span style='color:#fff548;'>"+eventTime+"</span>";

				if(days == 0 && hours == 0 && event.toOpen > minutes)
					eventTimeString = "<span style='color:#abff29;'>"+openText+eventTime+"</span>";

				$('.'+eventClass).find('span.eventTime').html(eventTimeString);

			});

		};
		initEvents();
		setInterval(eventUpdate, 1000);
	}
});

$.fn.extend({
    switchLanguage: function(lang){
			this.setCookie('dmn_language', lang, 10);
			window.location.reload();
		},
		setCookie: function (key, value, days) {
			var expires = new Date();
			expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
			document.cookie = key + '=' + encodeURIComponent(String(value)) + ';expires=' + expires.toUTCString();
		},
		readCookie: function (key){
			var result;
			return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? (result[1]) : null;
		},
		topPlayers: function(div, server, ml, res, gres, flag){
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: base_url + 'rankings/topPlayersWidget?server='+server,
				success: function (data) {
					if (typeof data !== 'undefined') {
						if (data.error) {
							if ($.isArray(data.error)) {
								$.each(data.error, function (key, val) {
									console.log(val);
								});
							}
							else{
								console.log(data.error);
							}
						}
						else{
							if(data != false){
								html = '';
								if ($.isArray(data)) {
									i = 0;
									$.each(data, function (key, val) {
										i++;
										mlc = '';
										gresc = '';
										flags = '';
										if(ml == 1){
											mlc = '<sup>' + val.mlevel + '</sup>';
										}
										if(gres == 1){
											gresc = '<sup>' + val.gresets + '</sup>';
										}
										if(flag == 1){
											flags += '<span class="f16"><span class="flag ' +val.country[0]+ '"></span></span>';
										}
										html += '<li class="top-list">';
										html += '<span class="top-number">'+ i + '.</span><span class="top-flag">' +flags+ '</span><span class="top-name"><a href="' + base_url + 'info/player/' + val.name + '-id' + val.id +'/' + server + '">' + val.name + '</a></span>';
										html += '<span class="top-lvl">' + val.level + mlc +'</span>';
										if(res == 1){
											html += '<span class="top-lvl">' + val.resets + gresc +'</span>';
										}
										html += '</li>';
									});
								}
								$('#'+div).html(html);
							}
							else{
								$('#'+div).html('No Data');
							}
						}
					}
				}
			});
		},
		topGuilds: function(div, server, display_level){
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: base_url + 'rankings/topGuildsWidget?server='+server,
				success: function (data) {
					if (typeof data !== 'undefined') {
						if (data.error) {
							if ($.isArray(data.error)) {
								$.each(data.error, function (key, val) {
									console.log(val);
								});
							}
							else{
								console.log(data.error);
							}

						}
						else{
							if(data != false){
								html = '';
								if ($.isArray(data)) {
									i = 0;
									$.each(data, function (key, val) {
										i++;
										html += '<li class="top-list">';
										html += '<span class="top-number">' +i+ '. </span><span class="top-name"><a href="' + base_url + 'info/guild/' + val.name + '-id' + val.gid + '/' + server + '">' + val.name + '</a></span>';
										if(display_level == 1){
											html += '<span class="score">' + val.level +'</span>';
										}
										html += '</li>';
									});
								}
								$('#'+div).html(html);
							}
							else{
								$('#'+div).html('No Data');
							}
						}
					}
				}
			});
		},
		initTippy: function(img = false){
			tippy('div.grid-item, div.grid-item-modern, .market_item, span[id^="market_item_"], #inventoryc div', {
        theme: 'item',
        delay: 150,
        interactive: true,
        duration: 500,
        animation: 'scale',
        inertia: true,
				arrow: true,
				hideOnClick: false,
        onShow(instance) {
					instance.setContent('<i class="fa fa-spinner fa-spin"></i> Loading');

					if(instance.state.ajax === undefined){
						instance.state.ajax = {
							isFetching: false,
							canFetch: true,
						}
					}

					if(instance.state.ajax.isFetching || !instance.state.ajax.canFetch){
						return;
					}

					var is_image = '&image=false';
					if(img == true){
						is_image = '&image=true';
					}

					fetch(base_url + 'warehouse/item?id=' + $(instance.reference).data('id') + '&server=' + $(instance.reference).data('server') + is_image)
					.then(function(response){
						return response.json();
					})
					.then(function(json){
						if('error' in json){
							instance.setContent("<span style='color:red;'>" + json.error + "</span>");
						}
						else{
							instance.setContent(json.tooltip);
						}
					})
					.finally(() => {
						instance.state.ajax.isFetching = false;
					})
        },
				onHidden(instance) {
					instance.setContent('<i class="fa fa-spinner fa-spin"></i> Loading');
					instance.state.ajax.canFetch = true;
				},
			});
		}
});

function tamingselect(){
	if(!document.getElementById && !document.createTextNode){
		return;
	}

	// Classes for the link and the visible dropdown
	var ts_selectclass='turnintodropdown'; 	// class to identify selects
	var ts_listclass='turnintoselect';		// class to identify ULs
	var ts_boxclass='dropcontainer'; 		// parent element
	var ts_triggeron='activetrigger'; 		// class for the active trigger link
	var ts_triggeroff='trigger';			// class for the inactive trigger link
	var ts_dropdownclosed='dropdownhidden'; // closed dropdown
	var ts_dropdownopen='dropdownvisible';	// open dropdown
	/*
		Turn all selects into DOM dropdowns
	*/
	var count=0;
	var toreplace=new Array();
	var sels=document.getElementsByTagName('select');
	for(var i=0;i<sels.length;i++){
		if (ts_check(sels[i],ts_selectclass))
		{
			var hiddenfield=document.createElement('input');
			hiddenfield.name=sels[i].name;
			hiddenfield.type='hidden';
			hiddenfield.id=sels[i].id;
			hiddenfield.value=sels[i].options[0].value;
			sels[i].parentNode.insertBefore(hiddenfield,sels[i])
			var trigger=document.createElement('a');
			ts_addclass(trigger,ts_triggeroff);
			trigger.href='#';
			trigger.onclick=function(){
				ts_swapclass(this,ts_triggeroff,ts_triggeron)
				ts_swapclass(this.parentNode.getElementsByTagName('ul')[0],ts_dropdownclosed,ts_dropdownopen);
				return false;
			}
			trigger.appendChild(document.createTextNode(sels[i].options[0].text));
			sels[i].parentNode.insertBefore(trigger,sels[i]);
			var replaceUL=document.createElement('ul');
			for(var j=0;j<sels[i].getElementsByTagName('option').length;j++)
			{
				var newli=document.createElement('li');
				var newa=document.createElement('a');
				newli.v=sels[i].getElementsByTagName('option')[j].value;
				newli.elm=hiddenfield;
				newli.istrigger=trigger;
				newa.href='#';
				newa.appendChild(document.createTextNode(
				sels[i].getElementsByTagName('option')[j].text));
				newli.onclick=function(){
					this.elm.value=this.v;
					ts_swapclass(this.istrigger,ts_triggeron,ts_triggeroff);
					ts_swapclass(this.parentNode,ts_dropdownopen,ts_dropdownclosed)
					this.istrigger.firstChild.nodeValue=this.firstChild.firstChild.nodeValue;
					return false;
				}
				newli.appendChild(newa);
				replaceUL.appendChild(newli);
			}
			ts_addclass(replaceUL,ts_dropdownclosed);
			var div=document.createElement('div');
			div.appendChild(replaceUL);
			ts_addclass(div,ts_boxclass);
			sels[i].parentNode.insertBefore(div,sels[i])
			toreplace[count]=sels[i];
			count++;
		}
	}

	/*
		Turn all ULs with the class defined above into dropdown navigations
	*/

	var uls=document.getElementsByTagName('ul');
	for(var i=0;i<uls.length;i++)
	{
		if(ts_check(uls[i],ts_listclass))
		{
			var newform=document.createElement('form');
			var newselect=document.createElement('select');
			for(j=0;j<uls[i].getElementsByTagName('a').length;j++)
			{
				var newopt=document.createElement('option');
				newopt.value=uls[i].getElementsByTagName('a')[j].href;
				newopt.appendChild(document.createTextNode(uls[i].getElementsByTagName('a')[j].innerHTML));
				newselect.appendChild(newopt);
			}
			newselect.onchange=function()
			{
				window.location=this.options[this.selectedIndex].value;
			}
			newform.appendChild(newselect);
			uls[i].parentNode.insertBefore(newform,uls[i]);
			toreplace[count]=uls[i];
			count++;
		}
	}
	for(i=0;i<count;i++){
		toreplace[i].parentNode.removeChild(toreplace[i]);
	}
	function ts_check(o,c)
	{
	 	return new RegExp('\\b'+c+'\\b').test(o.className);
	}
	function ts_swapclass(o,c1,c2)
	{
		var cn=o.className
		o.className=!ts_check(o,c1)?cn.replace(c2,c1):cn.replace(c1,c2);
	}
	function ts_addclass(o,c)
	{
		if(!ts_check(o,c)){o.className+=o.className==''?c:' '+c;}
	}
}

window.onload=function()
{
	tamingselect();
	// add more functions if necessary
}