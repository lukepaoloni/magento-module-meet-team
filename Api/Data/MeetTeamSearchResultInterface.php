<?php
    /**
     * MeetTeamSearchResultInterface
     *
     * @copyright Copyright © 2018 Kinspeed Ltd. All rights reserved.
     * @author    luke.paoloni@kinspeed.com
     */
    
    
    namespace Kinspeed\MeetTeam\Api\Data;
    
    use Magento\Framework\Api\SearchResultsInterface;

    interface MeetTeamSearchResultInterface extends SearchResultsInterface
    {
        /**
         * @return \Kinspeed\MeetTeam\Api\Data\MeetTeamInterface[]
         */
        public function getItems();
    
        /**
         * @param \Kinspeed\MeetTeam\Api\Data\MeetTeamInterface[] $items
         * @return void
         */
        public function setItems(array $items);
    }