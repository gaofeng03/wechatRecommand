<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by JetBrains PhpStorm.
 * User: dd
 * Date: 13-10-21
 * Time: 下午2:41
 * wc_xx wecaht_xx
 */
class Wechat_model extends CI_Model {

    var $wcId = '';
    var $wcWid = '';
    var $wcDate = '';
    var $wcType = '';
    var $wcDes = '';
    var $imgUrl = '';
    var $like = '';
    var $isVerify = '';

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /*
     * @param type: module type
     * @param limit: how many to get
     */
    public function getWechat($type,$limit = 10)
    {
        switch($type)
        {
            case 'random':
                $this->db->select('*')
                        ->from('info')
                        ->order_by('rand()')
                        ->limit($limit);

                $query = $this->db->get();

                if($query->num_rows() > 0)
                {
                    return $query->result();
                }
                return null;

                break;
            case 'verify':
                $ret = $this->db->select('*')
                    ->from('info')
                    ->where('isVerify=',1)
                    ->limit($limit)
                    ->get();
                return $ret->num_rows() > 0
                    ? $ret->result()
                    : null;
                break;
            case 'latest':
                $this->db->select('*')
                         ->from('info')
                         ->order_by('date')
                         ->limit($limit);
                $query = $this->db->get();

                return $query->num_rows() > 0
                    ?  $query->result()
                    :  null;
                break;
        }
    }

    /*
     * get wechat by category
     * @param $category : category
     * @param $limit: how many to be got
     */
    public function getWechatByCategory($categoryid,$limit)
    {
        //$this->db->cache_on();
        $query = $this->db->select('wechatname,wechatImgPath,id')
                          ->from('info')
                          ->where('wechatType',$categoryid)
                          ->where('LENGTH(wechatname) < ',10)
                          ->limit($limit)
                          ->order_by('date','desc');
        //echo $this->db->last_query();
        $ret = $this->db->get();

        return $ret->num_rows() > 0 ? $ret->result() : null;
    }

    /*
     * 获取所有分类下的某几个账号
     */
    public function getSomeFromAllCate($limit=7)
    {
        $categoryList = $this->getWechatType();
        $ret = Array();
        if(count($categoryList) > 0)
        {
            foreach($categoryList as $row)
            {
                $data['typename'] = $row->typeName;
                $data['typeid'] = $row->typeid;
                $data['data'] = $this->getWechatByCategory($row->typeid,$limit);
                array_push($ret,$data);
            }
        }
        return $ret;
    }

    /*
     * get categories of wechat
     */
    public function getWechatType()
    {
        $query = $this->db->get('wechattype');

        return $query->num_rows() > 0 ? $query->result() : null;
    }

    public function slideData()
    {
        $data = Array(
            Array(
                'url'=> 'http://wechatmp.chinacloudapp.cn/wechatRecommand/static/ercode/73b4db938a33a9f26549fa5dcc08e97a.jpg',
                'name' => 'this is title 1',
                'des' => 'x'
            ),
            Array(
                'url' => 'http://wechatmp.chinacloudapp.cn/wechatRecommand/static/ercode/73b4db938a33a9f26549fa5dcc08e97a.jpg',
                'name' => 'this is title 2',
                'des' => 'xxx'
            ),
            Array(
                'url' => 'http://wechatmp.chinacloudapp.cn/wechatRecommand/static/ercode/73b4db938a33a9f26549fa5dcc08e97a.jpg',
                'name' => 'this is title 3',
                'des' => 'xxxxx'
            )
        );
        //echo json_encode($data);
        return json_encode($data);
    }

    public function getAccount($isService = 0,$limit = 10)
    {
        $ret = $this->db->select('*')
                        ->from('info')
                        ->where('isService=',$isService)
                        ->limit($limit)
                        ->order_by('date','desc')
                        ->get();
        return $ret->num_rows() > 0 ? $ret->result() : null;
    }


    public function getAccountById($id)
    {
        $ret = $this->db->select('*')
                        ->from('info')
                        ->where('id=',$id)
                        ->limit(1)
                        ->get();
        return $ret->num_rows() > 0 ? $ret->result()[0] : null;
    }

    public function getTypeById($id)
    {
        $typeid = $this->db->select('wechattype')
                            ->from('info')
                            ->where('id',$id)
                            ->limit(1)
                            ->get()
                            ->row()
                            ->wechattype;


        $ret = $this->db->select('typeid,typeName')
                        ->from('wechattype')
                        ->where('typeid=',$typeid)
                        ->limit(1)
                        ->get()
                        ->row();
        return $ret;

    }

    public function getContactByCate($categoryId,$limit=10)
    {
        $ret = $this->db->select('wechatid,id,wechatImgPath,wechatname,date')
                        ->from('info')
                        ->where('wechattype=',$categoryId)
                        ->order_by('date','desc')
                        ->limit($limit)
                        ->get();

        return $ret->num_rows() > 0 ? $ret->result() : null;
    }

    public function getNews($pageIndex = 0,$pageSize = 10)
    {
        $ret = $this->db->select('*')
                        ->from('wechatnews')
                        ->order_by('wn_date','desc')
                        ->limit($pageSize , $pageIndex)
                        ->get();

        return $ret->num_rows() > 0 ? $ret->result() : null;

        //echo '-----' . $pageIndex . '-----------' . $pageSize;
    }

    public function getNewsCount()
    {
        $ret = $this->db->select('*')->from('wechatnews')->get();
        return $ret->num_rows();
    }

    //--------------------------------For Gao Lewis-------------------------

    public function getTypeCount($typeid){
        $ret = $this->db->select('*')
                        ->from('info')
                        ->where('wechatType',$typeid)
                        ->get();
        return $ret->num_rows();
    }
    public function getCateByType($typeId){
        $ret = $this->db->select('wechatid,id,wechatImgPath,wechatname,date')
            ->from('info')
            ->where('wechatType',$typeId)
            ->order_by('date','desc')
            ->get();

        return $ret->num_rows() > 0 ? $ret->result() : null;
    }
    public function getCateDetils($typeid,$pageNum,$limit){
        $categoryList = $this->getCateByType($typeid);
        $count = $this->getTypeCount($typeid);
        $pageCount = ceil($count/20);
        $lastPage = $count % 20;
        $query = Array();
        $limit = $pageNum < $pageCount ? $limit : $lastPage;
        $pageNum = ($pageNum > 1 ? $pageNum*10 + 1 : 1) - 1;
        if(count($categoryList) > 0)
        {
            foreach($categoryList as $row)
            {
                $data['wechatname'] = $row->wechatname;
                $data['id'] = $row->id;
                $data['wechatImgPath']=$row->wechatImgPath;
                array_push($query,$data);
            }
        }
        $ret = array_slice($query,$pageNum,$limit);
        return $ret;

    }
    public function getCateById($typeId){
        $ret=$this->db->select('typeName')
                      ->from('wechattype')
            ->where('typeid',$typeId)
            ->limit(1)
            ->get();
        return $ret->num_rows() > 0 ? $ret->result()[0] : null;
    }
    public function catePagination($id,$perPage){
        $this->load->library('pagination');
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = '首页';
        $config['last_link'] = '尾页';
        $config['next_link'] = '<div class="next_page pager_btn">后一页 >></div>';
        $config['prev_link'] = '<div class="previou_page pager_btn"><< 前一页</div>';
        $config['anchor_class'] = "";
        $config['base_url'] = 'http://localhost/wechatRecommand/index.php/Category/'.$id.'/page/';
        $config['total_rows'] = $this->getTypeCount($id);
        $config['per_page'] = $perPage;
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    //----------------------------------------------------------------------
}