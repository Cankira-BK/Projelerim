$(document).ready(function(){
  $('#register').on('submit', function(e){
    var url = $('body').data("url");
    var data = $('#register').serialize();
    $.ajax({
      type: 'post',
      url: url+'Register/Register',
      data: data,
      success: function(response){
        if (response.error) {
          Swal.fire({
            title: "Hata!",
            html: response.error,
            type: "error",
          });
          grecaptcha.reset();
        }else {
          Swal.fire({
            title: "BaÅŸarÄ±lÄ±!",
            html: response.success,
            type: "success",
          })
          .then(function() {
            window.location.href = url+"Download";
          });
          $('[name="realName]"').val("");
          $('[name="account_name]"').val("");
          $('[name="e-mail]"').val("");
          $('[name="password]"').val("");
          $('[name="passwordTwo]"').val("");
          $('[name="pinPassword]"').val("");
          $('[name="phone]"').val("");
          $('[name="deleteCode]"').val("");
        }
      },
      dataType: 'json'
    });
    e.preventDefault();
  });
  $('#loginForm').on('submit', function(e){
    var url = $('body').data("url");
    var key = $('#login').data("key");
    grecaptcha.ready(function() {
      grecaptcha.execute(key, {action: 'Login'}).then(function(token) {
        $('[name="g-recaptcha-response"]').val(token);
        var data = $('#loginForm').serialize();
        $.ajax({
          type: 'post',
          url: url+'Login/Login',
          data: data,
          success: function(response){
            if (response.error) {
              Swal.fire({
                title: "Hata!",
                html: response.error,
                type: "error",
              });
            }else {
              Swal.fire({
                title: "BaÅŸarÄ±lÄ±!",
                html: response.success,
                type: "success",
              })
              .then(function() {
                window.location.href = url+"ControlPanel";
              });
              $('[name="account_name"]').val("");
              $('[name="password"]').val("");
              $('[name="pinPassword"]').val("");
            }
          },
          dataType: 'json'
        });
      });
    });
    e.preventDefault();
  });
  $('#login').on('submit', function(e){
    var url = $('body').data("url");
    var key = $('#login').data("key");
    grecaptcha.ready(function() {
      grecaptcha.execute(key, {action: 'Login'}).then(function(token) {
        $('[name="g-recaptcha-response"]').val(token);
        var data = $('#login').serialize();
        $.ajax({
          type: 'post',
          url: url+'Login/Login',
          data: data,
          success: function(response){
            if (response.error) {
              Swal.fire({
                title: "Hata!",
                html: response.error,
                type: "error",
              });
            }else {
              Swal.fire({
                title: "BaÅŸarÄ±lÄ±!",
                html: response.success,
                type: "success",
              })
              .then(function() {
                window.location.href = url+"ControlPanel";
              });
              $('[name="account_name"]').val("");
              $('[name="password"]').val("");
              $('[name="pinPassword"]').val("");
            }
          },
          dataType: 'json'
        });
      });
    });
    e.preventDefault();
  });
  $('#ForgetPassword').on('submit', function(e){
    var url = $('body').data("url");
    var key = $('#ForgetPassword').data("key");
    grecaptcha.ready(function() {
      grecaptcha.execute(key, {action: 'Forget/Password'}).then(function(token) {
        $('[name="g-recaptcha-response"]').val(token);
        var data = $('#ForgetPassword').serialize();
        $.ajax({
          type: 'post',
          url: url+'Forget/ForgetPassword',
          data: data,
          success: function(response){
            if (response.error) {
              Swal.fire({
                title: "Hata!",
                html: response.error,
                type: "error",
              });
            }else {
              Swal.fire({
                title: "BaÅŸarÄ±lÄ±!",
                html: response.success,
                type: "success",
              })
              .then(function() {
                location.reload();
              });
            }
          },
          dataType: 'json'
        });
      });
    });
    e.preventDefault();
  });
  $('#ForgetPasswordChange').on('submit', function(e){
    var url = $('body').data("url");
    var key = $('#ForgetPasswordChange').data("key");
    grecaptcha.ready(function() {
      grecaptcha.execute(key, {action: 'Forget/PasswordChange'}).then(function(token) {
        $('[name="g-recaptcha-response"]').val(token);
        var data = $('#ForgetPasswordChange').serialize();
        $.ajax({
          type: 'post',
          url: url+'Forget/ForgetPasswordChange',
          data: data,
          success: function(response){
            if (response.error) {
              Swal.fire({
                title: "Hata!",
                html: response.error,
                type: "error",
              });
            }else {
              Swal.fire({
                title: "BaÅŸarÄ±lÄ±!",
                html: response.success,
                type: "success",
              })
              .then(function() {
                window.location.href = url+"Login";
              });
            }
          },
          dataType: 'json'
        });
      });
    });
    e.preventDefault();
  });
  $('#ForgetPin').on('submit', function(e){
    var url = $('body').data("url");
    var key = $('#ForgetPin').data("key");
    grecaptcha.ready(function() {
      grecaptcha.execute(key, {action: 'Forget/Pin'}).then(function(token) {
        $('[name="g-recaptcha-response"]').val(token);
        var data = $('#ForgetPin').serialize();
        $.ajax({
          type: 'post',
          url: url+'Forget/ForgetPin',
          data: data,
          success: function(response){
            if (response.error) {
              Swal.fire({
                title: "Hata!",
                html: response.error,
                type: "error",
              });
            }else {
              Swal.fire({
                title: "BaÅŸarÄ±lÄ±!",
                html: response.success,
                type: "success",
              })
              .then(function() {
                location.reload();
              });
            }
          },
          dataType: 'json'
        });
      });
    });
    e.preventDefault();
  });
  $('#ForgetPinChange').on('submit', function(e){
    var url = $('body').data("url");
    var key = $('#ForgetPinChange').data("key");
    grecaptcha.ready(function() {
      grecaptcha.execute(key, {action: 'Forget/PinChange'}).then(function(token) {
        $('[name="g-recaptcha-response"]').val(token);
        var data = $('#ForgetPinChange').serialize();
        $.ajax({
          type: 'post',
          url: url+'Forget/ForgetPinChange',
          data: data,
          success: function(response){
            if (response.error) {
              Swal.fire({
                title: "Hata!",
                html: response.error,
                type: "error",
              });
            }else {
              Swal.fire({
                title: "BaÅŸarÄ±lÄ±!",
                html: response.success,
                type: "success",
              })
              .then(function() {
                window.location.href = url+"Login";
              });
            }
          },
          dataType: 'json'
        });
      });
    });
    e.preventDefault();
  });
  $('#ChangeEmail').on('submit', function(e){
    var url = $('body').data("url");
    var key = $('#ChangeEmail').data("key");
    grecaptcha.ready(function() {
      grecaptcha.execute(key, {action: 'Change/Email'}).then(function(token) {
        $('[name="g-recaptcha-response"]').val(token);
        var data = $('#ChangeEmail').serialize();
        $.ajax({
          type: 'post',
          url: url+'Change/ChangeEmail',
          data: data,
          success: function(response){
            if (response.error) {
              Swal.fire({
                title: "Hata!",
                html: response.error,
                type: "error",
              });
            }else {
              Swal.fire({
                title: "BaÅŸarÄ±lÄ±!",
                html: response.success,
                type: "success",
              })
              .then(function() {
                location.reload();
              });
            }
          },
          dataType: 'json'
        });
      });
    });
    e.preventDefault();
  });
  $('#ChangePassword').on('submit', function(e){
    var url = $('body').data("url");
    var key = $('#ChangePassword').data("key");
    grecaptcha.ready(function() {
      grecaptcha.execute(key, {action: 'Change/Password'}).then(function(token) {
        $('[name="g-recaptcha-response"]').val(token);
        var data = $('#ChangePassword').serialize();
        $.ajax({
          type: 'post',
          url: url+'Change/ChangePassword',
          data: data,
          success: function(response){
            if (response.error) {
              Swal.fire({
                title: "Hata!",
                html: response.error,
                type: "error",
              });
            }else {
              Swal.fire({
                title: "BaÅŸarÄ±lÄ±!",
                html: response.success,
                type: "success",
              })
              .then(function() {
                location.reload();
              });
            }
          },
          dataType: 'json'
        });
      });
    });
    e.preventDefault();
  });
  $('#ChangePin').on('submit', function(e){
    var url = $('body').data("url");
    var key = $('#ChangePin').data("key");
    grecaptcha.ready(function() {
      grecaptcha.execute(key, {action: 'Change/Pin'}).then(function(token) {
        $('[name="g-recaptcha-response"]').val(token);
        var data = $('#ChangePin').serialize();
        $.ajax({
          type: 'post',
          url: url+'Change/ChangePin',
          data: data,
          success: function(response){
            if (response.error) {
              Swal.fire({
                title: "Hata!",
                html: response.error,
                type: "error",
              });
            }else {
              Swal.fire({
                title: "BaÅŸarÄ±lÄ±!",
                html: response.success,
                type: "success",
              })
              .then(function() {
                location.reload();
              });
            }
          },
          dataType: 'json'
        });
      });
    });
    e.preventDefault();
  });
  $('#SendDeleteCode').on('submit', function(e){
    var url = $('body').data("url");
    var key = $('#SendDeleteCode').data("key");
    grecaptcha.ready(function() {
      grecaptcha.execute(key, {action: 'Change/DeleteCode'}).then(function(token) {
        $('[name="g-recaptcha-response"]').val(token);
        var data = $('#SendDeleteCode').serialize();
        $.ajax({
          type: 'post',
          url: url+'Change/SendDeleteCode',
          data: data,
          success: function(response){
            if (response.error) {
              Swal.fire({
                title: "Hata!",
                html: response.error,
                type: "error",
              });
            }else {
              Swal.fire({
                title: "BaÅŸarÄ±lÄ±!",
                html: response.success,
                type: "success",
              })
              .then(function() {
                location.reload();
              });
            }
          },
          dataType: 'json'
        });
      });
    });
    e.preventDefault();
  });
  $('#SendSafeBox').on('submit', function(e){
    var url = $('body').data("url");
    var key = $('#SendSafeBox').data("key");
    grecaptcha.ready(function() {
      grecaptcha.execute(key, {action: 'Change/SafeBox'}).then(function(token) {
        $('[name="g-recaptcha-response"]').val(token);
        var data = $('#SendSafeBox').serialize();
        $.ajax({
          type: 'post',
          url: url+'Change/SendSafeBox',
          data: data,
          success: function(response){
            if (response.error) {
              Swal.fire({
                title: "Hata!",
                html: response.error,
                type: "error",
              });
            }else {
              Swal.fire({
                title: "BaÅŸarÄ±lÄ±!",
                html: response.success,
                type: "success",
              })
              .then(function() {
                location.reload();
              });
            }
          },
          dataType: 'json'
        });
      });
    });
    e.preventDefault();
  });
  $('#TicketAdd').on('submit', function(e){
    var url = $('body').data("url");
    var key = $('#TicketAdd').data("key");
    grecaptcha.ready(function() {
      grecaptcha.execute(key, {action: 'Support/Add'}).then(function(token) {
        $('[name="g-recaptcha-response"]').val(token);
        var data = $('#TicketAdd').serialize();
        $.ajax({
          type: 'post',
          url: url+'Support/TicketAdd',
          data: data,
          success: function(response){
            if (response.error) {
              Swal.fire({
                title: "Hata!",
                html: response.error,
                type: "error",
              });
            }else {
              Swal.fire({
                title: "BaÅŸarÄ±lÄ±!",
                html: response.success,
                type: "success",
              })
              .then(function() {
                window.location.href = url+"Support";
              });
            }
          },
          dataType: 'json'
        });
      });
    });
    e.preventDefault();
  });
  $('#TicketReply').on('submit', function(e){
    var url = $('body').data("url");
    var key = $('#TicketReply').data("key");
    grecaptcha.ready(function() {
      grecaptcha.execute(key, {action: 'Support/View'}).then(function(token) {
        $('[name="g-recaptcha-response"]').val(token);
        var data = $('#TicketReply').serialize();
        $.ajax({
          type: 'post',
          url: url+'Support/TicketReply',
          data: data,
          success: function(response){
            if (response.error) {
              Swal.fire({
                title: "Hata!",
                html: response.error,
                type: "error",
              });
            }else {
              Swal.fire({
                title: "BaÅŸarÄ±lÄ±!",
                html: response.success,
                type: "success",
              })
              .then(function() {
                location.reload();
              });
            }
          },
          dataType: 'json'
        });
      });
    });
    e.preventDefault();
  });
  $('#SaveBug').on('submit', function(e){
    var url = $('body').data("url");
    var key = $('#SaveBug').data("key");
    grecaptcha.ready(function() {
      grecaptcha.execute(key, {action: 'ControlPanel/Bug'}).then(function(token) {
        $('[name="g-recaptcha-response"]').val(token);
        var data = $('#SaveBug').serialize();
        $.ajax({
          type: 'post',
          url: url+'ControlPanel/SaveBug',
          data: data,
          success: function(response){
            if (response.error) {
              Swal.fire({
                title: "Hata!",
                html: response.error,
                type: "error",
              });
            }else {
              Swal.fire({
                title: "BaÅŸarÄ±lÄ±!",
                html: response.success,
                type: "success",
              })
              .then(function() {
                location.reload();
              });
            }
          },
          dataType: 'json'
        });
      });
    });
    e.preventDefault();
  });
  $('#CouponUse').on('submit', function(e){
    var url = $('body').data("url");
    var key = $('#CouponUse').data("key");
    grecaptcha.ready(function() {
      grecaptcha.execute(key, {action: 'Coupon/Index'}).then(function(token) {
        $('[name="g-recaptcha-response"]').val(token);
        var data = $('#CouponUse').serialize();
        $.ajax({
          type: 'post',
          url: url+'Coupon/Control',
          data: data,
          success: function(response){
            if (response.error) {
              Swal.fire({
                title: "Hata!",
                html: response.error,
                type: "error",
              });
            }else {
              Swal.fire({
                title: "BaÅŸarÄ±lÄ±!",
                html: response.success,
                type: "success",
              })
              .then(function() {
                window.location.href = url+'ControlPanel';
              });
            }
          },
          dataType: 'json'
        });
      });
    });
    e.preventDefault();
  });
  $('.phone').mask('(500) 000-0000');
  $('.deleteCode').mask('0000000');
});
$(document).ready(function () {
  var screenSize = $(window).height();
  var compareW = 767;
  if (screenSize > 0 && screenSize < compareW) {
    var fancy_a = 740;
    var fancy_b = 550;
    var fancy_c = "ishopbg-small";
    var fancy_d = "13px";
    var fancy_e = "3px";
    var fancy_f = "13px";
    var fancy_g = 754;
    var fancy_h = 574;
    var fancy_i = 6;
    var fancy_j = 20;
  }
  else
  {
    var fancy_a = 1016;
    var fancy_b = 655;
    var fancy_c = "ishopbg";
    var fancy_d = "16px";
    var fancy_e = "7px";
    var fancy_f = "16px";
    var fancy_g = 1032;
    var fancy_h = 690;
    var fancy_i = 8;
    var fancy_j = 28;
  }
  var fancybox_css = {
    'outer': {'background': null},
    'close': {'background_image': null, 'height': null, 'right': null, 'top': null, 'width': null}
  };
  $('a.itemshop').fancybox({
    'autoDimensions': false,
    'width': fancy_a,
    'height': fancy_b,
    'padding': 0,
    'scrolling': 'yes',
    'overlayColor': '#000',
    'overlayOpacity': 0.8,
    'onStart': function () {
      fancybox_css.outer.background = $('#fancybox-outer').css('background');
      fancybox_css.close.background_image = $('#fancybox-close').css('background-image');
      fancybox_css.close.height = $('#fancybox-close').css('height');
      fancybox_css.close.right = $('#fancybox-close').css('right');
      fancybox_css.close.top = $('#fancybox-close').css('top');
      fancybox_css.close.width = $('#fancybox-close').css('width');
      $('#fancybox-outer').css({'background': 'transparent url("'+$('body').data("url")+'data/extra/'+fancy_c+'.png") center center no-repeat'});
      $('#fancybox-close').css({
        'background-image': 'none',
        'cursor': 'pointer',
        'height': fancy_d,
        'right': '3px',
        'top': fancy_e,
        'width': fancy_f
      });
    },
    'onComplete': function () {
      $('#fancybox-inner').css({'top': fancy_j, 'left': fancy_i});
      $('#fancybox-wrap').css({'width': fancy_g, 'height': fancy_h});
    },
    'onClosed': function () {
      if (null != fancybox_css.outer.background) {
        $('#fancybox-outer').css('background', fancybox_css.outer.background);
      }
      if (null != fancybox_css.close.background_image) {
        $('#fancybox-close').css('background-image', fancybox_css.close.background_image);
      }
      if (null != fancybox_css.close.height) {
        $('#fancybox-close').css('height', fancybox_css.close.height);
      }
      if (null != fancybox_css.close.right) {
        $('#fancybox-close').css('right', fancybox_css.close.right);
      }
      if (null != fancybox_css.close.top) {
        $('#fancybox-close').css('top', fancybox_css.close.top);
      }
      if (null != fancybox_css.close.width) {
        $('#fancybox-close').css('width', fancybox_css.close.width);
      }
    }
  });
});