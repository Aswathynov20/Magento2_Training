<?php

namespace RestrictPage\AroundPlugin\Plugin;

use Psr\Log\LoggerInterface;
use Magento\Customer\Model\AccountManagement;

class AccountManagementPlugin
{
    protected $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function aroundAuthenticate(AccountManagement $subject, callable $proceed, $username, $password = null)
    {
        try {
            // Your custom logic before the original method call

            // Call the original method
            $result = $proceed($username, $password);

            // Your custom logic after the original method call, e.g., logging
            $this->logger->info('Customer login attempt: ' . $username);

            return $result;
        } catch (\Exception $e) {
            // Handle exceptions if needed
            $error = 'Error during customer login attempt: ';
            $this->logger->error($error . $username . ' ' . $e->getMessage());

            // You can also log the email if needed
            $this->logger->error('Customer email: ' . $username);

            throw $e;
        }
    }
}