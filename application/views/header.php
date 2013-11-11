<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="<?php echo base_url();?>static/css/global.css" media="screen"/>
    <meta charset="utf-8"/>
    <title>微信推荐</title>
    <script type="text/javascript" src="<?=base_url()?>static/scripts/jquery.js"></script>
    <script type="text/javascript">
        //var slideData = ['http://r2.ykimg.com/051000005266A2086714C00E4A02AACD','http://r3.ykimg.com/051000005260E07E6714C00E7905A595','http://r3.ykimg.com/051000005260E07E6714C00E7905A595'];
        var slideData = <?=$this->wechat->slideData()?>;
        var baseUrl = "<?=base_url()?>";
        var ercodeUrl = "<?=$this->config->item('ercodeUrl')?>";
    </script>
    <script type="text/javascript" src="<?=base_url()?>static/scripts/main.js"></script>
    <link rel="shortcut icon" href="https://res.wx.qq.com/zh_CN/htmledition/images/favicon17ced3.ico" type="image/x-icon">
</head>
<body>

<div class="wrapper">
    <div class="header">
        <div class="header_content">
            <a href="index.php"><div class="logo_area">Wechat</div></a>
            <div class="menu_area">
                <ul>
                    <li>公众账号列表<span id="more" class="more_arrow"></span></li>
                    <li>微信新闻</li>
                </ul>
            </div>
            <a href="#" class="join">免费提交</a>
            <div class="search_area">
                <div class="search_box">
                    <input type="text"/>
                    <a id="search_wc" href="javascript:void(null);"></a>
                </div>
            </div>
        </div>
    </div>
    <ul class="wc_category">
        <?php
        if($header['wechatCategory'] != null) {
            foreach($header['wechatCategory'] as $row) {
        ?>
            <li><?=$row->typeName ?></li>
        <?php
            }
        }
        ?>
<!--        <li>新闻</li>-->
<!--        <li>娱乐</li>-->
<!--        <li>体育</li>-->
<!--        <li>财经</li>-->
<!--        <li>明星</li>-->
<!--        <li>金融</li>-->
    </ul>