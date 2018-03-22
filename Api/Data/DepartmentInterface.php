<?php
    /**
     * Copyright © 2018 Kinspeed Ltd. All rights reserved.
     * See COPYING.txt for license details.
     *
     * Developed By: Luke Paoloni
     */
    
    namespace Kinspeed\MeetTeam\Api\Data;
    
    
    interface DepartmentInterface
    {
        /**
         * @return int
         */
        public function getId();
    
        /**
         * @param int $id
         * @return void
         */
        public function setId($id);
        
        public function getDepartment();

    }