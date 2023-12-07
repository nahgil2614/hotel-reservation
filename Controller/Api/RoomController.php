<?php
class RoomController extends BaseController
{
    private $roomModel = null;

    public function __construct() {
        $this->roomModel = new RoomModel();
    }

    // each room has: id, typeName, noPeople, price, dateStart's, dateEnd's
    // GET param: id, typeId, noPeople, priceL, priceH, dateStart, dateEnd
    protected function get() {
        $arrQueryStringParams = $this->getQueryStringParams();
        $conds = array_fill_keys(array("id", "typeId", "noPeople", "priceL", "priceH", "dateStart", "dateEnd"), "");
        foreach ($conds as $name => $cond) {
            if (isset($arrQueryStringParams[$name]) && $arrQueryStringParams[$name]) $conds[$name] = $arrQueryStringParams[$name];
            else $conds[$name] = null;
        }

        return $this->roomModel->get(...array_values($conds));
    }

    protected function reserve() {
        $body = $this->getPostBody();
        if (!$this->isReservationInfo($body)) {
            return array(
                "code" => 2,
                "message" => "Make sure you have all the fields: userId, roomId, dateStart, and dateEnd."
            );
        }
        return $this->roomModel->reserve($body['userId'], $body['roomId'], $body['dateStart'], $body['dateEnd']);
    }

    protected function cancel() {
        $s = substr($_SERVER['QUERY_STRING'], 2);
        return $this->roomModel->cancel($s);
    }

    private function isReservationInfo(&$data) {
        return isset($data['userId'])
            && isset($data['roomId'])
            && isset($data['dateStart'])
            && isset($data['dateEnd']);
    }
}
