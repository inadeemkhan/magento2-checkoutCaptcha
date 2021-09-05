define([
    'jquery',
    'mage/utils/wrapper',
    'Magelumen_CheckoutCaptcha/js/model/captcha-assigner'
], function ($, wrapper, checkoutCaptcha) {
    'use strict';

    return function (placeOrderAction) {

        /** Override place-order-mixin for set-payment-information action as they differs only by method signature */
        return wrapper.wrap(placeOrderAction, function (originalAction, messageContainer, paymentData) {
            checkoutCaptcha(paymentData);

            return originalAction(messageContainer, paymentData);
        });
    };
});
