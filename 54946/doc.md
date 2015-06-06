In this case,you need make one table primary table and using join function[left join,Inner join] on Resource Model and Resource Model Collection class relation rest of two classes.
Add Tables into Model Collection :

You need to first work on collection class.Here,you need do add function _afterLoad() on collection class,w using this function you can mapping relation between there table.

On Resource Class : Mynamespace_Mymodule_Model_Resource_Mymodel_Collection

protected function _afterLoad()
{
$select= $this->getSelect();
$select->joinLeft(
    array('SecondTable'=>$this->getTable('yourmodel/secondtable')),
    ''Maintable.key=SecondTable.key',
    array('*')
);

$select->joinLeft(
    array('3rdTable'=>$this->getTable('yourmodel/thirdatble')),
    'Maintable.key=3rdTable.key',
    array('*')
);
return parent::_afterLoad();
}

afterLoad() trigger a perform a operations after collection load.
Add Three tables into model

On resource class you need add multiple table using function _getLoadSelect() on Mynamespace_Mymodule_Model_Resource_Mymodel

 protected function _getLoadSelect($field, $value, $object)
    {
        $select = parent::_getLoadSelect($field, $value, $object);

        $select->join(
                array('SecondTable' => $this->getTable('yourmodel/secondtable')),
               'Maintable.key=SecondTable.key',
                array());

        $select->join(
                array('3rdTable' => $this->getTable('yourmodel/thirdatble')),
               'Maintable.key=3rdTable.key',
                array());

    return $select;
    }

If resource collection is not work then try this code at collection.php

Create two individual function.which is include rest of function to collection.

public function addSecondTable(){

$select= $this->getSelect();
$select->joinLeft(
        array('SecondTable'=>$this->getTable('yourmodel/SecondTable')),
        'Maintable.key=SecondTable.key',
        array('*')
    return $this;   
}

public function addThirdTable(){

    $this->getSelect()->joinLeft(
    array('3rdTable'=>$this->getTable('yourmodel/Thirdatble')),
    'Maintable.key=3rdTable.key',
    array('*'));
    return $this;   
}

You can use:

$collection = Mage::getResourceModel('mynamespace_mymodule/mymodule_collection');
$collection->addSecondTable()->addThirdTable();

