// JavaScript Document

/*!
 * jQuery Cookie Plugin v1.3
 * https://github.com/carhartl/jquery-cookie
 *
 * Copyright 2011, Klaus Hartl
 * Dual licensed under the MIT or GPL Version 2 licenses.
 * http://www.opensource.org/licenses/mit-license.php
 * http://www.opensource.org/licenses/GPL-2.0
 */
(function ($, document, undefined) {

    var pluses = /\+/g;

    function raw(s) {
        return s;
    }

    function decoded(s) {
        return decodeURIComponent(s.replace(pluses, ' '));
    }

    var config = $.cookie = function (key, value, options) {

        // write
        if (value !== undefined) {
            options = $.extend({}, config.defaults, options);

            if (value === null) {
                options.expires = -1;
            }

            if (typeof options.expires === 'number') {
                var days = options.expires, t = options.expires = new Date();
                t.setDate(t.getDate() + days);
            }

            value = config.json ? JSON.stringify(value) : String(value);

            return (document.cookie = [
                encodeURIComponent(key), '=', config.raw ? value : encodeURIComponent(value),
                options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
                options.path ? '; path=' + options.path : '',
                options.domain ? '; domain=' + options.domain : '',
                options.secure ? '; secure' : ''
            ].join(''));
        }

        // read
        var decode = config.raw ? raw : decoded;
        var cookies = document.cookie.split('; ');
        for (var i = 0, l = cookies.length; i < l; i++) {
            var parts = cookies[i].split('=');
            if (decode(parts.shift()) === key) {
                var cookie = decode(parts.join('='));
                return config.json ? JSON.parse(cookie) : cookie;
            }
        }

        return null;
    };

    config.defaults = {};

    $.removeCookie = function (key, options) {
        if ($.cookie(key) !== null) {
            $.cookie(key, null, options);
            return true;
        }
        return false;
    };

})(jQuery, document);

/* ---------------------------------------------------------------------- */
/* Style Switcher
 /* ---------------------------------------------------------------------- */
(function ($) {

    $.fn.styleSwitcher = function () {

        var ns = $.fn.styleSwitcher;
        var isMobile = Modernizr.touch;
        var status = 'closed';

        var optionName = {
            layout:'layout',
            color:'color',
            wideBgPattern:'wideBgPattern',
            widePTPattern:'widePTPattern',
            boxedBgPattern:'boxedBgPattern',
            boxedPTPattern:'boxedPTPattern'
        };

        var defaultOptions = {
            layout:'boxed',
            color:'blue',
            wideBgPattern:'none',
            widePTPattern:'wide-pt-1',
            boxedBgPattern:'boxed-bg-1',
            boxedPTPattern:'boxed-pt-1'
        };

        function getOption(option) {
            if (isMobile && option === optionName.layout) {
                return 'wide';
            } else {
                var val = $.cookie(option);
                return val ? val : defaultOptions[option];
            }
        }

        function setOption(option, value) {
            $.cookie(option, value);
        }

        var layout;

        var wideOptionsDiv = '<div id="wide-options" style="display: none">' +
            '<h3>Predefined Colors</h3>' +
            '<ul id="wide-predefined-colors" class="colors thumbs' + (isMobile ? ' mobile' : '') + '">' +
            '<li><a id="wide-default-color" href="#" data-color="blue" class="blue active" title="Blue"></a></li>' +
            '<li><a href="#" data-color="blue2" class="blue2" title="Blue2"></a></li>' +
            '<li><a href="#" data-color="green" class="green" title="Green"></a></li>' +
            '<li><a href="#" data-color="retro-green" class="retro-green" title="Retro Green"></a></li>' +
            '<li><a href="#" data-color="teal" class="teal" title="Teal"></a></li>' +
            '<li><a href="#" data-color="red" class="red" title="Red"></a></li>' +
            '<li><a href="#" data-color="pink" class="pink" title="Pink"></a></li>' +
            '<li><a href="#" data-color="purple" class="purple" title="Purple"></a></li>' +
            '<li><a href="#" data-color="orange" class="orange" title="Orange"></a></li>' +
            '<li><a href="#" data-color="yellow" class="yellow" title="Yellow"></a></li>' +
            '</ul>' +
            '<h3>Page Title Patterns</h3>' +
            '<span>(available in the content pages)</span>' +
            '<ul id="wide-pt-patterns" class="pt-patterns thumbs' + (isMobile ? ' mobile' : '') + '">' +
            '<li><a id="wide-default-pt-pattern" href="#" data-bgp="wide-pt-1" class="wide-pt-1"></a></li>' +
            '<li><a href="#" data-bgp="wide-pt-2" class="wide-pt-2"></a></li>' +
            '<li><a href="#" data-bgp="wide-pt-3" class="wide-pt-3"></a></li>' +
            '<li><a href="#" data-bgp="wide-pt-4" class="wide-pt-4"></a></li>' +
            '<li><a href="#" data-bgp="wide-pt-5" class="wide-pt-5"></a></li>' +
            '<li><a href="#" data-bgp="wide-pt-6" class="wide-pt-6"></a></li>' +
            '<li><a href="#" data-bgp="wide-pt-7" class="wide-pt-7"></a></li>' +
            '</ul>' +
            '</div>';

        var boxedOptionsDiv = '<div id="boxed-options">' +
            '<h3>Predefined Colors</h3>' +
            '<ul id="boxed-predefined-colors" class="colors thumbs' + (isMobile ? ' mobile' : '') + '">' +
            '<li><a id="boxed-default-color" href="#" data-color="blue" class="blue active" title="Blue"></a></li>' +
            '<li><a href="#" data-color="blue2" class="blue2" title="Blue2"></a></li>' +
            '<li><a href="#" data-color="green" class="green" title="Green"></a></li>' +
            '<li><a href="#" data-color="retro-green" class="retro-green" title="Retro Green"></a></li>' +
            '<li><a href="#" data-color="teal" class="teal" title="Teal"></a></li>' +
            '<li><a href="#" data-color="red" class="red" title="Red"></a></li>' +
            '<li><a href="#" data-color="pink" class="pink" title="Pink"></a></li>' +
            '<li><a href="#" data-color="purple" class="purple" title="Purple"></a></li>' +
            '<li><a href="#" data-color="orange" class="orange" title="Orange"></a></li>' +
            '<li><a href="#" data-color="yellow" class="yellow" title="Yellow"></a></li>' +
            '</ul>' +
            '<h3>Page Title Patterns</h3>' +
            '<span>(available in the content pages)</span>' +
            '<ul id="boxed-pt-patterns" class="pt-patterns thumbs' + (isMobile ? ' mobile' : '') + '">' +
            '<li><a id="boxed-default-pt-pattern" href="#" data-bgp="boxed-pt-1" class="boxed-pt-1"></a></li>' +
            '<li><a href="#" data-bgp="boxed-pt-2" class="boxed-pt-2"></a></li>' +
            '<li><a href="#" data-bgp="boxed-pt-3" class="boxed-pt-3"></a></li>' +
            '<li><a href="#" data-bgp="boxed-pt-4" class="boxed-pt-4"></a></li>' +
            '<li><a href="#" data-bgp="boxed-pt-5" class="boxed-pt-5"></a></li>' +
            '<li><a href="#" data-bgp="boxed-pt-6" class="boxed-pt-6"></a></li>' +
            '<li><a href="#" data-bgp="boxed-pt-7" class="boxed-pt-7"></a></li>' +
            '</ul>';
        if (!isMobile) {
            boxedOptionsDiv += '<h3>Background Patterns</h3>' +
                '<ul id="boxed-bg-patterns" class="bg-patterns thumbs' + (isMobile ? ' mobile' : '') + '">' +
                '<li><a id="boxed-default-bg-pattern" href="#" data-bgp="boxed-bg-1" class="boxed-bg-1"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-2" class="boxed-bg-2"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-3" class="boxed-bg-3"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-4" class="boxed-bg-4"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-5" class="boxed-bg-5"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-6" class="boxed-bg-6"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-7" class="boxed-bg-7"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-8" class="boxed-bg-8"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-9" class="boxed-bg-9"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-10" class="boxed-bg-10"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-11" class="boxed-bg-11"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-12" class="boxed-bg-12"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-13" class="boxed-bg-13"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-14" class="boxed-bg-14"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-15" class="boxed-bg-15"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-16" class="boxed-bg-16"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-17" class="boxed-bg-17"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-18" class="boxed-bg-18"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-19" class="boxed-bg-19"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-20" class="boxed-bg-20"></a></li>' +
                '<li><a href="#" data-bgp="boxed-bg-21" class="boxed-bg-21"></a></li>' +
                '</ul>';
        }
        boxedOptionsDiv += '</div>';

        var layoutSwitcher = '<div>' +
            '<h3>Layout Styles</h3>' +
            '<div id="layout-switcher">' +
            '<a id="layout-boxed" class="button" href="#">Boxed</a>' +
            '<a id="layout-wide" class="button" href="#">Wide</a>' +
            '</div>' +
            '</div>';

        function loadStyleSwitcher() {
            $('<div id="style-switcher" style="left: -195px">' +
                '<h2>Style Switcher <a href="#"></a></h2>' +
                '<div id="options">' +
                wideOptionsDiv +
                boxedOptionsDiv +
                (isMobile ? '' : layoutSwitcher) +
                '</div>' +
                '<div id="reset"><a href="#" class="button">Reset</a></div>' +
                '</div>').appendTo('body');
            initListeners();
        }

        function applySettings() {
            var layout = getOption(optionName.layout);
            applyLayout(layout === 'wide' ? 'boxed' : 'wide', layout);
            applyColor(getOption(optionName.color));
            applyBgPattern(getOption(optionName[layout + 'BgPattern']));
            applyPTPattern(getOption(optionName[layout + 'PTPattern']));
        }

        function initListeners() {

            // Style Switcher
            $('#style-switcher h2 a').click(function (e) {
                e.preventDefault();
                var div = $('#style-switcher');
                if (status === 'closed') {
                    status = 'opening';
                    div.animate({
                        left:'0px'
                    }, 100, function () {
                        status = 'opened';
                    });
                } else if (status === 'opened') {
                    status = 'closing';
                    div.animate({
                        left:'-195px'
                    }, 100, function () {
                        status = 'closed';
                    });
                }
            });

            $('#layout-wide').bind('click', function () {
                setOption(optionName.layout, 'wide');
                var href = window.location.href;
                if (href.indexOf('index-2.html') >= 0) {
                    window.location.href = href.replace('#', '');
                } else {
                    applySettings();
                }
            });

            $('#layout-boxed').bind('click', function () {
                setOption(optionName.layout, 'boxed');
                var href = window.location.href;
                if (href.indexOf('index-2.html') >= 0) {
                    window.location.href = href.replace('#', '');
                } else {
                    applySettings();
                }
            });

            // Color Switcher
            $(".colors li a").click(function (e) {
                e.preventDefault();
                var color = $(this).data('color');
                applyColor(color);
                setOption(optionName['color'], color);
                return false;

            });

            //Bg Pattern Switcher
            $('.bg-patterns li a').click(function (e) {
                e.preventDefault();
                var bgp = $(this).data('bgp');
                applyBgPattern(bgp);
                setOption(optionName[layout + 'BgPattern'], bgp);
                setOption(optionName[layout + 'BgType'], 'pattern');
                return false;
            });

            //PT Pattern Switcher
            $('.pt-patterns li a').click(function (e) {
                e.preventDefault();
                var bgp = $(this).data('bgp');
                applyPTPattern(bgp);
                setOption(optionName[layout + 'PTPattern'], bgp);
                setOption(optionName[layout + 'PTType'], 'pattern');
                return false;
            });

            $('#reset a').click(function (e) {
                reset();
            });
        }

        function applyLayout(oldLayout, newLayout) {
            if (layout === newLayout) {
                return;
            }
            layout = newLayout;
            if (!isMobile) {
                $('#' + oldLayout + '-options').hide();
                $('#' + newLayout + '-options').show();

                var body = $('body');
                body.removeClass('wide').removeClass('boxed').addClass(newLayout);
                if (newLayout === 'wide') {
                    $('#layout-boxed').removeClass('active');
                    $('#layout-wide').addClass('active');
                } else {
                    $('#layout-wide').removeClass('active');
                    $('#layout-boxed').addClass('active');
                }
            }
        }

        function applyColor(color) {
            $('#' + layout + '-predefined-colors > li > a').each(function () {
                var $this = $(this);
                if ($this.hasClass(color)) {
                    if (!$this.hasClass('active')) {
                        $this.addClass('active');
                    }
                } else {
                    $this.removeClass('active');
                }
            });
            $("#color-style").attr("href", "css/colors/" + color + ".css");
        }

        function applyBgPattern(bgPattern) {
            if (bgPattern === 'none') {
                $('#' + layout + '-bg-patterns').find('a').removeClass('active');
                $('body').css('backgroundImage', 'none');
            } else {
                $('#' + layout + '-bg-patterns > li > a').each(function () {
                    var $this = $(this);
                    if ($this.hasClass(bgPattern)) {
                        $('body').css('backgroundImage', $this.css('backgroundImage'));
                        if (!$this.hasClass('active')) {
                            $this.addClass('active');
                        }
                    } else {
                        $this.removeClass('active');
                    }
                });
            }
        }

        function applyPTPattern(ptPattern) {
            if (ptPattern === 'none') {
//                $('#' + layout + '-bg-patterns').find('a').removeClass('active');
//                $('body').css('backgroundImage', 'none');
            } else {
                $('#' + layout + '-pt-patterns > li > a').each(function () {
                    var $this = $(this);
                    if ($this.hasClass(ptPattern)) {
                        var pageTitle = $('#page-title');
                        if (pageTitle.length > 0) {
                            pageTitle.css('backgroundImage', $this.css('backgroundImage'));
                        }
                        if (!$this.hasClass('active')) {
                            $this.addClass('active');
                        }
                    } else {
                        $this.removeClass('active');
                    }
                });
            }
        }

        function reset() {
            resetColor();
            resetBgPattern();
            resetPTPattern();
        }

        function resetColor() {
            var defaultColor = defaultOptions.color;
            setOption(optionName.color, defaultColor);
            $('#' + layout + '-predefined-colors').find('.active').removeClass('active');
            $('#' + layout + '-default-color').addClass('active');
            $("#color-style").attr("href", "css/colors/" + defaultColor + ".css");
        }

        function resetBgPattern() {
            setOption(optionName.wideBgPattern, defaultOptions.wideBgPattern);
            setOption(optionName.boxedBgPattern, defaultOptions.boxedBgPattern);
            applyBgPattern(defaultOptions[layout + 'BgPattern']);
        }

        function resetPTPattern() {
            setOption(optionName.widePTPattern, defaultOptions.widePTPattern);
            setOption(optionName.boxedPTPattern, defaultOptions.boxedPTPattern);
            applyPTPattern(defaultOptions[layout + 'PTPattern']);
        }

        ns.loadStyleSwitcher = function () {
            loadStyleSwitcher();
            return ns;
        };

        ns.applySettings = function () {
            applySettings();
            return ns;
        };

        return ns;

    };


})(jQuery);