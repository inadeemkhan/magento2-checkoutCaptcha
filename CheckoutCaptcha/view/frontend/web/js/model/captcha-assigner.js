/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

/*global alert*/
define([
    'jquery'
], function ($) {
    'use strict';


    /** Override default place order action and add agreement_ids to request */
    return function (paymentData) {
        if (!$('input[name="captcha_string"]').length) {
            return;
        }

        if (paymentData['extension_attributes'] === undefined) {
            paymentData['extension_attributes'] = {};
        }

        paymentData['extension_attributes']['captcha_string'] = $('input[name="captcha_string"]').val();
    };
});
