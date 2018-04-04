<?php

/**
 * Department.php
 *
 * @copyright Copyright © 2017 Kinspeed. All rights reserved.
 * @author    luke.paoloni@kinspeed.com
 */

namespace Kinspeed\MeetTeam\Model;

use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractExtensibleModel;
use Magento\Framework\Model\AbstractModel;

class Department extends AbstractExtensibleModel
{
    /**
     * CMS page cache tag
     */
    const CACHE_TAG = 'kinspeed_meetteam_department';
    const NAME = 'name';
    

    /**
     * @var string
     */
    protected $_cacheTag = 'kinspeed_meetteam_department';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'kinspeed_meetteam_department';

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('Kinspeed\MeetTeam\Model\ResourceModel\Department');
    }
    
    public function getName()
    {
        return $this->_getData(self::NAME);
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
    
    public function getDepartments()
    {
        $this->_getData(self::NAME);
    }
    
    public function getDepartment()
    {
        $this->_getData(self::NAME);
    }
}
