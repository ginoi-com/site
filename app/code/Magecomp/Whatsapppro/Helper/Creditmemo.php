<?php
namespace Magecomp\Whatsapppro\Helper;

use Magento\Store\Model\ScopeInterface;

class Creditmemo extends \Magecomp\Whatsapppro\Helper\Data
{
    // USER TEMPLATE
    const SMS_IS_CUSTOMER_CREDITMEMO_NOTIFICATION = 'usertemplate/usercreditmemo/enable';
    const SMS_CUSTOMER_CREDITMEMO_NOTIFICATION_TEMPLATE = 'usertemplate/usercreditmemo/template';
    const CSID_SMS_CUSTOMER_CREDITMEMO_NOTIFICATION_TEMPLATE = 'usertemplate/usercreditmemo/contentsid';

    //ADMIN TEMPLATE
    const SMS_IS_ADMIN_CREDITMEMO_NOTIFICATION = 'admintemplate/admincreditmemo/enable';
    const SMS_ADMIN_CREDITMEMO_NOTIFICATION_TEMPLATE = 'admintemplate/admincreditmemo/template';
    const CSID_SMS_ADMIN_CREDITMEMO_NOTIFICATION_TEMPLATE = 'admintemplate/admincreditmemo/contentsid';

    public function isCreditmemoNotificationForUser($storeId = null)
    {
        if ($storeId==null) {
            $storeId = $this->getStoreid();
        }
        return $this->isEnabledWhatsapp($storeId) && $this->scopeConfig->getValue(
            self::SMS_IS_CUSTOMER_CREDITMEMO_NOTIFICATION,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getCreditmemoNotificationUserTemplate($storeId = null)
    {
        if ($storeId==null) {
            $storeId = $this->getStoreid();
        }
        if ($this->isEnabledWhatsapp($storeId)) {
            return  $this->scopeConfig->getValue(
                self::SMS_CUSTOMER_CREDITMEMO_NOTIFICATION_TEMPLATE,
                ScopeInterface::SCOPE_STORE,
                $storeId
            );
        }
    }
    public function getCreditmemoSID($storeId = null)
    {
        if ($storeId==null) {
            $storeId = $this->getStoreid();
        }
        if ($this->isEnabledWhatsapp($storeId)) {
            return  $this->scopeConfig->getValue(
                self::CSID_SMS_CUSTOMER_CREDITMEMO_NOTIFICATION_TEMPLATE,
                ScopeInterface::SCOPE_STORE,
                $storeId
            );
        }
    }
    public function getCreditmemoAdminSID($storeId = null)
    {
        if ($storeId==null) {
            $storeId = $this->getStoreid();
        }
        if ($this->isEnabledWhatsapp($storeId)) {
            return  $this->scopeConfig->getValue(
                self::CSID_SMS_ADMIN_CREDITMEMO_NOTIFICATION_TEMPLATE,
                ScopeInterface::SCOPE_STORE,
                $storeId
            );
        }
    }

    public function isCreditmemoNotificationForAdmin($storeId = null)
    {
        if ($storeId==null) {
            $storeId = $this->getStoreid();
        }
        return $this->isEnabledWhatsapp($storeId) && $this->scopeConfig->getValue(
            self::SMS_IS_ADMIN_CREDITMEMO_NOTIFICATION,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getCreditmemoNotificationForAdminTemplate($storeId = null)
    {
        if ($storeId==null) {
            $storeId = $this->getStoreid();
        }
        if ($this->isEnabledWhatsapp($storeId)) {
            return  $this->scopeConfig->getValue(
                self::SMS_ADMIN_CREDITMEMO_NOTIFICATION_TEMPLATE,
                ScopeInterface::SCOPE_STORE,
                $storeId
            );
        }
    }
}
