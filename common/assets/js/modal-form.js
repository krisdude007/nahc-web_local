(function ($) {
    "use strict";

    var pluginName = 'ModalForm';

    /**
     * Retrieves the script tags in document
     * @return {Array}
     */
    var getPageScriptTags = function () {
        var scripts = [];
        jQuery('script[src]').each(function () {
            scripts.push(jQuery(this).attr('src'));
        });
        return scripts;
    };


    /**
     * Retrieves the CSS links in document
     * @return {Array}
     */
    var getPageCssLinks = function () {
        var links = [];
        jQuery('link[rel="stylesheet"]').each(function () {
            links.push(jQuery(this).attr('href'));
        });
        return links;
    };

    function ModalForm(element, options) {
        this.element = element;
        this.init(options);
    };

    ModalForm.prototype.init = function (options) {
        this.selector = options.selector || null;
        this.initalRequestUrl = options.url;
        this.ajaxSubmit = options.ajaxSubmit || true;

        this.captureId = options.captureId;
        this.paramId = options.paramId;

        jQuery(this.element).on('show.bs.modal', this.shown.bind(this));

        if(typeof this.captureId !== 'undefined') {
            jQuery(this.element).on('mfSubmit', this.captureSubmit.bind(this));
        }
    };

    /**
     * Requests the content of the modal and injects it, called after the
     * modal is shown
     */
    ModalForm.prototype.shown = function (event) {
        // Clear original html before loading
        jQuery(this.element).find('.modal-content').html('');

        console.log('ModelForm.shown');
        console.log(this.paramId);

        var button = $(event.relatedTarget);
        var initUrl = this.initalRequestUrl;

        if (typeof this.captureId !== 'undefined') {
            this.captureVal = button.data(this.captureId);
        }

        if (typeof this.paramId !== 'undefined') {
            var paramVal = button.data(this.paramId);
            if(typeof paramVal !== 'undefined') {
                initUrl += '/' + paramVal;
            }
        }

        jQuery.ajax({
            url: initUrl,
            context: this,
            beforeSend: function (xhr, settings) {
                jQuery(this.element).triggerHandler('mfBeforeShow', [xhr, settings]);
            },
            success: function (data, status, xhr) {
                this.injectHtml(data);
                if (this.ajaxSubmit) {
                    jQuery(this.element).off('submit').on('submit', this.formSubmit.bind(this));
                }
                jQuery(this.element).triggerHandler('mfShow', [data, status, xhr, this.selector]);
            }
        });
    };

    ModalForm.prototype.captureSubmit = function (event, data, status, xhr, selector) {
        console.log('ModelForm.captureSubmit');
        console.log(this);
        console.log(status);

        if(status) {
            var sel = $('#' + this.captureVal);

            $.each(data['values'], function (id, text) {
                var option = new Option(text, id);
                console.log(option);
                sel.append($(option));
            });

            console.log(data['new-val']);

            sel.val(data['new-val']).change();
        }
    };

    /**
     * Injects the form of given html into the modal and extecutes css and js
     * @param  {string} html the html to inject
     */
    ModalForm.prototype.injectHtml = function (html) {
        // Find form and inject it
        var form = jQuery(html).filter('form');

        // Remove existing forms
        if (jQuery(this.element).find('form').length > 0) {
            jQuery(this.element).find('form').off().yiiActiveForm('destroy').remove();
        }

        jQuery(this.element).find('.modal-content').html(html);

        var knownScripts = getPageScriptTags();
        var knownCssLinks = getPageCssLinks();
        var newScripts = [];
        var inlineInjections = [];
        var loadedScriptsCount = 0;

        // Find some element to append to
        var headTag = jQuery('head');
        if (headTag.length < 1) {
            headTag = jQuery('body');
            if (headTag.length < 1) {
                headTag = jQuery(document);
            }
        }

        // CSS stylesheets that haven't been added need to be loaded
        jQuery(html).filter('link[rel="stylesheet"]').each(function () {
            var href = jQuery(this).attr('href');

            if (knownCssLinks.indexOf(href) < 0) {
                // Append the CSS link to the page
                headTag.append(jQuery(this).prop('outerHTML'));
                // Store the link so its not needed to be requested again
                knownCssLinks.push(href);
            }
        });

        // Scripts that haven't yet been loaded need to be added to the end of the body
        jQuery(html).filter('script').each(function () {
            var src = jQuery(this).attr("src");

            if (typeof src === 'undefined') {
                // If no src supplied, execute the raw JS (need to execute after the script tags have been loaded)
                inlineInjections.push(jQuery(this).text());
            } else if (knownScripts.indexOf(src) < 0) {
                // Prepare src so we can append GET parameter later
                src += (src.indexOf('?') < 0) ? '?' : '&';
                newScripts.push(src);
            }
        });

        /**
         * Scripts loaded callback
         */
        var scriptLoaded = function () {
            loadedScriptsCount += 1;
            if (loadedScriptsCount === newScripts.length) {
                // Execute inline scripts
                for (var i = 0; i < inlineInjections.length; i += 1) {
                    window.eval(inlineInjections[i]);
                }
            }
        };

        // Load each script tag
        for (var i = 0; i < newScripts.length; i += 1) {
            jQuery.getScript(newScripts[i] + (new Date().getTime()), scriptLoaded);
        }
    };

    /**
     * Adds event handlers to the form to check for submit
     */
    ModalForm.prototype.formSubmit = function () {
        var form = jQuery(this.element).find('form');

        // Convert form to ajax submit
        jQuery.ajax({
            method: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            context: this,
            beforeSend: function (xhr, settings) {
                jQuery(this.element).triggerHandler('mfBeforeSubmit', [xhr, settings]);
            },
            success: function (data, status, xhr) {
                var contentType = xhr.getResponseHeader('content-type') || '';
                if (contentType.indexOf('html') > -1) {
                    // Assume form contains errors if html
                    this.injectHtml(data);
                    status = false;
                }
                jQuery(this.element).triggerHandler('mfSubmit', [data, status, xhr, this.selector]);
            }
        });

        return false;
    };

    $.fn[pluginName] = function (options) {
        return this.each(function () {
            if (!$.data(this, pluginName)) {
                $.data(this, pluginName, new ModalForm(this, options));
            } else {
                $.data(this, pluginName).initalRequestUrl = options.url;
                $.data(this, pluginName).selector = options.selector || null;
                //console.log($.data(this, pluginName).initalRequestUrl);
            }
        });
    };
})(jQuery);



(function ($) {
    $.fn.refreshDataSelect2 = function (data) {

        console.log(this);

        this.select2('data', data);

        console.log(data);

        // Update options
        var $select = $(this);
        var placeholder = $select.children().first();

        console.log(placeholder.prop("outerHTML"));

        // var dataKey = Object.keys(data);
        //
        // console.log(dataKey);
        //
        // var dataKeys = Object.keys(dataKey[0]);
        //
        // console.log(dataKeys);
        //
        // var options = '';
        //
        // for(var k in dataKeys) {
        //     options += '<option value="' + k + '">' + data[k] + '</option>\n';
        // }
        // var options = data.map(function(item) {
        //     return '<option value="' + item.id + '">' + item.text + '</option>';
        // });
        //
        // options.unshift(placeholder.prop("outerHTML"));
        // $select.html(options.join('')).change();
        $select.html('<option value="' + data.id + '">' + data.text + '</option>').change();

        console.log($select);
        console.log(options);
    };
})(jQuery);