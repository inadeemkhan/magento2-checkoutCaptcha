define([
        'jquery',
        'Magento_Captcha/js/view/checkout/defaultCaptcha',
        'Magento_Captcha/js/model/captchaList',
        'underscore'
    ],
    function ($, defaultCaptcha, captchaList, _) {
        'use strict';

        return defaultCaptcha.extend({
            /** @inheritdoc */
            initialize: function () {
                var self = this,
                    currentCaptcha;

                this._super();
                currentCaptcha = captchaList.getCaptchaByFormId(this.formId);

                if (currentCaptcha != null) {
                    currentCaptcha.setIsVisible(true);
                    currentCaptcha.setIsRequired(true);
                    this.setCurrentCaptcha(currentCaptcha);

                    _.defer(self.refresh.bind(self));
                }
            },

            /**
             * Refresh captcha.
             */
            refresh: function () {
                this.currentCaptcha.refresh();

                $('input[name="captcha_string"]').each(function() {
                    $(this).val('');
                });
            }
        });
    });
