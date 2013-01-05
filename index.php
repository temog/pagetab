<?php

require_once dirname(__FILE__) . '/model.php';

$campaign = new CampaignController();
$campaign->dispatch();

class CampaignController {

	private $appId = '';
	private $secret = '';
	private $appUrl = '';
	private $pageUrl = '';
	private $scope = 'email, user_birthday, publish_stream';
	private $wallParam = array(
		'picture'     => '',
		'name'        => '',
		'caption'     => 'caption',
		'description' => 'description',
	);

	public $fb;
	public $signed_request;

	public function __construct(){

		$this->signed_request = isset($_POST['signed_request'])?
			$_POST['signed_request'] : FALSE;

		CampaignModel::fbConnect($this->appId, $this->secret);
	}

	public function dispatch(){

		// liked 判定
		if(! $this->signed_request){
			// Facebookページ外からの利用。エラーぺーじへ
			$this->viewPage('error1.php');
		}

		/*
		 * 申し込み済みか判定。DB使うなら facebook id を
		 * 記録しておいて、このあたりで比較すればよい
		 */


		/*
		 * page1 いいね がまだ
		 */
		if(! CampaignModel::isLiked()){

			$this->viewPage('page1.php');
		}
		/*
		 * page2 アプリ承認がまだ
		 */
		else if(! CampaignModel::getUser()){

			$url = CampaignModel::getLoginUrl($this->pageUrl, $this->scope);
			$this->viewPage('page2.php', array('url' => $url));
		}
		/*
		 * page3 入力ページ
		 */
		else if(! isset($_POST['page'])){

			$userInfo = CampaignModel::getUserInfo();

			// facebook から取得できるデータ見たかったら表示
			//echo '<pre>'; print_r($userInfo); echo '</pre>';

			$this->viewPage('page3.php', array(
				'signed_request' => $this->signed_request,
				'id'             => $userInfo['id'],
				'name'           => $userInfo['name'],
				'birthday'       => $userInfo['birthday'],
				'gender'         => $userInfo['gender'],
				'email'          => $userInfo['email'],
			));
		}
		/*
		 * page4 確認ページ
		 */
		else if(isset($_POST['page']) && $_POST['page'] == 'page4'){

			/*
			 * 普通このへんでフィルターとかバリデーション
			 */

			$this->viewPage('page4.php', array(
				'signed_request' => $this->signed_request,
				'id'             => $_POST['id'],
				'name'           => $_POST['name'],
				'birthday'       => $_POST['birthday'],
				'gender'         => $_POST['gender'],
				'email'          => $_POST['email'],
				'message'        => $_POST['message'],
			));
		}
		/*
		 * page5 申し込み完了
		 */
		else if(isset($_POST['page']) && $_POST['page'] == 'page5'){

			$userInfo = CampaignModel::getUserInfo();

			/*
			 * 普通このへんでフィルターとかバリデーション
			 */

			/*
			 * 申し込み情報をDBなり、ファイルなりに保存する。
			 * facebook id を保存しておけば重複申し込みを制限できる
			 */

			/*
			 * ウォールへの投稿。ユーザの認識なしにウォール投稿は
			 * Facebook規約に違反するので注意。
			 *
			 * サンプルでは入力されてたら投稿します。
			 */
			if($_POST['message']){

				$param = $this->wallParam;
				$param['message'] = $_POST['message'];
				$param['link'] = $this->pageUrl;
				CampaignModel::postWall($userInfo['id'], $param);
			}

			$this->viewPage('page5.php');
		}
	}

	private function viewPage($page, $param = array()){
		include_once('view/header.php');
		include_once('view/' . $page);
		include_once('view/footer.php');
		exit;
	}

}

