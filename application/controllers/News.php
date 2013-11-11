<?php defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {

    private $colorArr = Array(
        '#FF7640',
        '#FFBC40',
        '#D6FA3F',
        '#3E97DE',
        '#60D5AC'
    );

    function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->model('Wechat_model','wechat');
    }

    public function index()
    {
        $pageIndex = $this->uri->segment(2);
        $pageIndex = $pageIndex == '' ? 0 : $pageIndex;
        $this->wechat->getNews($pageIndex);
        //$this->output->cache(60);
//
        $data['header']['wechatCategory'] = $this->wechat->getWechatType();
        $data['data']['news'] = $this->wechat->getNews($pageIndex,5);
        $data['data']['color'] = $this->colorArr;
        $data['template'] = 'template/news';


        // 分页
        $config['base_url'] = 'http://localhost/wechatRecommand/index.php/News';
        $config['total_rows'] = $this->wechat->getNewsCount();
        $config['per_page'] = 5;
        $config['first_link'] = '';
        $config['last_link'] = '';

        $config['first_tag_open'] = '<div>';

        $config['first_tag_close'] = '</div>';


        $config['next_link'] = '下一页';

        $config['next_tag_open'] = '<div class="next_page pager_btn">';

        $config['next_tag_close'] = '</div>';

        $config['prev_link'] = '上一页;';

        $config['prev_tag_open'] = '<div class="previou_page pager_btn">';

        $config['prev_tag_close'] = '</div>';

        $config['anchor_class'] = "pager_item";

        $config['full_tag_open'] = '<ul class="pager_ul">';

        $config['full_tag_close'] = '</ul>';


        $config['cur_tag_open'] = '<li class="pager_item current"><a>';

        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="pager_item"><a>';

        $config['num_tag_close'] = '</a></li>';

        $this->pagination->initialize($config);
        $data['data']['pager'] = $this->pagination->create_links();

        $this->load->view('main',$data);
    }
}