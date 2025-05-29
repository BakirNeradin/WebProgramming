<?php
require_once "BaseDao.php";

class EventsDao extends BaseDao {

    public function __construct() {
        parent::__construct("events");
    }

    public function getAllEvents() {
        return $this->getAll();
    }

    public function getEventById($id) {
        return $this->getById($id);
    }
}
?>