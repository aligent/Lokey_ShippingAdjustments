<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file OSL_LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Mage
 * @package    LKC_ShippingAdjustmentsCore
 * @copyright  Copyright (c) 2009 Lokey Coding, LLC <ip@lokeycoding.com>
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author     Lee Saferite <lee.saferite@lokeycoding.com>
 */


class LKC_ShippingAdjustmentsCore_Model_ShippingMethods
{

    public function toOptionArray()
    {
        $carriers = Mage::getSingleton('shipping/config')->getAllCarriers();

        $methods = array(array('label' => 'All Methods', 'value' => 'ALL'));

        foreach ($carriers as $carrierCode => $carrierModel)
        {
            $carrierMethods = $carrierModel->getAllowedMethods();

            if (!$carrierMethods)
            {
                continue;
            }

            $carrierTitle = Mage::getStoreConfig('carriers/' . $carrierCode . '/title');

            $methods[$carrierCode] = array(
                'label' => $carrierTitle,
                'value' => array(),
            );

            foreach ($carrierMethods as $methodCode => $methodTitle)
            {
                $methods[$carrierCode]['value'][] = array(
                    'value' => $carrierCode . '_' . $methodCode,
                    'label' => '[' . $carrierCode . '] ' . $methodTitle,
                );
            }
        }

        return $methods;
    }

}