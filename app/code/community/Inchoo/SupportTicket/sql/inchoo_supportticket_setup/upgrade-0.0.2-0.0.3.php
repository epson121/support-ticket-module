<?php

$installer = $this;
$connection = $installer->getConnection();
$installer->startSetup();
$installer->getConnection()
    ->addColumn($installer->getTable('inchoo_supportticket/ticket'),
    'seen',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_SMALLINT,
        'nullable' => true,
        'default' => 1,
        'comment' => 'Seen'
    )
);
$installer->endSetup();