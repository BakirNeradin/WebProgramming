<?php
require_once 'BaseService.php';
require_once __DIR__.'/../DAO/DonationsDao.php';

class DonationsService extends BaseService {
    public function __construct() {
        parent::__construct(new DonationsDao());
    }
}
?>
