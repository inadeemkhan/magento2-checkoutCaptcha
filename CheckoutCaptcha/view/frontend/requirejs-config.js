/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

var config = {
    config: {
        mixins: {
            'Magento_Checkout/js/action/place-order': {
                'Magelumen_CheckoutCaptcha/js/model/place-order-mixin': true
            },
            'Magento_Checkout/js/action/set-payment-information': {
                'Magelumen_CheckoutCaptcha/js/model/set-payment-information-mixin': true
            }
        }
    }
};
