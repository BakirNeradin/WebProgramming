<?php
require_once 'BaseService.php';
require_once __DIR__.'/../DAO/EventsDao.php';

class EventsService extends BaseService {
    public function __construct() {
        parent::__construct(new EventsDao());
    }
}
?>
