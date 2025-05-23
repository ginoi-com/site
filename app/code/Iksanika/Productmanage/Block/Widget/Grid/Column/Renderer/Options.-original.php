<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Iksanika\Productmanage\Block\Widget\Grid\Column\Renderer;

/**
 * Grid column widget for rendering grid cells that contains mapped values
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Options extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\Text
{
    /**
     * Get options from column
     *
     * @return array
     */
    protected function _getOptions()
    {
        return $this->getColumn()->getOptions();
    }

    /**
     * Render a grid cell as options
     *
     * @param \Magento\Framework\DataObject $row
     * @return string|void
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        // copied from standard Renderer_Select class
        $name = $this->getColumn()->getName() ? $this->getColumn()->getName() : $this->getColumn()->getId();
        $html = '<select name="' . $this->escapeHtml($name) . '" class="admin__control-select" >'; // ' . $this->getColumn()->getValidateClass() . '
        $value = $row->getData($this->getColumn()->getIndex());
        $optionsInitial = $this->getColumn()->getOptions();
        
        if(($this->getColumn()->getData('attribute') && !$this->getColumn()->getData('attribute')->getIsRequired()) ||
            ($this->getColumn()->getData('attribute') && $this->getColumn()->getData('attribute')->getIsRequired() && is_null($value)))
        {
            $optionsInitialRow  =   array('' => '');
            foreach($optionsInitial as $k => $v)
            {
                $optionsInitialRow[$k] = $v;
            }
            $options = $optionsInitialRow;
        }else
        {
            $options = $optionsInitial;
        }
        
        foreach($options as $val => $label)
        {
            $selected = ( ($val == $value && (!is_null($value))) ? ' selected="selected"' : '' );
            $html .= '<option value="' . $this->escapeHtml($val) . '"' . $selected . '>';
            $html .= $this->escapeHtml($label) . '</option>';
        }
        $html.='</select>';
        return $html;
/*
        $options = $this->_getOptions();

        $showMissingOptionValues = (bool)$this->getColumn()->getShowMissingOptionValues();
        if (!empty($options) && is_array($options)) {
            //transform option format
            $output = [];
            foreach ($options as $option) {
                $output[$option['value']] = $option['label'];
            }

            $value = $row->getData($this->getColumn()->getIndex());
            if (is_array($value)) {
                $res = [];
                foreach ($value as $item) {
                    if (isset($output[$item])) {
                        $res[] = $this->escapeHtml($output[$item]);
                    } elseif ($showMissingOptionValues) {
                        $res[] = $this->escapeHtml($item);
                    }
                }
                return implode(', ', $res);
            } elseif (isset($output[$value])) {
                return $this->escapeHtml($output[$value]);
            } elseif (in_array($value, $output)) {
                return $this->escapeHtml($value);
            }
        }
 */
    }




}
