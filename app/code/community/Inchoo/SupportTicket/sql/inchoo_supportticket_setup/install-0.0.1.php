<?php

$installer = $this;


$installer->startSetup();


/**
 * Create inchoo_tickets table
 *
 * <ticket_id>
 * <customer_id>
 * <subject>
 * <content>
 * <status> {0: inactive, 1: active}
 * <created_at>
 */

$tableName = $installer->getTable('inchoo_supportticket/ticket');
// Check if the table already exists
if ($installer->getConnection()->isTableExists($tableName) != true) {
    $table = $installer->getConnection()
        ->newTable($installer->getTable('inchoo_supportticket/ticket'))
        ->addColumn('ticket_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity'  => true,
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
        ), 'Ticket Id')
        ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'unsigned'  => true,
            'nullable'  => false,
        ), 'Customer Id')
        ->addColumn('website_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'unsigned'  => true,
            'nullable'  => false,
        ), 'Website Id')
        ->addColumn('subject', Varien_Db_Ddl_Table::TYPE_TEXT, 50, array(
            'nullable'  => false,
        ), 'Subject')
        ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, 250, array(
            'nullable'  => false,
        ), 'Content')
        ->addColumn('status', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
            'unsigned' => true,
            'nullable' => false,
            'default' => '0',
        ), 'Status')
        ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
            'nullable' => false,
            'default' => now()
        ), 'Created At')
        ->addForeignKey(
            $installer->getFkName(
                'inchoo_supportticket/ticket',
                'customer_id',
                'customer/entity',
                'entity_id'
            ),
            'customer_id', $installer->getTable('customer/entity'), 'entity_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE);
    $installer->getConnection()->createTable($table);
}

$tableName = $installer->getTable('inchoo_supportticket/ticket_comment');
// Check if the table already exists
if ($installer->getConnection()->isTableExists($tableName) != true) {
    $table = $installer->getConnection()
        ->newTable($installer->getTable('inchoo_supportticket/ticket_comment'))
        ->addColumn('ticket_comment_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'identity'  => true,
            'unsigned'  => true,
            'nullable'  => false,
            'primary'   => true,
        ), 'Ticket Id')
         ->addColumn('ticket_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
            'unsigned'  => true,
            'nullable'  => false,
        ), 'Customer Id')
        ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, 250, array(
            'nullable'  => false,
        ), 'Content')
        ->addColumn('author', Varien_Db_Ddl_Table::TYPE_TEXT, 50, array(
            'nullable'  => false,
        ), 'Author')
       ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
            'nullable' => false,
        ), 'Created At')
        ->addForeignKey(
            $installer->getFkName(
                'inchoo_supportticket/ticket_comment',
                'ticket_id',
                'inchoo_supportticket/ticket',
                'ticket_id'
            ),
            'ticket_id', $installer->getTable('inchoo_supportticket/ticket'), 'ticket_id',
            Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE);
    $installer->getConnection()->createTable($table);
}

$installer->endSetup();