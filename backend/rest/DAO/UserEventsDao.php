<?php
require_once "BaseDao.php";

class UserEventsDao extends BaseDao {
    public function __construct() {
        parent::__construct("user_events");
    }
}
?>
