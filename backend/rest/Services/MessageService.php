<?php
require_once 'BaseService.php';
require_once __DIR__.'/../DAO/MessagesDao.php';

class MessagesService extends BaseService {
    public function __construct() {
        parent::__construct(new MessagesDao());
    }
}
?>
