<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";
class RoomModel extends Database
{
    public function getRoom($id)
    {
        $room = null;
        if ($id) {
            $room = $this->select("SELECT rooms.id, type_infor.typeName, type_infor.noPeople, type_infor.price
            FROM rooms
            INNER JOIN type_infor ON rooms.typeId=type_infor.id Where rooms.id = ?", ["i", $id]);
        } else {
            $room = $this->select("SELECT rooms.id, type_infor.typeName, type_infor.noPeople, type_infor.price
            FROM rooms
            INNER JOIN type_infor ON rooms.typeId=type_infor.id");
        }
        return array(
            "code" => 0,
            "room" => $room
        );
    }

    public function findRoom($noPeople = null, $priceUpper = null, $priceUnder = null,  $type = null, $dateStart = null, $dateEnd = null)
    {
        $availableRoom = null;
        if ($priceUnder && $priceUpper && $type && $dateStart && $dateEnd) {
            $availableRoom = $this->select(
                "SELECT rooms.id, type_infor.typeName, type_infor.noPeople, type_infor.price 
            FROM rooms
            INNER JOIN type_infor
                ON rooms.typeId = type_infor.id
            WHERE rooms.typeId = $type AND (type_infor.price BETWEEN $priceUpper and $priceUnder)  AND NOT EXISTS (
                SELECT 1
                FROM reservation
                WHERE reservation.roomId = rooms.id
                AND (reservation.dateStart < $dateEnd AND reservation.dateEnd > $dateStart)
            )
            ORDER BY rooms.id;"
            );
        } else if ($type && $dateStart && $dateEnd) {
            $availableRoom = $this->select(
                "SELECT rooms.id, type_infor.typeName, type_infor.noPeople, type_infor.price 
                FROM rooms
                INNER JOIN type_infor
                    ON rooms.typeId = type_infor.id
                WHERE rooms.typeId = $type  AND NOT EXISTS (
                    SELECT 1
                    FROM reservation
                    WHERE reservation.roomId = rooms.id
                    AND (reservation.dateStart < $dateEnd AND reservation.dateEnd > $dateStart)
                )
                ORDER BY rooms.id;"
            );
        } else if ($priceUnder && $priceUpper && $dateStart && $dateEnd) {
            $availableRoom = $this->select(
                "SELECT rooms.id, type_infor.typeName, type_infor.noPeople, type_infor.price 
                FROM rooms
                INNER JOIN type_infor
                    ON rooms.typeId = type_infor.id
                WHERE (type_infor.price BETWEEN $priceUpper and $priceUnder)  AND NOT EXISTS (
                    SELECT 1
                    FROM reservation
                    WHERE reservation.roomId = rooms.id
                    AND (reservation.dateStart < $dateEnd AND reservation.dateEnd > $dateStart)
                )
                ORDER BY rooms.id;"
            );
        } else if ($dateStart && $dateEnd) {
            $availableRoom = $this->select(
                "SELECT rooms.id, type_infor.typeName, type_infor.noPeople, type_infor.price 
                FROM rooms
                INNER JOIN type_infor
                    ON rooms.typeId = type_infor.id
                WHERE NOT EXISTS (
                    SELECT 1
                    FROM reservation
                    WHERE reservation.roomId = rooms.id
                    AND (reservation.dateStart < $dateEnd AND reservation.dateEnd > $dateStart)
                )
                ORDER BY rooms.id;"
            );
        } else {
            return array(
                "code" => 1,
                "message" => "miss params"
            );
        }

        return array(
            "code" => 0,
            "Available room" => $availableRoom
        );
    }
}
