<?php

/**
 * This file is part of the Jumph package.
 *
 * (c) Peter Nijssen
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jumph\Bundle\TimeBundle\Manager;

use Doctrine\Common\Persistence\ObjectManager;
use Jumph\Bundle\TimeBundle\Entity\TimeTracker;
use Knp\Bundle\PaginatorBundle\Definition\PaginatorAware;

class TimeTrackerManager extends PaginatorAware
{

    /**
     * Entity alias
     *
     * @var constant
     */
    const ENTITY_ALIAS = 'tt';

    /**
     * Entity to use
     *
     * @var constant
     */
    const ENTITY_CLASS = 'JumphTimeBundle:TimeTracker';

    /**
     * Object manager
     *
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * Constructor.
     *
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * Find time tracker by id
     *
     * @param int $id project id
     *
     * @return array Array of time trackers
     */
    public function findById($id)
    {
        return $this->objectManager
            ->getRepository(self::ENTITY_CLASS)
            ->find($id);
    }

    /**
     * Find all time trackers
     *
     * @param string $sortField Field to sort by
     * @param string $sortOrder Order of sorting
     *
     * @return array Array of time trackers
     */
    public function findAll($sortField = 'createdAt', $sortOrder = 'DESC')
    {
        return $this->objectManager
            ->createQueryBuilder(self::ENTITY_ALIAS)
            ->select(self::ENTITY_ALIAS)
            ->from(self::ENTITY_CLASS, self::ENTITY_ALIAS)
            ->orderBy(self::ENTITY_ALIAS . "." . $sortField, $sortOrder)
            ->getQuery()
            ->getResult();
    }

    /**
     * Get paginated results.
     *
     * @param int           $page       Current page
     * @param int           $limit      Items per page limit
     * @param array         $sortby     Sorting options
     *
     * @return \Knp\Component\Pager\Pagination\PaginationInterface Returns a filtered paginator
     */
    public function getPaginatedResults($page = 1, $limit = 15, array $sortby = array())
    {
        $qb = $this->objectManager
            ->createQueryBuilder(self::ENTITY_ALIAS)
            ->select(self::ENTITY_ALIAS)
            ->from(self::ENTITY_CLASS, self::ENTITY_ALIAS);

        return $this->getPaginator()->paginate($qb, $page, $limit, $sortby);
    }

    /**
     * Create a time tracker
     *
     * @param TimeTracker $timeTracker
     */
    public function create(TimeTracker $timeTracker)
    {
        $this->objectManager->persist($timeTracker);
        $this->objectManager->flush();
    }

    /**
     * Update a time tracker
     *
     * @param TimeTracker $timeTracker
     */
    public function update(TimeTracker $timeTracker)
    {
        $this->objectManager->persist($timeTracker);
        $this->objectManager->flush();
    }

    /**
     * Delete a time tracker
     *
     * @param TimeTracker $timeTracker
     */
    public function delete(TimeTracker $timeTracker)
    {
        $this->objectManager->remove($timeTracker);
        $this->objectManager->flush();
    }
}
