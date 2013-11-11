/**
* Created by PhpStorm.
* User: gaofeng
* Date: 13-11-5
* Time: 下午8:11
*/

<div class="body">
    <div class="category_holder red">
        <div class="category_left">
            <div class="rand_module wc_module">
                <div class="module_header red_font">
                    <h3><?php echo $data['typename']->typeName?></h3>
                    <a class="join for_cate">我要提交</a>
                </div>
                <ul class="module_body">
                    <?php if($data['cateData'] != null) { ?>
                        <?php foreach($data['cateData'] as $row) { ?>
                            <a href="/wechatRecommand/index.php/Details/<?=$row['id']?>">
                                <div class="qr_item">
                                    <img src="<?php echo $this->config->item('ercodeUrl') .$row['wechatImgPath']; ?>" alt=""/>
                                    <div class="qr_control">
                                        <span class="wc_name"><?=$row['wechatname']?></span>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
            <div class="pager">
                <ul class="pager_ul">
                    <?php echo $data['catePage']?>
                </ul>
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
    </div>
</div>