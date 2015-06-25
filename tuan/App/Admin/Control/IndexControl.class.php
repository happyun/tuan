<?php  
 class IndexControl extends Control {

 	public function index(){
 		$this->display();
 	}

 	public function welcome(){
 		$this->assign('server',$_SERVER);
 		$this->display();
 	}

 }




?>