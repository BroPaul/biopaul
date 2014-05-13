<?php
	/*
		Template Name: Contact Page
	*/
?>
<?php get_header(); ?>
        <div id="content" class="content">
            <div class="innerContainer">
				<?php
                    if (have_posts()) {
                        while (have_posts()) {
                            the_post();
                ?>
                <div class="desc">
                    <?php the_content(); ?>
                </div>
                <?php
                        }
                    }
                ?>
                <?php comments_template('', true); ?>
            </div><!-- /innerContainer -->
        </div><!-- /content -->

<!--         <div class="content" style="margin-left: 50px;">
            <div class="innerContainer">
                <p>交换（申请）友链也欢迎留言，原则上不拒绝个人博客 | 本站PR <script language="javascript" src="http://pr.links.cn/getpr.asp?queryurl=www.bropaul.com"></script></p>
                
            </div>
        </div> -->
<?php get_footer(); ?>
<!--    <script defer src="http://dn-f.qbox.me/jweather/js/jquery.weather.build.min.js?parentbox=#jq-weather&moveArea=limit&zIndex=1&move=1&drag=1&autoDrop=1&styleSize=big&style=default&area=client"></script>-->