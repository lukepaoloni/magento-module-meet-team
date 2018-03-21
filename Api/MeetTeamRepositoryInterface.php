<?php
    /**
     * MeetTeamInterface
     *
     * @copyright Copyright © 2018 Kinspeed Ltd. All rights reserved.
     * @author    luke.paoloni@kinspeed.com
     */
    
    
    namespace Kinspeed\MeetTeam\Api;
    
    use Magento\Framework\Api\SearchCriteriaInterface;
    use Kinspeed\MeetTeam\Api\Data\MeetTeamInterface;
    
    interface MeetTeamRepositoryInterface
    {
        /**
         * @param int $id
         * @return \Kinspeed\MeetTeam\Api\Data\MeetTeamInterface
         * @throws \Magento\Framework\Exception\NoSuchEntityException
         */
        public function getById($id);
    
        /**
         * @param \Kinspeed\MeetTeam\Api\Data\MeetTeamInterface $team
         *
         * @return mixed
         */
        public function save( MeetTeamInterface $team);
    
        /**
         * @param \Kinspeed\MeetTeam\Api\Data\MeetTeamInterface $team
         *
         * @return mixed
         */
        public function delete( MeetTeamInterface $team);
    
        /**
         * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
         *
         * @return mixed
         */
        public function getList( SearchCriteriaInterface $searchCriteria);
    }