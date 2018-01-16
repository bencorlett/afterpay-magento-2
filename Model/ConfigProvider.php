<?php
/**
 * Magento 2 extensions for Afterpay Payment
 *
 * @author Afterpay <steven.gunarso@touchcorp.com>
 * @copyright 2016 Afterpay https://www.afterpay.com.au/
 */
namespace Afterpay\Afterpay\Model;

use Magento\Checkout\Model\ConfigProviderInterface;

/**
 * Class ConfigProvider
 * @package Afterpay\Afterpay\Model
 */
class ConfigProvider implements ConfigProviderInterface
{
    const TERMS_CONDITION_LINK = "https://www.afterpay.com/terms/";
    /**
     * @var Config\Payovertime
     */
    protected $afterpayConfig;

    /**
     * ConfigProvider constructor.
     * @param Config\Payovertime $config
     */
    public function __construct(\Afterpay\Afterpay\Model\Config\Payovertime $config)
    {
        $this->afterpayConfig = $config;
    }

    /**
     * Get config set on JS global variable window.checkoutConfig
     *
     * @return array
     */
    public function getConfig()
    {
        // set default array
        $config = [];

        /**
         * adding config array
         */
        $config = array_merge_recursive($config, [
            'payment' => [
                'afterpay' => [
                    'afterpayJs'        => $this->afterpayConfig->getWebUrl('afterpay.js'),
                    'afterpayReturnUrl' => 'afterpay/payment/response',
                    'redirectMode'      => $this->afterpayConfig->getCheckoutMode(),
                    'paymentAction'     => $this->afterpayConfig->getPaymentAction(),
                    'termsConditionUrl' => self::TERMS_CONDITION_LINK,
                ],
            ],
        ]);

        return $config;
    }
}