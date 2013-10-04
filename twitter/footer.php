<!-- footer -->
<?php osc_show_widgets('footer'); ?>
<div class="footer-line"></div>
<div class="container footer">
    <div class="row">
        <div class="span16 columns">
            <a href="<?php echo osc_contact_url(); ?>"><?php _e('Contact', 'twitter') ; ?></a> &middot;
            This website is proudly using the open source classifieds software <a href="http://osclass.org/">Osclass</a> and <a href="http://twitter.github.com/bootstrap/">twitter bootstrap</a>
        </div>
    </div>
</div>
<!-- footer end -->
<?php osc_run_hook('footer') ; ?>