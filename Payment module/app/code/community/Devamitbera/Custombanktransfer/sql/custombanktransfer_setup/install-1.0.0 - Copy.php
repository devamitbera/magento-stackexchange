<?php
/*
@Author Amit Bera
@Email dev.amitbera@gmail.com
@ Website: www.amitbera.com
*/
$installer=$this;
$installer->startSetup();
$table=$installer->getConnection()
		->newTable($installer->getTable('custombanktransfer/custombanktransfer'))
   		->addColumn('custombanktransfer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Custombanktransfer ID')
    	->addColumn('cbank_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
            'nullable' => false
        ), 'Bank name')
    	->addColumn('cbank_branch', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
            'nullable' => false
        ), 'Bank Branch')
    	->addColumn('cbank_type', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
            'nullable' => false
        ), 'Bank Type')	
    	->addColumn('cbank_account', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, array(
            'nullable' => false
        ), 'Bank Account')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        ), 'Updated At')
    ->addIndex($installer->getIdxName('custombanktransfer/custombanktransfer', array('cbank_name')),
        array('cbank_name'))
    ->addIndex($installer->getIdxName('custombanktransfer/custombanktransfer', array('cbank_branch')),
        array('cbank_branch'))
    ->addIndex($installer->getIdxName('custombanktransfer/custombanktransfer', array('cbank_account')),
        array('cbank_account'))		
    ->addIndex($installer->getIdxName('custombanktransfer/custombanktransfer', array('cbank_type')),
        array('cbank_type'))
    ->addIndex($installer->getIdxName('custombanktransfer/custombanktransfer', array('created_at')),
        array('created_at'));
$installer->getConnection()->createTable($table);	

/* sales Quote & order payment table * new columns */


$installer->getConnection()
	->addColumn($installer->getTable('sales/order_payment'), 'cbank_id', array(
    'type' =>Varien_Db_Ddl_Table::TYPE_INTEGER,
    'length' => 10,
    'nullable' => true,
    'default' => null,
    'comment' => 'Id'
));


$installer->getConnection()
	->addColumn($installer->getTable('sales/order_payment'), 'cbank_name', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length' => 255,
    'nullable' => true,
    'default' => null,
    'comment' => 'bank Name for Custom bank trasfer'
));
$installer->getConnection()
	->addColumn($installer->getTable('sales/order_payment'), 'cbank_branch', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length' => 255,
    'nullable' => true,
    'default' => null,
    'comment' => 'Branch for Custom bank trasfer'
));

$installer->getConnection()
	->addColumn($installer->getTable('sales/order_payment'), 'cbank_account', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length' => 255,
    'nullable' => true,
    'default' => null,
    'comment' => 'Account no of Custom bank trasfer'
));


$installer->getConnection()
	->addColumn($installer->getTable('sales/order_payment'), 'cbank_type', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length' => 255,
    'nullable' => true,
    'default' => null,
    'comment' => 'Type of Custom bank trasfer'
));

$installer->getConnection()
	->addColumn($installer->getTable('sales/quote_payment'), 'cbank_name', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length' => 255,
    'nullable' => true,
    'default' => null,
    'comment' => 'bank Name for Custom bank trasfer'
));

$installer->getConnection()
	->addColumn($installer->getTable('sales/quote_payment'), 'cbank_id', array(
    'type' =>Varien_Db_Ddl_Table::TYPE_INTEGER,
    'length' => 10,
    'nullable' => true,
    'default' => null,
    'comment' => 'Id'
));

$installer->getConnection()
	->addColumn($installer->getTable('sales/quote_payment'), 'cbank_branch', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length' => 255,
    'nullable' => true,
    'default' => null,
    'comment' => 'Branch for Custom bank trasfer'
));

$installer->getConnection()
	->addColumn($installer->getTable('sales/quote_payment'), 'cbank_account', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length' => 255,
    'nullable' => true,
    'default' => null,
    'comment' => 'Account no of Custom bank trasfer'
));

$installer->getConnection()
	->addColumn($installer->getTable('sales/quote_payment'), 'cbank_type', array(
    'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
    'length' => 255,
    'nullable' => true,
    'default' => null,
    'comment' => 'Type of Custom bank trasfer'
));

$installer->endSetup();