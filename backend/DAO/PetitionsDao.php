<?php
require_once "BaseDao.php";

class PetitionsDao extends BaseDao {
    public function __construct() {
        parent::__construct("petitions");
    }
}
?>

