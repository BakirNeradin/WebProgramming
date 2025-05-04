<?php
require_once "BaseDao.php";

class DonationsDao extends BaseDao {

    public function __construct() {
        parent::__construct("donations");
    }

    public function getAllDonations() {
        return $this->getAll();
    }

    public function getDonationById($id) {
        return $this->getById($id);
    }

    public function updateDonation($id, $donation) {
        $query = "UPDATE donations SET full_name = :full_name, address = :address, 
                  account_number = :account_number, amount = :amount WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ":full_name" => $donation["full_name"],
            ":address" => $donation["address"],
            ":account_number" => $donation["account_number"],
            ":amount" => $donation["amount"],
            ":id" => $id
        ]);
    }

    public function deleteDonation($id) {
        return $this->deleteById($id);
    }
}
?>

