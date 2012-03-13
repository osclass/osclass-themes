<?php
    $useragent = $_SERVER['HTTP_USER_AGENT'] ;
    if (preg_match('|MSIE ([0-9].[0-9]{1,2})|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'IE';
    } elseif (preg_match('|Opera/([0-9].[0-9]{1,2})|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'Opera';
    } elseif(preg_match('|Firefox/([0-9\.]+)|',$useragent,$matched)) {
        $browser_version=$matched[1];
        $browser = 'Firefox';
    } elseif(preg_match('|Safari/([0-9\.]+)|',$useragent,$matched)) {
            $browser_version=$matched[1];
            $browser = 'Safari';
    } elseif(preg_match('|Chrome/([0-9\.]+)|',$useragent,$matched)) {
            $browser_version=$matched[1];
            $browser = 'Chrome'; 
    } else {
        $browser_version = 0;
        $browser= 'anderer';
    }

    if ($browser == "IE" AND $browser_version < "8.0") {
        echo '<font style="color:red;">Sie benutzen den Internet Explorer 7. Bitte aktualisieren Sie Ihren Browser um eine dynamische Artikelübersicht einzusehen.</font>';
    } else {
?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#carousel_ul li:first").before($("#carousel_ul li:last"));      
        $("#right_scroll img").click(function(){
            var item_width = $("#carousel_ul li").outerWidth() + 0;
            var left_indent = parseInt($("#carousel_ul").css("left")) - item_width;
            $("#carousel_ul:not(:animated)").animate({"left" : left_indent},500,function(){    
                $("#carousel_ul li:last").after($("#carousel_ul li:first")); 
                $("#carousel_ul").css({"left" : "-122px"});
            }); 
        });
        
        $("#left_scroll img").click(function(){
            var item_width = $("#carousel_ul li").outerWidth() + 0;
            var left_indent = parseInt($("#carousel_ul").css("left")) + item_width;
            $("#carousel_ul:not(:animated)").animate({"left" : left_indent},500,function(){    
                $("#carousel_ul li:first").before($("#carousel_ul li:last")); 
                $("#carousel_ul").css({"left" : "-122px"});
            });
        });
    });
</script>
<?php while ( osc_has_latest_items() ) { ?>
<div id="carousel_container">
    <div id="carousel_inner">
        <ul id="carousel_ul">
		<?php if( osc_count_item_resources() ) { ?>
            <li><a href="<?php echo osc_item_url() ; ?>"><?php echo osc_item_title() ; ?></a><div class="noblock_slider"><a href="<?php echo osc_item_url() ; ?>"><img src="<?php echo osc_resource_thumbnail_url() ; ?>" width="94" height="94" alt="" /></a></div></li>
		<?php } ?>
        </ul>
    </div>
    <div style="width:488px;">
        <div id="left_scroll"><img src="/images/prevArrow.png" /></div>
        <div id="right_scroll"><img src="/images/nextArrow.png" /></div>
    </div>
</div>
<?php } 
} ?>