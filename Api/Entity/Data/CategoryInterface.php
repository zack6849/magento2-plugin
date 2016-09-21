<?php

namespace Springbot\Main\Api\Entity\Data;

/**
 * Interface CategoryInterface
 * @package Springbot\Main\Api\Entity\Data
 */
interface CategoryInterface extends \Magento\Catalog\Api\Data\CategoryInterface
{

    /**
     * @return int
     */
    public function getEntityId();

    /**
     * @return string
     */
    public function getUrlPath();

}
