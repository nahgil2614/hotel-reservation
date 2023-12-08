<?php
class PageController extends BaseController
{
	public function requestHandler($pageName) {
		include PROJECT_ROOT_PATH . "/pages/" . $pageName;
	}
}