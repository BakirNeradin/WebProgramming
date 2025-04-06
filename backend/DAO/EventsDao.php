<?php
require_once "BaseDao.php";

class EventsDao extends BaseDao {
    public function __construct() {
        parent::__construct("events");
    }
}
?>

