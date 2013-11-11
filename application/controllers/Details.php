<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dd
 * Date: 13-10-30
 * Time: 下午8:29
 * To change this template use File | Settings | File Templates.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Details extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Wechat_model','wechat');
    }


    /*
     * xxx.com/details/3
     */
    public function index()
    {
        $id = $this->uri->segment(2);
        $data['header']['wechatCategory'] = $this->wechat->getWechatType();
        $data['data']['details'] = $this->wechat->getAccountById($id);
        $data['data']['details_type'] = $this->wechat->getTypeById($id);
        $data['data']['random'] = $this->wechat->getWechat('random',10);
        //var_dump($data['data']['details']);
        //var_dump($data['data']['details_type']);
        $data['data']['relation'] = $this->wechat->getContactByCate($data['data']['details_type']->typeid,10);
        //var_dump($data['data']['relation']);
        $data['template'] = 'template/details';

        $this->load->view('main',$data);
    }
}