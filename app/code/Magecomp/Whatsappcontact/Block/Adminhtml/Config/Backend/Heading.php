<?php

namespace Magecomp\Whatsappcontact\Block\Adminhtml\Config\Backend;

use Magento\Config\Block\System\Config\Form\Field;

class Heading extends Field
{

    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return string
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $fieldConfig = $element->getFieldConfig();
        $htmlId = $element->getHtmlId();
        $html = '<tr id="row_' . $htmlId . '">' . '<td class="label" colspan="3">';

        $html .= '<div style="border-bottom: 1px solid #dfdfdf;
        font-size: 15px;
        color: #666;
        border-left: #CCC solid 5px;
        padding: 2px 12px;
        text-align: left !important;
        margin-left: 10%;
        margin-top: 20px;">';
        $html .= $element->getLabel();
        $html .= '</div></td></tr>';

        return $html;
    }
}
