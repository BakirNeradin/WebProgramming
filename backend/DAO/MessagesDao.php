<?php
require_once "BaseDao.php";

class MessagesDao extends BaseDao {
    public function __construct() {
        parent::__construct("messages");
    }
}
?>

