<?php
/**
 * TeamSetup
 *
 * @copyright Copyright © 2017 Kinspeed. All rights reserved.
 * @author    luke.paoloni@kinspeed.com
 */

namespace Kinspeed\MeetTeam\Setup;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetup;

/**
 * @codeCoverageIgnore
 */
class TeamSetup extends EavSetup
{
    /**
     * Entity type for Team EAV attributes
     */
    const ENTITY_TYPE_CODE = 'kinspeed_team';

    /**
     * Retrieve Entity Attributes
     *
     * @return array
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function getAttributes()
    {
        $attributes = [];

        $attributes['team'] = [
            'type' => 'varchar',
            'label' => 'Team',
            'input' => 'image',
            'backend' => 'Kinspeed\MeetTeam\Model\Team\Attribute\Backend\Team',
            'required' => false,
            'sort_order' => 99,
            'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
            'group' => 'General',
        ];

        // Add your entity attributes here... For example:
        $attributes['is_active'] = [
            'type' => 'int',
            'label' => 'Is Active',
            'input' => 'select',
            'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
            'sort_order' => 10,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General',
        ];
        $attributes['full_name'] = [
            'type' => 'varchar',
            'label' => 'Full Name',
            'input' => 'text',
            'required' => true, //true/false
            'sort_order' => 20,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General',
            'validate_rules' => 'a:2:{s:15:"max_text_length";i:255;s:15:"min_text_length";i:1;}',
        ];
        $attributes['job_title'] = [
            'type' => 'varchar',
            'label' => 'Job Title',
            'input' => 'text',
            'required' => true, //true/false
            'sort_order' => 30,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General',
            'validate_rules' => 'a:2:{s:15:"max_text_length";i:255;s:15:"min_text_length";i:1;}',
        ];
        $attributes['about_me'] = [
            'type' => 'text',
            'label' => 'About Me',
            'input' => 'textarea',
            'required' => true, //true/false
            'sort_order' => 20,
            'global' => ScopedAttributeInterface::SCOPE_STORE,
            'group' => 'General',
            'wysiwyg_enabled' => true,
        ];
        
        

        return $attributes;
    }

    /**
     * Retrieve default entities: team
     *
     * @return array
     */
    public function getDefaultEntities()
    {
        $entities = [
            self::ENTITY_TYPE_CODE => [
                'entity_model' => 'Kinspeed\MeetTeam\Model\ResourceModel\Team',
                'attribute_model' => 'Kinspeed\MeetTeam\Model\ResourceModel\Eav\Attribute',
                'table' => self::ENTITY_TYPE_CODE . '_entity',
                'increment_model' => null,
                'additional_attribute_table' => self::ENTITY_TYPE_CODE . '_eav_attribute',
                'entity_attribute_collection' => 'Kinspeed\MeetTeam\Model\ResourceModel\Attribute\Collection',
                'attributes' => $this->getAttributes()
            ]
        ];

        return $entities;
    }
}
