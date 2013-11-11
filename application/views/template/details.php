<div class="body">
<div class="category_holder detail_holder">
    <div class="category_left">
        <div class="detail_container">
            <div class="wcd_information">
                <div class="wcd_ercode">
                    <img src="<?php echo $this->config->item('ercodeUrl') .$data['details']->wechatImgPath; ?>"/>
                </div>
                <div class="wcd_name"><?=$data['details']->wechatname?></div>
                <div class="wcd_id"><?=$data['details']->wechatid?></div>
<!--                <div class="wcd_control">-->
<!--                    <div class="like con_btn"></div>-->
<!--                    <div class="comment con_btn"></div>-->
<!--                    <div class="share con_btn"></div>-->
<!--                </div>-->

            </div>
            <!-- <div class="wcd_des">
                <p>“这里用于描述微信公众账号的相关信息”</p>
            </div> -->
            <div class="special_bg">
                <img src="<?=base_url()?>static/images/test/test.JPG"/>
            </div>
        </div>
        <div class="wcd_des">
            <p>“<?=$data['details']->wechatdes?>”</p>
            <p class="detail_area">
                <span style="font-weight: bold;">所属分类：</span>
                <span><a href="<?php echo base_url() . 'category/' . $data['details_type']->typeid?>" style="color:#008080"><?=$data['details_type']->typeName?></a></span>
            </p>
        </div>
        <div class="wcd_share">
            <!-- JiaThis Button BEGIN -->
            <div class="jiathis_style_24x24">
                <a class="jiathis_button_qzone"></a>
                <a class="jiathis_button_tsina"></a>
                <a class="jiathis_button_tqq"></a>
                <a class="jiathis_button_weixin"></a>
                <a class="jiathis_button_renren"></a>
                <a href="http://www.jiathis.com/share?uid=1858727" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
                <a class="jiathis_counter_style"></a>
            </div>
            <script type="text/javascript">
                var jiathis_config = {data_track_clickback:'true'};
            </script>
            <script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js?uid=1858727" charset="utf-8"></script>
            <!-- JiaThis Button END -->
        </div>
        <div class="wcd_commet" style="width:680px;min-height:100px;background-color:#fefefe;border-left:3px solid #7A869C;padding:10px;overflow:hidden;">
            <!-- UY BEGIN -->
            <div id="uyan_frame"></div>
            <script type="text/javascript" src="http://v2.uyan.cc/code/uyan.js?uid=1858727"></script>
            <!-- UY END -->
        </div>
    </div>
    <div class="category_right">
        <div class="right_header">
            <div class="right_item">随机推荐</div>
        </div>
        <div class="category_right_list">
            <ul>
                <?php if($data['random'] != null) { ?>
                    <?php foreach($data['random'] as $row) { ?>
                        <a href="<?php echo site_url('Details/' . $row->id)?>">
                        <li class="category_item">
                            <span class="item_content"  ercodePath="<?php echo $this->config->item('ercodeUrl') . $row->wechatImgPath?>"><?=$row->wechatname?></span><span class="item_date"><?=substr($row->date,5,6) ?></span>
                        </li>
                        </a>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="ad_long"></div>
    <div class="contact_wc">
        <div class="contact_wc_header">
            <h3>相关推荐</h3>
        </div>
        <ul class="module_body">
            <?php if($data['relation'] != null) { ?>
                <?php foreach($data['relation'] as $row) { ?>
                    <div class="qr_item">
                        <a href="<?php echo base_url() . 'index.php/Details/' . $row->id; ?>">
                        <!--                    <img src="../images/1.jpg">-->
                        <img src="<?php echo $this->config->item('ercodeUrl') .$row->wechatImgPath; ?>" alt=""/>
                        <div class="qr_control">
                            <span class="wc_name"><?=$row->wechatname?></span>
                            <!--                        <span class="wc_good">1</span>-->
                        </div>
                        </a>
                    </div>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</div>
</div>