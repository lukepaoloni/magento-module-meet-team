<?php

/**
 * Uninstall.php
 *
 * @copyright Copyright © 2017 Kinspeed. All rights reserved.
 * @author    luke.paoloni@kinspeed.com
 */
namespace Kinspeed\MeetTeam\Setup;

use Magento\Framework\Setup\UninstallInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class Uninstall implements UninstallInterface
{
    /**
     * @var array
     */
    protected $tablesToUninstall = [
        TeamSetup::ENTITY_TYPE_CODE . '_entity',
        TeamSetup::ENTITY_TYPE_CODE . '_eav_attribute',
        TeamSetup::ENTITY_TYPE_CODE . '_entity_datetime',
        TeamSetup::ENTITY_TYPE_CODE . '_entity_decimal',
        TeamSetup::ENTITY_TYPE_CODE . '_entity_int',
        TeamSetup::ENTITY_TYPE_CODE . '_entity_text',
        TeamSetup::ENTITY_TYPE_CODE . '_entity_varchar',
        'kinspeed_meetteam_department'
    ];

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function uninstall(SchemaSetupInterface $setup, ModuleContextInterface $context) //@codingStandardsIgnoreLine
    {
        $setup->startSetup();

        foreach ($this->tablesToUninstall as $table) {
            if ($setup->tableExists($table)) {
                $setup->getConnection()->dropTable($setup->getTable($table));
            }
        }

        $setup->endSetup();
    }
}
