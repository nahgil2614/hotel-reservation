<?php
class RoomController extends BaseController
{
    /** 
     * "/user/list" Endpoint - Get list of users 
     */
    public function requestHandler()
    {
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        if (strtoupper($requestMethod) == 'GET') {
            $arrQueryStringParams = $this->getQueryStringParams();
            try {
                $roomModel = new RoomModel();
                $arrRooms = null;
                $id = null;
                $noPeople = null;
                $dateStart = null;
                $dateEnd = null;
                $priceUpper = null;
                $priceUnder = null;
                $type = null;
                if (isset($arrQueryStringParams['id']) && $arrQueryStringParams['id']) {
                    $id = $arrQueryStringParams['id'];
                    if ($id === 'all') $arrRooms = $roomModel->getRoom(null);
                    else $arrRooms = $roomModel->getRoom($id);
                } else {
                    if (isset($arrQueryStringParams['dateStart']) && $arrQueryStringParams['dateStart']) {
                        $dateStart = $arrQueryStringParams['dateStart'];
                    }
                    if (isset($arrQueryStringParams['dateEnd']) && $arrQueryStringParams['dateEnd']) {
                        $dateEnd = $arrQueryStringParams['dateEnd'];
                    }
                    if (isset($arrQueryStringParams['type']) && $arrQueryStringParams['type']) {
                        $type = $arrQueryStringParams['type'];
                    }
                    if (isset($arrQueryStringParams['priceUpper']) && $arrQueryStringParams['priceUpper']) {
                        $priceUpper = $arrQueryStringParams['priceUpper'];
                    }
                    if (isset($arrQueryStringParams['priceUnder']) && $arrQueryStringParams['priceUnder']) {
                        $priceUnder = $arrQueryStringParams['priceUnder'];
                    }
                    if (isset($arrQueryStringParams['noPeople']) && $arrQueryStringParams['noPeople']) {
                        $noPeople = $arrQueryStringParams['noPeople'];
                    }
                    $arrRooms = $roomModel->findRoom($noPeople, $priceUpper, $priceUnder, $type, $dateStart, $dateEnd);
                }

                $responseData = json_encode($arrRooms);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } elseif (strtoupper($requestMethod) == 'POST') {
            $body = $this->getPostBody();
            $body['password'] = password_hash($body['password'], PASSWORD_DEFAULT);
            try {
                $userModel = new UserModel();

                $response = $userModel->createUsers($body);

                $responseData = json_encode($response);
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output 
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                array('Content-Type: application/json', 'HTTP/1.1 200 OK')
            );
        } else {
            $this->sendOutput(
                json_encode(array('error' => $strErrorDesc)),
                array('Content-Type: application/json', $strErrorHeader)
            );
        }
    }

    //     public function loginHandler()
    //     {
    //         $strErrorDesc = '';
    //         $requestMethod = $_SERVER["REQUEST_METHOD"];
    //         if (strtoupper($requestMethod) == 'POST') {
    //             $body = $this->getPostBody();           
    //             try {
    //                 $userModel = new UserModel();
    //                 $arrUsers = $userModel->findUser($body['email'], $body['password']);
    //                 $responseData = json_encode($arrUsers);
    //             } catch (Error $e) {
    //                 $strErrorDesc = $e->getMessage() . 'Something went wrong! Please contact support.';
    //                 $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
    //             }
    //         } else {
    //             $strErrorDesc = 'Method not supported';
    //             $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
    //         }
    //         // send output 
    //         if (!$strErrorDesc) {
    //             $this->sendOutput(
    //                 $responseData,
    //                 array('Content-Type: application/json', 'HTTP/1.1 200 OK')
    //             );
    //         } else {
    //             $this->sendOutput(
    //                 json_encode(array('error' => $strErrorDesc)),
    //                 array('Content-Type: application/json', $strErrorHeader)
    //             );
    //         }
    //     }
}
