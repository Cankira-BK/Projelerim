$(document).ready(function () {
            var fancybox_css = {
                'outer': {'background': null},
                'close': {'background_image': null, 'height': null, 'right': null, 'top': null, 'width': null}
            };
            $('a.itemshop').fancybox({
                'autoDimensions': false,
                'width': 1016,
                'height': 655,
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
                    $('#fancybox-outer').css({'background': 'transparent url("ishopbg.png") center center no-repeat'});
                    $('#fancybox-close').css({
                        'background-image': 'none',
                        'height': '16px',
                        'right': '3px',
                        'top': '7px',
                        'width': '16px'
                    });
                },
                'onComplete': function () {
                    $('#fancybox-inner').css({'top': 28, 'left': 8});
                    $('#fancybox-wrap').css({'width': 1032, 'height': 690});
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