<?php
    /**
     * MeetTeamInterface
     *
     * @copyright Copyright © 2018 Kinspeed Ltd. All rights reserved.
     * @author    luke.paoloni@kinspeed.com
     */
    
    
    namespace Kinspeed\MeetTeam\Api\Data;
    
    use Magento\Framework\Api\ExtensibleDataInterface;

    interface MeetTeamInterface extends ExtensibleDataInterface
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
    
        /**
         * @return string
         */
        public function getName();
    
        /**
         * @param string $name
         * @return void
         */
        public function setName($name);
    
        /**
         * @return string
         */
        public function getJobTitle();
    
        /**
         * @param $jobTitle
         * @return void
         */
        public function setJobTitle($jobTitle);
    
        /**
         * @return string
         */
        public function getAboutMe();
    
        /**
         * @param $about
         * @return void
         */
        public function setAboutMe( $about);
    
        /**
         * @return string
         */
        public function getImage();
    
        /**
         * @return void
         */
        public function getExtensionAttributes();
    
        /**
         * @param \Kinspeed\MeetTeam\Api\Data\MeetTeamInterface $extensionAttributes
         * @return void
         */
        public function setExtensionAttributes(MeetTeamInterface $extensionAttributes);
    }