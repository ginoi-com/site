/**
 * Mageplaza
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Mageplaza.com license sliderConfig is
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
var config = {
    paths: {
        'giftCard/design': 'Mageplaza_GiftCard/js/view/design',
        'giftCard/gallery': 'Mageplaza_GiftCard/js/view/image-gallery'
    },
    config: {
        mixins: {
            'Magento_Sales/order/giftoptions_tooltip': {
                'Mageplaza_GiftCard/js/view/order/create': true
            }
        }
    }
};

