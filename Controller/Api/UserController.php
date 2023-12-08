<?php
class UserController extends BaseController
{
    private $userModel = null;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    protected function create() {
        $body = $this->getPostBody();
        return $this->userModel->create($body);
    }

    /** 
     * "/user/list" Endpoint - Get list of users 
     */
    protected function get() {
        $arrQueryStringParams = $this->getQueryStringParams();
        $id = $arrQueryStringParams['id'];
        return $this->userModel->get($id);
    }

    protected function login() {
        $body = $this->getPostBody();
        return $this->userModel->find($body['email'], $body['password']);
    }

    protected function getRes() {
        $arrQueryStringParams = $this->getQueryStringParams();
        $id = $arrQueryStringParams['id'];
        return $this->userModel->getRes($id);
    }
}
