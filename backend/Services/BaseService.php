<?php
require_once __DIR__ . '/../DAO/BaseDao.php';

class BaseService {
   protected $dao;
   public function __construct($dao) {
       $this->dao = $dao;
   }
   public function getAll() {
       return $this->dao->getAll();
   }
   public function getById($id) {
       return $this->dao->getById($id);
   }
   public function create($data) {
       return $this->dao->insert($data);
   }
}
