/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'mage/utils/wrapper',
    'Magelumen_CheckoutCaptcha/js/model/captcha-assigner',
    'Magento_Captcha/js/model/captchaList'
], function ($, wrapper, checkoutCaptcha, captchaList) {
    'use strict';

    return function (placeOrderAction) {

        /** Override default place order action and add captcha_string to request */
        return wrapper.wrap(placeOrderAction, function (originalAction, paymentData, messageContainer) {
            checkoutCaptcha(paymentData);

            var response = originalAction(paymentData, messageContainer);
            response.fail(function (result) {
                var currentCaptcha = captchaList.getCaptchaByFormId('co-payment-form');
                currentCaptcha.refresh();
                $('input[name="captcha_string"]').each(function() {
                    $(this).val('');
                });
            });

            return response
        });
    };
});
