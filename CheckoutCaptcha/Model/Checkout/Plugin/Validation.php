<?php
/**
 * @author   --   Nadeem Khan
 * @package  --   Magelumen_CheckoutCaptcha
 */

namespace Magelumen\CheckoutCaptcha\Model\Checkout\Plugin;

use Magento\Captcha\Helper\Data as CaptchaHelper;

/**
 * Class Validation
 * @package Magelumen\CheckoutCaptcha\Model\Checkout\Plugin
 */
class Validation
{
    /**
     * @var \Magento\Captcha\Helper\Data
     */
    protected $helper;

    private $processed = false;

    /**
     * Validation constructor.
     * @param CaptchaHelper $helper
     */
    public function __construct(
        CaptchaHelper $helper
    ) {
        $this->helper = $helper;
    }

    public function beforeSavePaymentInformationAndPlaceOrder(
        \Magento\Checkout\Api\PaymentInformationManagementInterface $subject,
        $cartId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        \Magento\Quote\Api\Data\AddressInterface $billingAddress = null
    ) {
        if ($this->processed) {
            return;
        }
        $this->processed = true;
        $captchaString = $paymentMethod->getExtensionAttributes() === null
            ? []
            : $paymentMethod->getExtensionAttributes()->getCaptchaString();


        if ($captchaString !== null) {
            $captchaModel = $this->helper->getCaptcha('co-payment-form');
            if (!$captchaModel->isCorrect($captchaString)) {
                throw new \Magento\Framework\Exception\CouldNotSaveException(
                    __(
                        "Invalid Captcha"
                    )
                );
            }
        }
    }

    public function beforeSavePaymentInformation(
        \Magento\Checkout\Api\PaymentInformationManagementInterface $subject,
        $cartId,
        \Magento\Quote\Api\Data\PaymentInterface $paymentMethod,
        \Magento\Quote\Api\Data\AddressInterface $billingAddress = null
    ) {
        if ($this->processed) {
            return;
        }
        $this->processed = true;
        $captchaString = $paymentMethod->getExtensionAttributes() === null
            ? []
            : $paymentMethod->getExtensionAttributes()->getCaptchaString();


        if ($captchaString !== null) {
            $captchaModel = $this->helper->getCaptcha('co-payment-form');
            if (!$captchaModel->isCorrect($captchaString)) {
                throw new \Magento\Framework\Exception\CouldNotSaveException(
                    __(
                        "Invalid Captcha"
                    )
                );
            }
        }
    }
}
