<?php

/**
 * Webkul_Grid Grid Interface.
 *
 * @category    
 *
 * @author      
 */

namespace FormGrid\CustomerGrid\Api\Data;

interface GridInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    const ENTITY_ID = 'id';
    const TITLE = 'name';
    const CONTENT = 'email';
    const CREATED_AT = 'time_occured';

    /**
     * Get EntityId.
     *
     * @return int
     */
    public function getEntityId();

    /**
     * Set EntityId.
     */
    public function setEntityId($entityId);

    /**
     * Get Title.
     *
     * @return varchar
     */
    public function getTitle();

    /**
     * Set Title.
     */
    public function setTitle($title);

    /**
     * Get Content.
     *
     * @return varchar
     */
    public function getContent();

    /**
     * Set Content.
     */
    public function setContent($content);

    /**
     * Get Publish Date.
     *
     */

    /**
     * Set PublishDate.
     */

    /**
     * Get IsActive.
     *
     */

    /**
     * Set StartingPrice.
     */

    /**
     * Get UpdateTime.
     *
     */

    /**
     * Set UpdateTime.
     */

    /**
     * Get CreatedAt.
     *
     * @return varchar
     */
    public function getCreatedAt();

    /**
     * Set CreatedAt.
     */
    public function setCreatedAt($createdAt);
}