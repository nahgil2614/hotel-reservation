<?php
class RoomModel extends BaseModel
{
    private $privateKey;
    private $publicKey;

    public function __construct() {
        parent::__construct();
        
        // Read the private key from the PEM file
        $privateKeyPEM = file_get_contents(PROJECT_ROOT_PATH . '/private_key.pem');
        $this->privateKey = openssl_pkey_get_private($privateKeyPEM);

        if (!$this->privateKey) {
            die('Error reading private key');
        }

        // Read the public key from the PEM file
        $publicKeyPEM = file_get_contents(PROJECT_ROOT_PATH . '/public_key.pem');
        $this->publicKey = openssl_pkey_get_public($publicKeyPEM);

        if (!$this->publicKey) {
            die('Error reading public key');
        }
    }

    public function get($id=null, $typeId=null, $noPeople=1, $priceL=null, $priceH=null, $dateStart=null, $dateEnd=null) {
        $conds = array(
            "id"        => "r.id=$id",
            "typeId"    => "t.id=$typeId",
            "priceL"    => "t.price>=$priceL",
            "priceH"    => "t.price<=$priceH",
        );
        foreach ($conds as $name => $cond) {
            if ($$name === null) unset($conds[$name]);
        }

        if ($dateStart && $dateEnd) {
            $conds["date"] = "NOT EXISTS (
                SELECT res.id
                FROM reservations AS res
                WHERE res.roomId = r.id
                AND (res.dateStart < '$dateEnd' AND res.dateEnd > '$dateStart')
            )";
        }

        $where = join(" AND ", array_values($conds));
        if ($where !== "") $where = "WHERE $where";

        $rooms = $this->query("SELECT r.id, t.name, t.noPeople, t.price
        FROM rooms AS r
        INNER JOIN room_types AS t
        ON r.typeId=t.id
        $where");

        /*$maxNoPeople = 0;
        foreach ($rooms as $room) {
            $maxNoPeople += $room["noPeople"];
        }
        if ($maxNoPeople < $noPeople) {
            return array(
                "code" => 1,    // not enough capacity
                "rooms" => []
            );
        }*/

        return array(
            "code" => 0,
            "rooms" => $rooms
        );
    }

    public function reserve($userId, $roomId, $dateStart, $dateEnd) {
        if ($this->get(id: $roomId, dateStart: $dateStart, dateEnd: $dateEnd)["code"] !== 0) {
            return array(
                "code" => 1,
                "message" => "Dates were already reserved."
            );
        }
        
        // the cancelLink is these information encrypted
        $tmp = array_fill_keys(array("userId", "roomId", "dateStart", "dateEnd"), "");
        foreach ($tmp as $key => $value) {
            $tmp[$key] = $$key;
        }
        $cancelLink = "";
        openssl_public_encrypt(json_encode($tmp), $cancelLink, $this->publicKey);

        $cancelLink = "http://$_SERVER[HTTP_HOST]/api/cancel-room?s=" . base64_encode($cancelLink);

        $message = $this->query("INSERT INTO reservations(userId, roomId, dateStart, dateEnd, cancelLink) values (?, ?, ?, ?, ?)", "iisss", $userId, $roomId, $dateStart, $dateEnd, $cancelLink);

        if ($message === false) {
            return array(
                "code" => 2,
                "message" => "Failed to execute query."
            );
        }

        return array(
            "code"       => 0,
            "message"    => $message
        );
    }

    public function cancel($s) {
        $s = base64_decode($s);
        $data = '';
        openssl_private_decrypt($s, $data, $this->privateKey);
        $data = json_decode($data, true);

        if (!$this->query("SELECT id FROM reservations WHERE roomId=? AND dateStart=?", "is", $data["roomId"], $data["dateStart"])) {
            return array(
                "code" => 2,
                "message" => "There is no such reservation."
            );
        }

        if (time() + 86400*3 > strtotime($data["dateStart"])) {
            return array(
                "code" => 2,
                "message" => "Cannot cancel within 3 days of the reservation date."
            );
        }

        $message = $this->query("DELETE FROM reservations WHERE userId=? AND roomId=? AND dateStart=? AND dateEnd=?", "iiss", $data["userId"], $data["roomId"], $data["dateStart"], $data["dateEnd"]);

        if ($message === false) {
            return array(
                "code" => 2,
                "message" => "Failed to execute query."
            );
        }

        return array(
            "code"       => 0,
            "message"    => $message
        );
    }
}
