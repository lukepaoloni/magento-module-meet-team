<?php
    /**
     * Options
     *
     * @copyright Copyright © 2018 Kinspeed. All rights reserved.
     * @author    Luke Paoloni <luke.paoloni@kinspeed.com>
     */

    namespace Kinspeed\MeetTeam\Model\Department\AttributeSet;
    use Kinspeed\MeetTeam\Model\DepartmentFactory;
    use Magento\Framework\Data\OptionSourceInterface;

    class Options implements OptionSourceInterface
    {

        private $_departmentFactory;

        public function __construct(DepartmentFactory $departmentFactory) {
            $this->_departmentFactory = $departmentFactory;
        }

        /**
         * Return array of options as value-label pairs
         *
         * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
         */
        public function toOptionArray()
        {
            return $this->getOptionArray();
        }
    
        public function getOptionArray()
        {
            $departments = $this->_departmentFactory->create()->getCollection();
            $options = [];
            foreach ($departments->getData() as $department) {
                $options[] = [
                    'label' => $department['name'],
                    'value' => $department['entity_id']
                ];
            }
            return $options;
        }


    }