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
    use Magento\Framework\Api\AttributeValueFactory;
    use Magento\Framework\Api\ExtensionAttributesFactory;
    use Magento\Framework\Data\Collection\AbstractDb;
    use Magento\Framework\Exception\LocalizedException;
    use Magento\Framework\Model\AbstractExtensibleModel;
    use Magento\Framework\Model\Context;
    use Magento\Framework\Model\ResourceModel\AbstractResource;
    use Magento\Framework\Registry;

    class MeetTeam extends AbstractExtensibleModel implements MeetTeamInterface

    {

        const NAME = 'full_name';

        const JOB_TITLE = 'job_title';

        const ABOUT = 'about_me';

        const IMAGE_URL = 'team';

        const DEPARTMENT_ID = 'department_id';

        const POSITION = 'position';


        /*
         * @var Kinspeed\MeetTeam\Model\ResourceModel\Team\Collection
         */
        public $teamCollection;
        /**
         * @var \Kinspeed\MeetTeam\Model\ResourceModel\Team\CollectionFactory
         */
        private $teamCollectionFactory;


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

        public function getProcessedAboutMe()
        {

        }

        public function getDepartment()
        {
            return $this->_getData(self::DEPARTMENT_ID);
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

    

        public function getPosition()

        {

            return $this->_getData(self::POSITION);

        }



        /**

         * @return mixed

         */

        public function getDepartmentId()

        {

            return $this->_getData(self::DEPARTMENT_ID);

        }



        public function setDepartmentId($department_id)

        {

            $this->setData(self::DEPARTMENT_ID);

        }

    }