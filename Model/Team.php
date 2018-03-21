<?php

/**
 * Team.php
 *
 * @copyright Copyright © 2017 Kinspeed. All rights reserved.
 * @author    luke.paoloni@kinspeed.com
 */

namespace Kinspeed\MeetTeam\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Registry;
use Kinspeed\MeetTeam\Model\Team\Attribute\Backend\TeamFactory;

class Team extends AbstractModel implements IdentityInterface
{
    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'kinspeed_meetteam_team';

    /**
     * @var string
     */
    protected $_cacheTag = 'kinspeed_meetteam_team';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'kinspeed_meetteam_team';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Kinspeed\MeetTeam\Model\ResourceModel\Team');
    }

    /**
     * Reference constructor.
     * @param TeamFactory $teamFactory
     * @param Context $context
     * @param Registry $registry
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        TeamFactory $teamFactory,
        Context $context,
        Registry $registry,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
        $this->teamFactory = $teamFactory;
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Save from collection data
     *
     * @param array $data
     * @return $this|bool
     */
    public function saveCollection(array $data)
    {
        if (isset($data[$this->getId()])) {
            $this->addData($data[$this->getId()]);
            $this->getResource()->save($this);
        }
        return $this;
    }

    /**
     * Get Team in right format to edit in admin form
     *
     * @return array
     */
    public function getTeamValueForForm()
    {
        $team = $this->teamFactory->create();
        return $team->getFileValueForForm($this);
    }

    /**
     * Get Team Src to display in frontend
     *
     * @return mixed
     */
    public function getImageSrc()
    {
        $team = $this->teamFactory->create();
        return $team->getFileInfo($this)->getUrl();
    }

}
