<?php
require_once "BaseDao.php";

class UserPetitionsDao extends BaseDao {
    public function __construct() {
        parent::__construct("user_petitions");
    }
}
?>
