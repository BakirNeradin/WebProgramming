<?php
require_once 'BaseService.php';
require_once __DIR__.'/../DAO/PetitionsDao.php';

class PetitionsService extends BaseService {
    public function __construct() {
        parent::__construct(new PetitionsDao());
    }
}
?>
