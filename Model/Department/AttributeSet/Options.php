<?php
    /**
     * Options
     *
     * @copyright Copyright © 2018 Kinspeed. All rights reserved.
     * @author    Luke Paoloni <luke.paoloni@kinspeed.com>
     */

    namespace Kinspeed\MeetTeam\Model\Department\AttributeSet;
    use Kinspeed\MeetTeam\Model\Department;
    use Magento\Framework\Data\OptionSourceInterface;

    class Options implements OptionSourceInterface
    {

        private $_department;

        public function __construct(Department $department) {
            $this->_department = $department;
        }

        /**
         * Return array of options as value-label pairs
         *
         * @return array Format: array(array('value' => '<value>', 'label' => '<label>'), ...)
         */
        public function toOptionArray()
        {
            $options [] = ['label' => '', 'value' => ''];
            $departments = $this->_department->getData();
            foreach ( $departments as $key => $department ) {
                $options[] = [
                    'label' => $department,
                    'value' => $key
                ];
            }

            return $options;
        }


    }