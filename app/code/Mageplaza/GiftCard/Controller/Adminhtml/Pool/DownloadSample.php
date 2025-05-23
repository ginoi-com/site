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

namespace Mageplaza\GiftCard\Controller\Adminhtml\Pool;

use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Controller\Result\Raw;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Filesystem\Directory\ReadFactory;
use Magento\ImportExport\Controller\Adminhtml\Import as ImportController;
use Magento\Framework\App\Action\HttpGetActionInterface;

/**
 * Class DownloadSample
 * @package Mageplaza\GiftCard\Controller\Adminhtml\Pool
 */
class DownloadSample extends ImportController implements HttpGetActionInterface
{
    /**
     * @var RawFactory
     */
    private $resultRawFactory;

    /**
     * @var FileFactory
     */
    private $fileFactory;

    /**
     * @var ComponentRegistrar
     */
    private $componentRegistrar;

    /**
     * @var ReadFactory
     */
    private $readFactory;

    /**
     * Download constructor.
     *
     * @param Context $context
     * @param FileFactory $fileFactory
     * @param RawFactory $resultRawFactory
     * @param ComponentRegistrar $componentRegistrar
     * @param ReadFactory $readFactory
     */
    public function __construct(
        Context $context,
        FileFactory $fileFactory,
        RawFactory $resultRawFactory,
        ComponentRegistrar $componentRegistrar,
        ReadFactory $readFactory
    ) {
        $this->fileFactory        = $fileFactory;
        $this->resultRawFactory   = $resultRawFactory;
        $this->componentRegistrar = $componentRegistrar;
        $this->readFactory        = $readFactory;

        parent::__construct($context);
    }

    /**
     * Download sample file action
     *
     * @return Raw
     * @throws NoSuchEntityException
     * @throws Exception
     */
    public function execute()
    {
        $fileName         = 'mp_gift_code_pool.csv';
        $moduleDir        = $this->componentRegistrar->getPath(ComponentRegistrar::MODULE, 'Mageplaza_GiftCard');
        $fileAbsolutePath = $moduleDir . '/Files/Sample/' . $fileName;
        $directoryRead    = $this->readFactory->create($moduleDir);
        $filePath         = $directoryRead->getRelativePath($fileAbsolutePath);

        try {
            if (!$directoryRead->isFile($filePath)) {
                throw new NoSuchEntityException(__('There is no file: %file', ['file' => $filePath]));
            }
            $fileContents = $directoryRead->readFile($filePath);

        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage(__('There is no sample file for this entity.'));

            return $this->getResultRedirect();
        }
        $fileSize = isset($directoryRead->stat($filePath)['size']) ? $directoryRead->stat($filePath)['size'] : null;

        return $this->fileFactory->create(
            $fileName,
            $fileContents,
            DirectoryList::VAR_IMPORT_EXPORT,
            'application/octet-stream',
            $fileSize
        );
    }
}
