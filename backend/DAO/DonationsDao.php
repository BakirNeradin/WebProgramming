<?php
require_once "BaseDao.php";

class DonationsDao extends BaseDao {
    public function __construct() {
        parent::__construct("donations");
    }
}
?>
