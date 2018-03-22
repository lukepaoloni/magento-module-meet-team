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
use Magento\Cms\Model\Template\FilterProvider;

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

    private $filterProvider;
    
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
        FilterProvider $filterProvider,
        array $data = []
    )
    {
        parent::__construct( $context, $data );
        $this->context = $context;
        $this->teamCollectionFactory = $teamCollectionFactory;
        $this->filterProvider = $filterProvider;
    }
    
    /**
     * @return mixed
     */
    public function getTeamMembers()
    {
        $teamCollection = $this->teamCollectionFactory->create()->getCollection();
        $teamCollection->addAttributeToSelect('*');
        $teamCollection->addAttributeToFilter('is_active', '1');
        $teamCollection->addAttributeToSelect('department_id', true);
        $teamCollection->setOrder('position', 'ASC');
        $teamCollection->getSelect()
        ->join(
            ['team_department' => 'kinspeed_meetteam_department'],
            'at_department_id_default.value = team_department.entity_id'
        );

        return $teamCollection;

        //$teamCollection->load();

        return $teamCollection->getSelect()->__toString();


    }

    public function getAboutInfoHtml($member)
    {
        $aboutInfo = $this->filterProvider->getPageFilter()->filter($member->getAboutMe());
        return $aboutInfo;
    }
    
    
}