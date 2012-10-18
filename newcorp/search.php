<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
        <?php osc_current_web_theme_path('head.php') ; ?>
        <?php if(osc_count_items() == 0) { ?>
            <meta name="robots" content="noindex, nofollow" />
            <meta name="googlebot" content="noindex, nofollow" />
        <?php } else { ?>
            <meta name="robots" content="index, follow" />
            <meta name="googlebot" content="index, follow" />
        <?php } ?>
    </head>
    <body>
        <div class="container">
            <?php osc_current_web_theme_path('header.php') ; ?>
            <div class="content list">
                <div id="main">
                    <div class="ad_list">
                        <div id="list_head">
                            <div class="inner">
                                <h1>
                                    <strong><?php _e('Search results', 'newcorp') ; ?></strong>
                                </h1>
                            </div>
                        </div>
                        <?php if(osc_count_items() == 0) { ?>
                            <p class="empty" ><?php printf(__('There are no results matching "%s"', 'newcorp'), osc_search_pattern()) ; ?></p>
                        <?php } else { ?>
                            <?php osc_current_web_theme_path('search_list.php') ; ?>
                        <?php } ?>
                        <div class="paginate" >
                            <?php echo osc_search_pagination(); ?>
                        </div>
                    </div>
                </div>
                <div id="sidebar">
                    <div class="filters">
                        <form action="<?php echo osc_base_url(true); ?>" method="get" onSubmit="return checkEmptyCategories()">
                            <input type="hidden" name="page" value="search" />
                            <fieldset class="box location">
                                <h3><strong><?php _e('Your search', 'newcorp'); ?></strong></h3>
                                <div class="row one_input">
                                    <input type="text" name="sPattern"  id="query" value="<?php echo osc_search_pattern() ; ?>" />
                                </div>
                                <h3><strong><?php _e('Location', 'newcorp') ; ?></strong></h3>
                                <div class="row one_input">
                                    <h6><?php _e('City', 'newcorp'); ?></h6>
                                    <input type="text" id="sCity" name="sCity" value="<?php echo osc_search_city() ; ?>" />
                                </div>
                            </fieldset>
                            <fieldset class="box show_only">
                                <h3><strong><?php _e('Show only', 'newcorp') ; ?></strong></h3>
                                <?php  if ( osc_count_categories() > 0 ) { ?>
                                    <div class="row checkboxes">
                                        <h6><?php _e('Category', 'newcorp') ; ?></h6>
                                        <ul>
                                            <?php // RESET CATEGORIES IF WE USED THEN IN THE HEADER ?>
                                            <?php osc_goto_first_category() ; ?>
                                            <?php while(osc_has_categories()) { ?>
                                                <li>
                                                    <input type="checkbox" name="sCategory[]" id="sCategory" value="<?php echo osc_category_id(); ?>" <?php echo ( (in_array(osc_category_id(), osc_search_category())  || in_array(osc_category_slug()."/", osc_search_category()) || count(osc_search_category())==0 )  ? 'checked' : '') ; ?> />
                                                    <label for="cat<?php echo osc_category_id(); ?>"><strong><?php echo osc_category_name(); ?></strong></label>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </fieldset>
                            <?php
                                if(osc_search_category() != '') {
                                    osc_run_hook('search_form', osc_search_category_id()) ;
                                } else {
                                    osc_run_hook('search_form') ;
                                }
                            ?>
                            <button type="submit"><?php _e('Apply', 'newcorp') ; ?></button>
                        </form>
                        <?php osc_alert_form() ; ?>
                    </div>
                </div>
                <script type="text/javascript">
                    function checkEmptyCategories() {
                        var n = $("#sCategory:checked").length;
                        if( n > 0 ) {
                            return true;
                        } else {
                            return false;
                        }
                    }
                </script>
                <?php osc_current_web_theme_path('footer.php') ; ?>
            </div>
        </div>
        <?php osc_show_flash_message() ; ?>
        <?php osc_run_hook('footer') ; ?>
    </body>
</html>