<?php
/**
 * @author   --   Nadeem Khan
 * @package  --   Magelumen_CheckoutCaptcha
 */

namespace Magelumen\CheckoutCaptcha\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class UpgradeData
 * @package Magento\CheckoutCaptcha\Setup
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     *  @var \Magento\Framework\App\Config\Storage\WriterInterface
     */
    protected $configWriter;

    /**
     * UpgradeData constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param WriterInterface $configWriter
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        WriterInterface $configWriter
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->configWriter = $configWriter;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '1.0.1', '<')) {
            $this->disableLoginFormCaptcha($setup);
        }
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @return $this
     */
    protected function disableLoginFormCaptcha(ModuleDataSetupInterface $setup)
    {
        $currentValue = $this->scopeConfig->getValue('customer/captcha/forms');
        if (strlen($currentValue) > 0) {
            $currentValueArray = explode(',', $currentValue);
            $finalValueArray = array_diff($currentValueArray, ['user_login']);

            if (count($finalValueArray) > 0) {
                $this->configWriter->save('customer/captcha/forms',  implode(',', $finalValueArray));
            } else {
                $this->configWriter->save('customer/captcha/forms',  '');
            }
        }

        return $this;
    }
}
