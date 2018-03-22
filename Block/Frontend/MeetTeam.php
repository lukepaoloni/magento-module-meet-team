<?php
/**
 * Meet-the-team
 *
 * @copyright Copyright © 2017 Kinspeed. All rights reserved.
 * @author    luke.paoloni@kinspeed.com
 */

namespace Kinspeed\MeetTeam\Block\Frontend;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Kinspeed\MeetTeam\Model\MeetTeamFactory;

class MeetTeam extends Template
{
    
    /**
     * @var \Magento\Framework\View\Element\Template\Context
     */
    private $context;
    /**
     * @var \Kinspeed\MeetTeam\Model\MeetTeamFactory
     */
    private $teamCollectionFactory;
    
    /**
     * MeetTeam constructor.
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Kinspeed\MeetTeam\Model\MeetTeamFactory         $teamCollectionFactory
     * @param array                                            $data
     */
    public function __construct (
        Context $context,
        MeetTeamFactory $teamCollectionFactory,
        array $data = []
    )
    {
        parent::__construct( $context, $data );
        $this->context = $context;
        $this->teamCollectionFactory = $teamCollectionFactory;
    }
    
    /**
     * @return mixed
     */
    public function getTeamMembers()
    {
        $teamCollection = $this->teamCollectionFactory->create()->getCollection();
        $teamCollection->addAttributeToSelect('*');
        $teamCollection->addAttributeToFilter('is_active', '1');
        $teamCollection->setOrder('position', 'ASC');
        return $teamCollection;
    }
    
    
}