<?php

namespace ErrorLog\ErrorLog404\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\App\Response\Http;
use ErrorLog\ErrorLog404\Model\Log404;

class Log404Observer implements ObserverInterface
{
    protected $logger;
    protected $custom404Log;
    protected $response;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        Log404 $custom404Log,
        Http $response
    ) {
        $this->logger = $logger;
        $this->custom404Log = $custom404Log;
        $this->response = $response;
    }

    public function execute(Observer $observer)
    {
        if ($this->response->getHttpResponseCode() == 404) {
            $request = $observer->getEvent()->getData('request');
            $url = $request->getRequestString();

            // Log 404 request
            $this->logger->info('404 Page Not Found: ' . $url);

            // Check if the URL is already recorded
            $existingRecord = $this->custom404Log->getByUrl($url);

            // Debugging: Uncomment the following lines to check the existing record
            // var_dump($existingRecord);
            // dd();

            if ($existingRecord) {
                // URL already exists, increment the hit count
                $existingRecord->incrementHitCount($url); // pass $url to incrementHitCount
            } else {
                // URL doesn't exist, create a new record
                $newRecord = $this->custom404Log->setData([
                    'url' => $url,
                    'hit_count' => 1, // Set the initial hit count
                ]);
                $newRecord->save();
            }
        }
    }
}