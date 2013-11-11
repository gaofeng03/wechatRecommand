<div class="body">
<div class="news_container">
    <?php if($data['news'] != null) { ?>
        <?php foreach($data['news'] as $key=>$row) { ?>
            <div class="news_item" style="border-right:3px solid <?=$data['color'][$key]?>;">
                <div class="news_item_img">
                    <img src="../static/images/gau_bg2.png"/>
                </div>
                <div class="news_detail">
                    <div class="news_title">
                        <h3><?=$row->wn_title ?></h3>
                    </div>
                    <div class="news_des">
                        <p><?=$row->wn_content ?></p>
                    </div>
                    <div class="news_from">
                        --来自：腾讯新闻
                    </div>
                </div>
                <div class="news_dateinfo">
                    <?=substr($row->wn_date,0,10)?>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</div>
<div class="pager">
    <?=$data['pager'] ?>
<!--    <a class="previou_page pager_btn">-->
<!--        << 前一页-->
<!--    </a>-->
<!--    <ul class="pager_ul">-->
<!--        <li class="pager_item current">1</li>-->
<!--        <li class="pager_item">2</li>-->
<!--        <li class="pager_item">3</li>-->
<!--        <li class="pager_item">4</li>-->
<!--        <li class="pager_item">...</li>-->
<!--    </ul>-->
<!--    <a class="next_page pager_btn">-->
<!--        后一页 >>-->
<!--    </a>-->
<!--</div>-->
</div>