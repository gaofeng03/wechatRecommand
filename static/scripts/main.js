$(document).ready(function(){
    $('.menu_area ul li')
        .first()
        .click(function(){
            $('.wc_category').slideToggle();
        });

    $('.pop_wc_item').hover(function() {
        $('.pop_more').hide();
        $(this).find('.pop_more').show();
    },function() {
        $(this).find('.pop_more').hide();
    });

    $('.new_wc_title').tip({ direction: 'left' });
    $('.pop_wc_item a').tip({ direction: 'top' });
    $('.detail_holder').find('.item_content').tip({ direction: 'left' });
    $('.slide_area').Dslideder({
        preBtn: '.pre_slide',
        nextBtn: '.next_slide',
        itemClass: '.slide_content_item',
        containerClass: '.slide_content'
    });

    $('.changeRand').bind('click',getRand);
});

function getRand() {
    var _this = $(this);
    _this.unbind();
    var $loaderContainer = $('#loader');
    var $container = $('.rand_module').find('.module_body');
    var template = [
        '<div class="qr_item">',
            '<img src="{ercodeUrl}" alt=""/>',
            '<div class="qr_control">',
                '<span class="wc_name">{wechatname}</span>',
            '</div>',
        '</div>'
    ].join('');

    var sucCb = function(data) {
        var obj = JSON.parse(data);
        var ret = '';

        $.each(obj,function(index,d) {
            var t =  template.replace('{ercodeUrl}', ercodeUrl + d.wechatImgPath);
            t = t.replace('{wechatname}', d.wechatname);
            ret += t;
        });

        $container.html(ret).hide().fadeIn();
    }

    $loaderContainer.show();
    window.setTimeout(function() {
        $.get(baseUrl + 'index.php/home/ajaxRand')
            .success(sucCb)
            .error(function() {

            })
            .complete(function() {
                $loaderContainer.hide();
                _this.bind('click',getRand);
            });

    },500);
}

/*
*   jQuery Tip Plugin
*   Author: Daniel.Wu
 */
(function($) {

    var SELECTOR = '.preview_con';

    var template = [
        '<div class="preview_con">',
        ' <h3>preview</h3>',
        '</div>'
    ].join('');

    var floatCss = {
        'position': 'absolute',
        'height': '150px',
        'width': '150px',
        'background-color': '#333',
        'padding': '5px'
    };

    var setPos = function(left,top) {
        floatCss.left = left;
        floatCss.top = top;

        var tp = $(template).css(floatCss);
        return tp;
    };

    var setDirection = function (posObj,direction) {
        var retLeft = {};
        var retTop = {};

        retLeft['left'] = posObj.left - 190;
        retLeft['right'] = posObj.left + posObj.width;
        retLeft['top'] = posObj.left;
        retLeft['bottom'] = posObj.left;

        retTop['left'] = posObj.top;
        retTop['right'] = posObj.top;
        retTop['top'] = posObj.top + 30;
        retTop['bottom'] = posObj.top + posObj.height;

        return {
            left: retLeft[direction],
            top: retTop[direction]
        };


    };

    $.fn.tip = function(options) {

        var opts = $.extend({}, $.fn.tip.defaults, options);

        return this.each(function() {
            var $this = $(this);

            var posObj = {
                left: $this.offset().left,
                top: $this.offset().top,
                height: $this.height(),
                width: $this.width()
            };

            var targetPos = setDirection(posObj,opts.direction);

            $this.hover(function(e) {

                $(SELECTOR).remove();
                var obj = setPos(targetPos.left,targetPos.top);
                obj.html('<img style="height:150px;width:150px;margin:auto;position: relative;" src="' + $this.attr('ercodePath') + '"/>');
                obj.hide();
                $('body').append(obj);
                obj.fadeIn();
            },function() {
                $(SELECTOR).remove();
            });
        });
    };

    $.fn.tip.defaults = {
        direction: 'right'
    };
})(jQuery);

/*
 *   jQuery Slider Plugin
 *   Author: Daniel.Wu
 */
(function($) {

    var Plugin = Plugin || {};

    Plugin.action = Plugin.action || {};

    Plugin.DOM = Plugin.DOM || {};

    Plugin.opts = {};

    Plugin.template = '<div class="slide_content_item"><img src="{url}" alt=""/>';

    Plugin.event = {
        left: function() {
            Plugin.action.move('left');
        },
        right: function() {
            Plugin.action.move('right');
        }
    };

    Plugin.DOM = {
        slideItem: '',
        slideContainer: ''
    }

    Plugin.current = 0;

    Plugin.action.move = function(direct) {

        if(direct === 'left') {
            if(Plugin.current - 1 < 0)
                return;
            Plugin.current--;
            //var template = '<div class="slide_content_item" style="left:-1024px;"><img src="{url}" alt=""/>';
            var template =
                [
                    '<div class="slide_content_item" style="left:-1024px;">',
                        '<div class="ercode_container">',
                            '<img src="{url}" alt=""/>',
                        '</div>',
                        '<div class="ercode_des">',
                            '<h3>{nick}</h3>',
                            '<p>{des}</p>',
                        '</div>',
                    '</div>'
                ].join('');

            var html = template.replace('{url}',slideData[Plugin.current].url);
            html = html.replace('{nick}',slideData[Plugin.current].name);
            html = html.replace('{des}',slideData[Plugin.current].des);
            $(html).prependTo(Plugin.DOM.slideContainer);
            Plugin.DOM.slideContainer
                .animate({
                    'left': '+=1024px'
                },500,function() {
                    $(Plugin.opts.itemClass).last().remove();
                    Plugin.DOM.slideContainer.css('left',0);
                    $(Plugin.opts.itemClass).last().css('left',0);
                });
        } else if(direct === 'right') {

            if(Plugin.current + 1 > slideData.length) {
                return;
            }
            Plugin.current++;
            var template =
                [
                    '<div class="slide_content_item" style="left:1024px;">',
                    '<div class="ercode_container">',
                    '<img src="{url}" alt=""/>',
                    '</div>',
                    '<div class="ercode_des">',
                    '<h3>{nick}</h3>',
                    '<p>{des}</p>',
                    '</div>',
                    '</div>'
                ].join('');

            var html = template.replace('{url}',slideData[Plugin.current].url);
            html = html.replace('{nick}',slideData[Plugin.current].name);
            html = html.replace('{des}',slideData[Plugin.current].des);

            Plugin.DOM.slideContainer.append(html);
            Plugin.DOM.slideContainer
                .animate({
                    'left': '-1024px'
                },500,function() {
                    $(Plugin.opts.itemClass).first().remove();
                    Plugin.DOM.slideContainer.css('left',0);
                    $(Plugin.opts.itemClass).first().css('left',0);
                });
        }
    }

    Plugin.init = function(opts) {
        Plugin.opts = opts;
        Plugin.renderUI();
        Plugin.bindEvent();
    };

    Plugin.renderUI = function() {
        Plugin.DOM.slideItem = $(Plugin.opts.itemClass);
        Plugin.DOM.slideContainer = $(Plugin.opts.containerClass);

        Plugin.DOM.slideItem.css({
            'float': 'left'
        });
    };

    Plugin.bindEvent = function() {
        $(Plugin.opts.preBtn).bind('click',Plugin.event.left);
        $(Plugin.opts.nextBtn).bind('click',Plugin.event.right);
    };

    $.fn.Dslideder = function(options) {
        var opts = $.extend({}, $.fn.Dslideder.defaults, options);
        Plugin.init(opts);
    };

    $.fn.defaults = {
        preBtn: '',
        nextBtn: '',
        itemClass: '',
        containerClass: ''
    };

})(jQuery);