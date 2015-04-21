<?php

/**
 * 
 * 
 * @author Alex
 */
class Tree {

    private $_db = null;
    private $_category_arr = array();

    public function __construct() {
        $this->_db = new PDO("mysql:dbname=last;host=localhost", "root", "temp");
        $this->_category_arr = $this->_getCategory();
    }

    /**
     * grab all data from table
     */
    private function _getCategory() {
        $query = $this->_db->prepare("SELECT subItemOfID, item, itemID FROM `table`");
        $query->execute();
        //here we can use also PDO::FETCH_GROUP  
        $result = $query->fetchAll(PDO::FETCH_OBJ | PDO::FETCH_GROUP);
        return $result;
    }

    /**
     * print the tree
     * @param Integer $subItemOfID
     */
    public function outTree($subItemOfID) {
        if (isset($this->_category_arr[$subItemOfID])) {
            echo '<ul>';
            foreach ($this->_category_arr[$subItemOfID] as $value) {
                echo '<li>' . $value->item . '</li>';
                $this->outTree($value->itemID);
            }
            echo '</ul>';
        }
    }

    /**
     * grab all data from table
     */
//    public function outTreeWrong($subItemOfID = 0) {
//        $query = $this->_db->prepare("SELECT * FROM `table` WHERE subItemOfID = :subItemOfID");
//        $query->bindParam(':subItemOfID', $subItemOfID, PDO::PARAM_INT);
//        $query->execute();
//        $result = $query->fetchAll(PDO::FETCH_OBJ);
//        echo '<ul>';
//        foreach ($result as $r) {
//            echo '<li>' . $r->Item . '</li>';
//            $this->outTree($r->itemID);
//        }
//        echo '</ul>';
//    }

}

$tree = new Tree();
$tree->outTree(0);
//$tree->outTreeWrong(0);