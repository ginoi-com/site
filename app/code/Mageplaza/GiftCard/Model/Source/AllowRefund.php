<?php
/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license that is
 * available through the world-wide-web at this URL:
 * https://www.mageplaza.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    Mageplaza
 * @package     Mageplaza_GiftCard
 * @copyright   Copyright (c) Mageplaza (https://www.mageplaza.com/)
 * @license     https://www.mageplaza.com/LICENSE.txt
 */

namespace Mageplaza\GiftCard\Model\Source;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Option\ArrayInterface;

/**
 * Class AllowRefund
 * @package Mageplaza\GiftCard\Model\Source
 */
class AllowRefund extends AbstractModel implements ArrayInterface
{
    const TYPE_ALLOW = '1';
    const TYPE_DENY  = '2';
    const TYPE_FULL  = '3';

    /**
     * Retrieve option array
     *
     * @return string[]
     */
    public static function getOptionArray()
    {
        return [
            self::TYPE_ALLOW => __('Yes'),
            self::TYPE_DENY  => __('No'),
            self::TYPE_FULL  => __('Only Unused')
        ];
    }

    /**
     * Retrieve option array with empty value
     *
     * @return string[]
     */
    public function toOptionArray()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }

        return $result;
    }
}
