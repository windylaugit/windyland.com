<?php




load_baseapp('front');
class TestApp extends FrontAppBase {
	var $_app_need_logined = true;
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		
	}
	public function index()
	{
		
		$this->display('test/test.index.html');
	}
	public function getMessage($a,$b,$c,$d){

	}
	
	public function getQuestions(){
		$this->require_login();
		$uid = $this->passportLib->u('u_id');
		
		$this->load->m('questions',null,'que');
		
		$list = $this->queM->getReceiveList($uid,TRUE);
		
		if(!empty($list)){
			$this->json_result($list,'get_success');
		}else{
			$this->json_error('no_data');
		}
	}
	
}
