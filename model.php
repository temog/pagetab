<?php

require_once dirname(__FILE__) . '/src/facebook.php';

class CampaignModel {

	public static $fb = null;

	public static function fbConnect($appId, $secret){

		if(self::$fb){
			return;
		}

		self::$fb = new Facebook(array(
			'appId' => $appId,
			'secret' => $secret,
			'cookie' => TRUE,
		));
	}

	public static function isLiked(){

		$signed = self::$fb->getSignedRequest();
		if($signed && $signed['page']['liked']){
			return TRUE;
		}

		return FALSE;
	}

	public static function getUser(){

		return self::$fb->getUser();
	}

	public static function getLoginUrl($pageUrl, $scope){

		$url = self::$fb->getLoginUrl(array(
			'canvas' => 1,
			'fbconnect' => 0,
			'redirect_uri' => $pageUrl,
			'scope' => $scope,
		));

		return $url;
	}

	public static function getUserInfo(){

		try {
			$data = self::$fb->api('/me', 'GET');

			return $data;
		}
		catch(FacebookApiException $e){
			//echo $e->getMessage();
		}
	}

	public static function postWall($id, $param){

		try {
			self::$fb->api('/' . $id . '/feed', 'post', $param);
		}
		catch(FacebookApiException $e){
			//echo $e->getMessage();
		}
	}

}
