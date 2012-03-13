<?php osc_show_widgets('footer'); ?>
<?php osc_current_web_theme_path('ads.php') ; ?> 
<div id="footer">
    <div class="inner">
        <a href="<?php echo osc_contact_url(); ?>"><?php _e('Contact', 'bcute') ; ?></a> |
        <?php osc_reset_static_pages() ; ?>
        <?php while( osc_has_static_pages() ) { ?>
            <a href="<?php echo osc_static_page_url() ; ?>"><?php echo osc_static_page_title() ; ?></a> |
        <?php } ?>
        <?php _e('This website is proudly using the <a title="OSClass web" href="http://osclass.org/">open source classifieds</a> software <strong>OSClass</strong>', 'bcute'); ?>.
    </div>
</div>