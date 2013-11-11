<?php
/**
 * Created by PhpStorm.
 * User: gaofeng
 * Date: 13-11-5
 * Time: 下午8:07
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Wechat_model','wechat');
    }

    public function index()
    {
        $id = $this->uri->segment(2);
        $pageNum = $this->uri->segment(4);

        $data['data']['cateData']=$this->wechat->getCateDetils($id,$pageNum,20);
        $data['data']['typename']=$this->wechat->getCateById($id);
        $data['data']['verify'] = $this->wechat->getWechat('verify',10);
        $data['data']['catePage'] = $this->wechat->catePagination($id,20);

        $data['data']['random'] = $this->wechat->getWechat('random',10);
        $data['header']['wechatCategory'] = $this->wechat->getWechatType();
        $data['template'] = 'template/category';
        $this->load->view('main',$data);
    }

}