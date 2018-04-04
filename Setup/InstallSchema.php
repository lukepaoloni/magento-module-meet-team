<?php
    /**
     * installSchema.php
     *
     * @copyright Copyright © 2017 Kinspeed. All rights reserved.
     * @author    luke.paoloni@kinspeed.com
     */

    namespace Kinspeed\MeetTeam\Setup;

    use Magento\Framework\DB\Ddl\Table;
    use Magento\Framework\Setup\InstallSchemaInterface;
    use Magento\Framework\Setup\ModuleContextInterface;
    use Magento\Framework\Setup\SchemaSetupInterface;
    use Kinspeed\MeetTeam\Setup\EavTablesSetupFactory;

    /**
     * @codeCoverageIgnore
     */
    class InstallSchema implements InstallSchemaInterface
    {
        /**
         * @var EavTablesSetupFactory
         */
        protected $eavTablesSetupFactory;

        /**
         * Init
         *
         * @internal param EavTablesSetupFactory $EavTablesSetupFactory
         */
        public function __construct(EavTablesSetupFactory $eavTablesSetupFactory)
        {
            $this->eavTablesSetupFactory = $eavTablesSetupFactory;
        }

        /**
         * {@inheritdoc}
         * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
         * @SuppressWarnings(PHPMD.UnusedFormalParameter)
         */
        public function install(SchemaSetupInterface $setup, ModuleContextInterface $context
        ) //@codingStandardsIgnoreLine
        {
            $setup->startSetup();
            $departmentTable = $setup->getConnection()
                                     ->newTable($setup->getTable('kinspeed_meetteam_department'))
                                     ->addColumn('entity_id', Table::TYPE_INTEGER, null, [
                                         'identity' => true, 'unsigned' => true, 'nullable' => false,
                                         'primary'  => true
                                     ], 'Entity ID'
                                     )
                                     ->setComment('MeetTeam Departments');
            $departmentTable->addColumn('name', Table::TYPE_TEXT, 255, ['nullable' => false], 'Department Name');
            $setup->getConnection()->createTable($departmentTable);
            
            $tableName = TeamSetup::ENTITY_TYPE_CODE . '_entity';

            /**
             * Create entity Table
             */
            $table = $setup->getConnection()
                           ->newTable($setup->getTable($tableName))
                           ->addColumn(
                               'entity_id',
                               Table::TYPE_INTEGER,
                               null,
                               ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
                               'Entity ID'
                           )->setComment('MeetTeam Entity Table');
            $table->addColumn(
                'is_active',
                Table::TYPE_BOOLEAN,
                null,
                ['nullable' => false, 'unsigned' => true, 'default' => true],
                'Is Active'
            );
            // Add more static attributes here...
            $table->addColumn(
                'created_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT],
                'Creation Time'
            )->addColumn(
                'updated_at',
                Table::TYPE_TIMESTAMP,
                null,
                ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                'Update Time'
            );
            $setup->getConnection()->createTable($table);
            
            /** @var \Kinspeed\MeetTeam\Setup\EavTablesSetup $eavTablesSetup */
            $eavTablesSetup = $this->eavTablesSetupFactory->create(['setup' => $setup]);
            $eavTablesSetup->createEavTables(TeamSetup::ENTITY_TYPE_CODE);
            $setup->endSetup();
        }
    }
