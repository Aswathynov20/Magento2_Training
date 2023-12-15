<?php

namespace RestrictPage\CpageRestrict\Plugin;

use Magento\Cms\Controller\Page\View as CmsPageView;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Message\ManagerInterface;

class CmsPageAccess
{
    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * @var RedirectFactory
     */
    protected $resultRedirectFactory;

    /**
     * @var ManagerInterface
     */
    protected $messageManager;

    public function __construct(
        CustomerSession $customerSession,
        RedirectFactory $resultRedirectFactory,
        ManagerInterface $messageManager
    ) {
        $this->customerSession = $customerSession;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->messageManager = $messageManager;
    }

    public function aroundExecute(CmsPageView $subject, callable $proceed)
    {
        // Get CMS page identifier (page_id) from the request
        $pageId = $subject->getRequest()->getParam('page_id');

        // Check if the page_id is not empty and equals a specific value
        if (!empty($pageId) && in_array($pageId, ['5', '4']) && !$this->customerSession->isLoggedIn()) {
            // Customer is not logged in, redirect to the login page
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('customer/account/login');
            $this->messageManager->addErrorMessage(__('You must be logged in to access this page.'));
            return $resultRedirect;
        }

        // Allow the original execute method to proceed
        return $proceed();
    }
}