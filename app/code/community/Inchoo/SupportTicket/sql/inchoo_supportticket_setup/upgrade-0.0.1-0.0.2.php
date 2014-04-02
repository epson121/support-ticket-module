<?php

$installer = $this;
$connection = $installer->getConnection();
$installer->startSetup();
$installer->getConnection()
    ->addColumn($installer->getTable('inchoo_supportticket/ticket'),
    'updated_at',
    array(
        'type' => Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        'nullable' => true,
        'default' => null,
        'comment' => 'Updated at'
    )
);
$installer->endSetup();