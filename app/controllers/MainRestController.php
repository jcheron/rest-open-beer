<?php
use Ovide\Libs\Mvc\Rest\Controller;
class MainRestController extends Controller {
	protected function _isValidToken($token,$force=false){
		return $force=="true" || (isset($token) && $this->session->get("token")===$token);
	}

	protected function sendMessage($type,$content){
		return array("type"=>$type,"content"=>$content);
	}

	protected function infoMessage($message){
		return $this->sendMessage("info",$message);
	}

	protected function successMessage($message){
		return $this->sendMessage("success",$message);
	}
	protected function warningMessage($message){
		return $this->sendMessage("warning",$message);
	}
	protected function dangerMessage($message){
		return $this->sendMessage("danger",$message);
	}
}