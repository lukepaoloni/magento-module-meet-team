<?php
/**
 * InstallData
 *
 * @copyright Copyright © 2017 Kinspeed. All rights reserved.
 * @author    luke.paoloni@kinspeed.com
 */

namespace Kinspeed\MeetTeam\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{
    /**
     * Team setup factory
     *
     * @var TeamSetupFactory
     */
    protected $teamSetupFactory;

    /**
     * Init
     *
     * @param TeamSetupFactory $teamSetupFactory
     */
    public function __construct(TeamSetupFactory $teamSetupFactory)
    {
        $this->teamSetupFactory = $teamSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context) //@codingStandardsIgnoreLine
    {
        /** @var TeamSetup $teamSetup */
        $teamSetup = $this->teamSetupFactory->create(['setup' => $setup]);

        $setup->startSetup();

        $teamSetup->installEntities();
        $entities = $teamSetup->getDefaultEntities();
        foreach ($entities as $entityName => $entity) {
            $teamSetup->addEntityType($entityName, $entity);
        }

        $setup->endSetup();
    }
}
