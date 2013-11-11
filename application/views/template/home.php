
<div class="body">
    <div class="slide_area">
        <div class="pre_slide sl_btn"><</div>
        <div class="next_slide sl_btn">></div>
        <div class="slide_container">

        </div>
        <!--    <div class="slide_control">-->
        <!--        <div class="slide_item current"></div>-->
        <!--        <div class="slide_item"></div>-->
        <!--        <div class="slide_item"></div>-->
        <!--    </div>-->
        <div class="slide_view">
            <img class="gau_img" style="" src="static/images/gau_bg.png"/>
            <div class="slide_content">
                <div class="slide_content_item">
                    <div class="ercode_container">
                        <img src="http://wechatmp.chinacloudapp.cn/wechatRecommand/static/ercode/73b4db938a33a9f26549fa5dcc08e97a.jpg" alt=""/>
                    </div>
                    <div class="ercode_des">
                        <h3>this is the title!</h3>
                        <p>this is the description!</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="wechat_news wc_module purple" style="overflow: hidden;">
            <div class="module_header">
                <span class="header_icon">iii</span><h3 class="purple_font">微信动态</h3>
                <!-- <a class="more">更多...</a> -->
            </div>
            <div class="module_body">
                <ul class="new_wc">

                    <?php
                    if($data['latest'] != null) {
                        foreach($data['latest'] as $key => $value) {
                            ?>
                            <a style="color:#2a3744;text-decoration: none;" href="index.php/Details/<?=$value->id?>">
                                <li class="new_wc_item">
                                    <span class="order"><?php //$key + 1?></span>
                                    <span class="new_wc_title" ercodePath="<?php echo $this->config->item('ercodeUrl') . $value->wechatImgPath?>"><?=$value->wechatname?></span>
                                    <span class="new_wc_date"><?=substr($value->date,5,6) ?></span>
                                </li>
                            </a>
                        <?php
                        }
                    }
                    ?>

                </ul>
            </div>
        </div>
    </div>

<div class="module_area">
<div class="module_left">
    <div class="rand_module wc_module green">
        <div class="module_header green_header">
            <span class="header_icon">iii</span><h3 class="green_font">随机推荐</h3>
            <img id="loader" src="<?=$this->config->item('app_url')?>/static/images/line_loader.gif" alt="" style="height: 10px;display: none;"/>
            <a class="changeRand">换一批</a>
        </div>
        <ul class="module_body">
            <?php if($data['random'] != null) { ?>
                <?php foreach($data['random'] as $row) { ?>
                <a href="index.php/Details/<?=$row->id?>">
                <div class="qr_item">
                    <img src="<?php echo $this->config->item('ercodeUrl') .$row->wechatImgPath; ?>" alt=""/>
                    <div class="qr_control">
                        <span class="wc_name"><?=$row->wechatname?></span>
                    </div>
                </div>
                </a>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="module_right wc_module blue">
    <div class="module_header blue_header">
        <span class="header_icon">iii</span><h3 class="blue_font">最新收录</h3>
        <!-- <a class="more">更多...</a> -->
    </div>
    <div class="module_body">
        <ul class="new_wc">

            <?php
            if($data['latest'] != null) {
                foreach($data['latest'] as $key => $value) {
                ?>
            <a style="color:#2a3744;text-decoration: none;" href="index.php/Details/<?=$value->id?>">
            <li class="new_wc_item">
                <span class="order"><?php //$key + 1?></span>
                <span class="new_wc_title" ercodePath="<?php echo $this->config->item('ercodeUrl') . $value->wechatImgPath?>"><?=$value->wechatname?></span>
                <span class="new_wc_date"><?=substr($value->date,5,6) ?></span>
            </li>
            </a>
            <?php
                }
            }
            ?>

        </ul>
    </div>
</div>
<div class="pop_wc wc_module pink">
    <div class="module_header">
        <span class="header_icon">iii</span>
        <h3 class="pink_font">本站分类推荐</h3>
    </div>
    <?php
    if($data['largeData'] != null) {
        foreach($data['largeData'] as $row) {
        ?>

    <div class="pop_wc_item">
        <h3><?=$row['typename']?></h3>
        <ul>
            <?php
            if($row['data'] != null) {
                foreach($row['data'] as $r) {
                ?>

                <li><a ercodePath="<?php echo $this->config->item('ercodeUrl') . $r->wechatImgPath?>" href="index.php/Details/<?=$r->id?>"><?=$r->wechatname?></a></li>
            <?php
                }
            }
                ?>
        </ul>
        <div class="pop_more">
            <a href="index.php/Category/<?= $row['typeid'] ?>/page">更多</a>
        </div>
    </div>
    <?php
        }
    }
    ?>

</div>
<div class="wc_news wc_module wc_news_bgcolor">
    <div class="module_header">
        <span class="header_icon">iii</span>
        <h3 class="wc_news_font">服务号推荐</h3>
        <span class="more">更多</span>
    </div>
    <div class="module_body">
        <?php if($data['service'] != null) { ?>
            <?php foreach($data['service'] as $row) { ?>
                <a href="index.php/Details/<?=$row->id?>">
                <div class="qr_item">
                    <img src="<?php echo $this->config->item('ercodeUrl') .$row->wechatImgPath; ?>" alt=""/>
                    <div class="qr_control">
                        <span class="wc_name"><?=$row->wechatname?></span>
                    </div>
                </div>
                </a>
            <?php } ?>
        <?php } ?>
    </div>
</div>
    <div class="wc_news wc_module wc_rss_bgcolor">
        <div class="module_header">
            <span class="header_icon">iii</span>
            <h3 class="wc_news_font">订阅号推荐</h3>
            <span class="more">更多</span>
        </div>
        <div class="module_body">
            <?php if($data['rss'] != null) { ?>
                <?php foreach($data['rss'] as $row) { ?>
                    <a href="index.php/Details/<?=$row->id?>">
                    <div class="qr_item">
                        <img src="<?php echo $this->config->item('ercodeUrl') .$row->wechatImgPath; ?>" alt=""/>
                        <div class="qr_control">
                            <span class="wc_name"><?=$row->wechatname?></span>
                        </div>
                    </div>
                    </a>
                <?php } ?>
            <?php } ?>
        </div>
    </div>
<div class="module_verify wc_module vc_bgcolor">
    <div class="module_header">
        <span class="header_icon">iii</span>
        <h3 class="vc_font">认证账号推荐</h3>
    </div>
    <div class="module_body">
        <?php if($data['verify'] != null) { ?>
            <?php foreach($data['verify'] as $row) { ?>
                <a href="index.php/Details/<?=$row->id?>">
                <div class="qr_item">
                    <img src="<?php echo $this->config->item('ercodeUrl') .$row->wechatImgPath; ?>" alt=""/>
                    <div class="qr_control">
                        <span class="wc_name"><?=$row->wechatname?></span>
                    </div>
                </div>
                </a>
            <?php } ?>
        <?php } ?>

    </div>
</div>
</div>
<div class="links">
    <h3>友情链接</h3>
    <ul class="friendLinks">
        <li><a href="#">腾讯微信</a></li>
        <li><a href="#">腾讯微信</a></li>
        <li><a href="#">腾讯微信</a></li>
        <li><a href="#">腾讯微信</a></li>
        <li><a href="#">腾讯微信</a></li>
        <li><a href="#">腾讯微信</a></li>
        <li><a href="#">腾讯微信</a></li>
        <li><a href="#">腾讯微信</a></li>
        <li><a href="#">腾讯微信</a></li>
        <li><a href="#">腾讯微信</a></li>
        <li><a href="#">腾讯微信</a></li>
        <li><a href="#">腾讯微信</a></li>
        <li><a href="#">腾讯微信</a></li>
    </ul>
</div>
</div>