<?php
/**
 * Meet-the-team
 *
 * @copyright Copyright © 2017 Kinspeed. All rights reserved.
 * @author    luke.paoloni@kinspeed.com
 */

namespace Kinspeed\MeetTeam\Block\Frontend;

use \Magento\Framework\Exception\NoSuchEntityException;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Kinspeed\MeetTeam\Model\TeamFactory;
use \Kinspeed\MeetTeam\Model\MeetTeamFactory;
use \Kinspeed\MeetTeam\Model\DepartmentFactory;
use Magento\Cms\Model\Template\FilterProvider;

class MeetTeam extends Template
{
    
    /**
     * @var \Magento\Framework\View\Element\Template\Context
     */
    private $context;
    /**
     * @var \Kinspeed\MeetTeam\Model\TeamFactory
     */
    private $teamFactory;

    /**
     * @var \Magento\Cms\Model\Template\FilterProvider
     */
    private $filterProvider;
    /**
     * @var \Kinspeed\MeetTeam\Model\DepartmentFactory
     */
    private $departmentFactory;
    /**
     * @var \Kinspeed\MeetTeam\Model\MeetTeamFactory
     */
    private $meetTeamFactory;

    /**
     * MeetTeam constructor.
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param TeamFactory                                      $teamFactory
     * @param \Kinspeed\MeetTeam\Model\MeetTeamFactory         $meetTeamFactory
     * @param \Kinspeed\MeetTeam\Model\DepartmentFactory       $departmentFactory
     * @param \Magento\Cms\Model\Template\FilterProvider       $filterProvider
     * @param array                                            $data
     */
    public function __construct (
        Context $context,
        TeamFactory $teamFactory,
        MeetTeamFactory $meetTeamFactory,
        DepartmentFactory $departmentFactory,
        FilterProvider $filterProvider,
        array $data = []
    )
    {
        $this->context = $context;
        parent::__construct( $context, $data );
        $this->teamFactory = $teamFactory;
        $this->filterProvider = $filterProvider;
        $this->departmentFactory = $departmentFactory;
        $this->meetTeamFactory = $meetTeamFactory;
    }
    
    /**
     * @return mixed
     */
    public function getTeamMembers()
    {
        $collection = $this->teamFactory->create()->getCollection();
        return $collection->getTeamMembersCollection();
    }

    public function getDepartmentNameById($id)
    {
        $department = $this->departmentFactory->create()->load($id, 'entity_id');
        return $department->getData('name');
    }

    public function getImageForTeamMemberById($id)
    {
        $teamMember = $this->teamFactory->create()->load($id);
        $image = $teamMember->getImageSrc();
        return $image;
    }

    public function getMeetTeams()
    {
        $collection = $this->meetTeamFactory->create()->getCollection();
        $collection->addAttributeToSelect('*');
        return $collection;
    }

    /**
     * @param $teamMember
     *
     * @return string
     */
    public function getAboutMeProcessed($teamMember)
    {
        try {
            return $this->filterProvider->getPageFilter()->filter($teamMember->getData('about_me'));
        }
        catch (\Exception $e) {
            $e->getMessage();
        }
    }

    
    
}