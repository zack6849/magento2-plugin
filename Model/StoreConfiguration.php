<?php

namespace Springbot\Main\Model;

use Magento\Config\Model\ResourceModel\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class StoreConfiguration
 *
 * @package Springbot\Main\Model
 */
class StoreConfiguration
{

    private $config;
    private $scopeConfig;

    /**
     * @param Config               $config
     * @param ScopeConfigInterface $scopeConfigInterface
     */
    public function __construct(
        Config $config,
        ScopeConfigInterface $scopeConfigInterface
    ) {
        $this->config = $config;
        $this->scopeConfig = $scopeConfigInterface;
    }

    /**
     * @param $storeId
     * @return mixed
     */
    public function getSpringbotStoreId($storeId)
    {
        return $this->scopeConfig->getValue($this->makeConfigKey('store_id', $storeId));
    }

    /**
     * @param $storeId
     * @return mixed
     */
    public function getApiToken($storeId)
    {
        return $this->scopeConfig->getValue($this->makeConfigKey('security_token', $storeId));
    }

    /**
     * @param $storeId
     * @return mixed
     */
    public function getGuid($storeId)
    {
        return $this->scopeConfig->getValue($this->makeConfigKey('store_guid', $storeId));
    }

    /**
     * Takes an associative array of variables which will be
     *
     * @param int   $storeId
     * @param array $vars
     */
    public function saveValues($storeId, $vars)
    {
        foreach ($vars as $key => $value) {
            $configKey = $this->makeConfigKey($key, $storeId);
            $this->config->saveConfig($configKey, $value, 'default', 0);
        }
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function saveGlobalValue($key, $value)
    {
        $this->config->saveConfig($this->makeConfigKey($key), $value, 'default', 0);
    }

    /**
     * @param string $configKey
     * @param string $storeId
     * @return string
     */
    private function makeConfigKey($configKey, $storeId = '')
    {
        $configKey = "springbot/configuration/{$configKey}";
        if ($storeId != '') {
            $configKey = "{$configKey}_{$storeId}";
        }
        return $configKey;
    }
}
