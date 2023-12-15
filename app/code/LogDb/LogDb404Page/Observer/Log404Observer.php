<?php

namespace LogDb\LogDb404Page\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Response\Http;
use LogDb\LogDb404Page\Model\Log404;
use Magento\Framework\App\ResourceConnection;

class Log404Observer implements ObserverInterface
{
    protected $logger;
    protected $custom404Log;
    protected $response;
    protected $resource;

    public function __construct(
        \Psr\Log\LoggerInterface $logger,
        Log404 $custom404Log,
        Http $response,
        ResourceConnection $resource
    ) {
        $this->logger = $logger;
        $this->custom404Log = $custom404Log;
        $this->response = $response;
        $this->resource = $resource;
    }

    public function execute(EventObserver $observer)
    {
        if ($this->response->getHttpResponseCode() == 404) {
            $request = $observer->getEvent()->getData('request');
            $url = $request->getRequestString();

            // Log 404 request
            $this->logger->info('404 Page Not Found: ' . $url);

            // Check if the URL is already recorded
            $existingRecord = $this->get404CountFromDatabase($url);

            if ($existingRecord) {
                // URL already exists, increment the count
                $this->incrementHitCount($url);
            } else {
                // URL doesn't exist, create a new record
                $newRecord = $this->custom404Log->setData([
                    'url' => $url,
                    'count' => 1, // Set the initial  count
                ]);
                $newRecord->save();
            }
        }
    }

    protected function incrementHitCount($url)
    {
        $connection = $this->resource->getConnection();
        $tableName = $connection->getTableName('logdb_log404');

        // Increment the  count directly in the database
        $connection->query(
            "UPDATE {$tableName} SET count = count + 1 WHERE url = :url",
            ['url' => $url]
        );
    }

    protected function get404CountFromDatabase($url)
    {
        $connection = $this->resource->getConnection();
        $tableName = $connection->getTableName('logdb_log404');

        $select = $connection->select()
            ->from($tableName, 'url')
            ->where('url = ?', $url);

        $urlResult = $connection->fetchOne($select);

        return $urlResult !== false ? $urlResult : null;
    }
}