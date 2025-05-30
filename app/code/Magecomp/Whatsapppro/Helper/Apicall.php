<?php
namespace Magecomp\Whatsapppro\Helper;

use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\ObjectManager;

class Apicall extends \Magento\Framework\App\Helper\AbstractHelper
{
    const XML_PATH_SMSGATEWAY ='whatsapppro/smsgatways/gateway';

    protected $smsgatewaylist;
    protected $_storeManager;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $smsgatewaylist = []
    ) {
        $this->smsgatewaylist = $smsgatewaylist;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    public function getStoreid()
    {
        return $this->_storeManager->getStore()->getId();
    }

    public function getSmsgatewaylist()
    {
        return $this->smsgatewaylist;
    }

    public function getSelectedGateway($storeId=null)
    {
        if(!$storeId)
        {
            $storeId=$this->getStoreid();
        }
        return $this->scopeConfig->getValue(
            self::XML_PATH_SMSGATEWAY,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getSelectedGatewayModel($storeId)
    {
        if ($this->getSelectedGateway($storeId) != '' || $this->getSelectedGateway($storeId) != null) {
            $Selectedgateway = $this->smsgatewaylist[$this->getSelectedGateway($storeId)];
            return ObjectManager::getInstance()->create($Selectedgateway);
        } else {
            return null;
        }
    }
    
    public function callApiUrl($mobilenumbers, $message,$storeId,$json,$dlt=null)
    {
        $curentsmsModel = $this->getSelectedGatewayModel($storeId);

        if ($curentsmsModel == '' || $curentsmsModel == null) {
            return __("You haven't configured the WhatsApp Configuration");
        }

        if (!$curentsmsModel->validateSmsConfig()) {
            return __("Please Configure all WhatsApp Configuration.");
        }
        return $curentsmsModel->callApiUrl($mobilenumbers, $message,$json,$dlt);
    }
}
