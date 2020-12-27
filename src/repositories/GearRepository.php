<?php

class GearRepository
{
    private $connect = null;
    private string $stmtSelect;

    public function __construct()
    {
        $this->stmtSelect = "SELECT p.transactionDate, p.currency, u.firstName, u.lastName, g.gearID, g.name, g.serialNumber, g.warrantyDate, g.netValue, g.userID, g.notes, p.purchaseInvoiceID FROM gear g JOIN users u ON g.userID=u.userID JOIN purchaseinvoices p ON g.purchaseInvoiceID=p.purchaseInvoiceID";

        try {
            global $config;
            $this->connect = new PDO($config['dsn'], $config['username'], $config['password']);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connect->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    private function changeRowToClass($row)
    {
        if (is_null($row['notes'])) {
            $row['notes'] = "";
        }
        if (is_null($row['warrantyDate'])) {
            $row['warrantyDate'] = 'Lifeless';
        }

        return $row;
    }

    private function changeClassToRow(Gear $gear)
    {
        if ($gear->getNotes() == "") {
            $gear->setNotes(null);
        }
        if ($gear->getWarrantyDate() == 'Lifeless') {
            $gear->setWarrantyDate(null);
        }

        return $gear;
    }

    public function select()
    {
        try {
            $sql = "SELECT * FROM gear";
            $stmt = $this->connect->prepare($sql);

            $result = $stmt->execute();

            $gears = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $gear = new Gear();

                // $row = $this->changeRowToClass($row);

                $gear->setId($row['gearID'])->setPurchaseInvoiceID($row['purchaseInvoiceID'])->setUserID($row['userID'])->setName($row['name'])->setSerialNumber($row['serialNumber'])->setNotes($row['notes'])->setNetValue($row['netValue'])->setWarrantyDate(Validation::validateDateAndConvert($row['warrantyDate']));
                array_push($gears, $gear);
            }

            return $gears;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insert(Gear $gear)
    {
        $gear = $this->changeClassToRow($gear);

        $sql = "INSERT INTO gear VALUES(:gearID, :purchaseInvoiceID, :userID, :name, :serialNumber, :notes, :netValue, :warrantyDate)";
        $stmt = $this->connect->prepare($sql);

        $result = $stmt->execute(array(
            'gearID' => $gear->getId(),
            'purchaseInvoiceID' => $gear->getPurchaseInvoiceID(),
            'userID' => $gear->getUserID(),
            'name' => $gear->getName(),
            'serialNumber' => $gear->getSerialNumber(),
            'notes' => $gear->getNotes(),
            'netValue' => $gear->getNetValue(),
            'warrantyDate' => $gear->getWarrantyDate()
        ));

        return $result;
    }

    public function updateById(Gear $gear, int $id)
    {
        $gear = $this->changeClassToRow($gear);

        $sql = "UPDATE gear SET gearID=:gearID, purchaseInvoiceID=:purchaseInvoiceID, userID=:userID, name=:name, serialNumber=:serialNumber, notes=:notes, netValue=:netValue, warrantyDate=:warrantyDate WHERE gearID=:id";
        $stmt = $this->connect->prepare($sql);

        $result = $stmt->execute(array(
            'gearID' => $gear->getId(),
            'purchaseInvoiceID' => $gear->getPurchaseInvoiceID(),
            'userID' => $gear->getUserID(),
            'name' => $gear->getName(),
            'serialNumber' => $gear->getSerialNumber(),
            'notes' => $gear->getNotes(),
            'netValue' => $gear->getNetValue(),
            'warrantyDate' => $gear->getWarrantyDate(),
            'id' => $id
        ));

        return $result;
    }

    public function findByGearNumber(int $gearNumber)
    {
        $sql = "SELECT * FROM gear WHERE WHERE gearID LIKE :GearID";
        $stmt = $this->connect->prepare($sql);

        $result = $stmt->execute(array(
            'GearID' => $gearNumber
        ));

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return null;
        }

        $gear = new Gear();
        $gear->setId($row['gearID'])->setPurchaseInvoiceID($row['purchaseInvoiceID'])->setUserID($row['userID'])->setName($row['name'])->setSerialNumber($row['serialNumber'])->setNotes($row['notes'])->setNetValue($row['netValue'])->setWarrantyDate(Validation::validateDateAndConvert($row['warrantyDate']));

        return $gear;
    }
}