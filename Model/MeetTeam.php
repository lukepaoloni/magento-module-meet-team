<?php
    /**
     * MeetTeam
     *
     * @copyright Copyright © 2018 Kinspeed Ltd. All rights reserved.
     * @author    luke.paoloni@kinspeed.com
     */
    
    namespace Kinspeed\MeetTeam\Model;
    
    use Kinspeed\MeetTeam\Api\Data\MeetTeamInterface;
    use Kinspeed\MeetTeam\Api\Data\MeetTeamSearchResultInterface;
    use Magento\Framework\Model\AbstractExtensibleModel;
    

    class MeetTeam extends AbstractExtensibleModel implements MeetTeamInterface
    {
        const NAME = 'full_name';
        const JOB_TITLE = 'job_title';
        const ABOUT = 'about_me';
        const IMAGE_URL = 'team';
        const DEPARTMENT_ID = 'department_id';
        const POSITION = 'position';
        
        protected function _construct ()
        {
            $this->_init(ResourceModel\Team::class);
        }
    
        /**
         * @return string
         */
        public function getName ()
        {
            return $this->_getData(self::NAME);
        }
    
        /**
         * @param string $name
         *
         * @return void
         */
        public function setName ( $name )
        {
            $this->setData(self::NAME);
        }
    
        /**
         * @return string
         */
        public function getJobTitle ()
        {
            return $this->_getData(self::JOB_TITLE);
        }
    
        /**
         * @param $jobTitle
         *
         * @return void
         */
        public function setJobTitle ( $jobTitle )
        {
            $this->setData(self::JOB_TITLE);
        }
    
        /**
         * @return string
         */
        public function getAboutMe ()
        {
            return $this->_getData(self::ABOUT);
        }
    
        /**
         * @param $about
         *
         * @return void
         */
        public function setAboutMe ( $about )
        {
            $this->setData(self::ABOUT);
        }
    
        /**
         * @return string
         */
        public function getImage ()
        {
            return $this->_getData(self::IMAGE_URL);
        }
    
        /**
         * @return \Magento\Framework\Api\ExtensionAttributesInterface
         */
        public function getExtensionAttributes ()
        {
            return $this->_getExtensionAttributes();
        }
    
        /**
         * @param \Kinspeed\MeetTeam\Api\Data\MeetTeamInterface $extensionAttributes
         *
         * @return void
         */
        public function setExtensionAttributes ( MeetTeamInterface $extensionAttributes )
        {
            $this->_setExtensionAttributes($extensionAttributes);
        }
    
        /**
         * @return mixed
         */
        public function getDepartment()
        {
            return null;
        }
    
        public function getDepartments()
        {
            return 'Coming from Model';
        }
    
        public function getPosition()
        {
            return $this->_getData(self::POSITION);
        }
    }