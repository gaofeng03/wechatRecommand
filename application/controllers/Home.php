<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dd
 * Date: 13-10-21
 * Time: 下午1:40
 * To change this template use File | Settings | File Templates.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Wechat_model','wechat');
    }

    public function index()
    {
        //$this->output->cache(60);
        // the data is for 'main body' of home page.
        $data['data']['random'] = $this->wechat->getWechat('random',8);
        $data['data']['latest'] = $this->wechat->getWechat('latest',9);
        $data['data']['verify'] = $this->wechat->getWechat('verify',10);
        $data['data']['largeData'] = $this->wechat->getSomeFromAllCate(7);
        $data['data']['service'] = $this->wechat->getAccount(1,10);
        $data['data']['rss'] = $this->wechat->getAccount(0,10);

        $data['header']['wechatCategory'] = $this->wechat->getWechatType();

        $data['template'] = 'template/home';
        $this->load->view('main',$data);
    }

    public function ajaxRand()
    {
        $rand_data = $this->wechat->getWechat('random',8);
        echo json_encode($rand_data);
    }
}