<?php

namespace Magecomp\Subcategoriesslider\Block;
use \Magento\Backend\Block\Template\Context;

class Color extends \Magento\Config\Block\System\Config\Form\Field
{
    public function __construct(
        Context $context, array $data = []
    )
    {
        parent::__construct($context, $data);
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $html = $element->getElementHtml();
        $value = $element->getData('value');
        $html .= '<script type="text/javascript">
            require(["jquery","jquery/colorpicker/js/colorpicker"], function ($) {
                $(document).ready(function () {
                	var $el = $("#' . $element->getHtmlId() . '");
                    $el.css("backgroundColor", "' . $value . '");
                    $el.ColorPicker({
                    	color: "' . $value . '",
                        onChange: function (hsb, hex, rgb) {
                            $el.css("backgroundColor", "#" + hex).val("#" + hex);
                    	}
                	});
            	});
        	});
	        </script>';
        return $html;
    }
}
