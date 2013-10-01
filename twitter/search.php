<!DOCTYPE html>
<html dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
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
        <?php osc_current_web_theme_path('header.php') ; ?>
        <div class="container margin-top-10">
            <?php twitter_show_flash_message() ; ?>
        </div>
        <!-- content -->
        <div class="container container-fluid search">
            <?php echo twitter_breadcrumb('&raquo;') ; ?>
            <!-- sidebar -->
            <div class="sidebar well">
                <form action="<?php echo osc_base_url(true); ?>" method="get">
                    <input type="hidden" name="page" value="search" />
                    <fieldset>
                        <h4><?php _e('Your search', 'twitter') ; ?></h4>
                        <div class="clearfix">
                            <input type="text" name="sPattern" id="query" value="<?php echo osc_search_pattern() ; ?>" />
                        </div>
                    </fieldset>
                    <fieldset>
                        <h4><?php _e('City', 'twitter') ; ?></h4>
                        <div class="clearfix">
                            <input type="text" name="sCity" id="sCity" value="<?php echo osc_search_city() ; ?>" />
                        </div>
                    </fieldset>
                    <?php
                        View::newInstance()->_erase('subcategories') ;
                        View::newInstance()->_erase('categories') ;
                    ?>
                    <?php if ( osc_count_categories() ) { ?>
                    <fieldset>
                        <h4><?php _e('Categories', 'twitter') ; ?></h4>
                        <div class="clearfix">
                            <ul class="inputs-list">
                            <?php // RESET CATEGORIES IF WE USED THEN IN THE HEADER ?>
                            <?php osc_goto_first_category() ; ?>
                                <?php while( osc_has_categories() ) { ?>
                                <li>
                                    <label>
                                        <?php
                                            $rootCategory = Category::newInstance()->findSubcategories(osc_category_id()) ;
                                            $isParent     = false ;
                                            foreach($rootCategory as $c) {
                                                if( in_array($c['pk_i_id'], osc_search_category()) ) {
                                                    $isParent = true ;
                                                }
                                                if( in_array($c['s_slug'], osc_search_category()) ) {
                                                    $isParent = true ;
                                                }
                                            }
                                        ?>
                                        <input type="checkbox" id="cat<?php echo osc_category_id(); ?>" name="sCategory[]" value="<?php echo osc_category_id(); ?>" <?php echo ( (in_array(osc_category_id(), osc_search_category()) || $isParent || in_array(osc_category_slug(), osc_search_category()) || count(osc_search_category()) == 0 )  ? 'checked' : '') ; ?> />
                                        <span><?php echo osc_category_name(); ?></span>
                                    </label>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </fieldset>
                    <?php } ?>
                    <?php
                        if(osc_search_category_id()) {
                            osc_run_hook('search_form', osc_search_category_id()) ;
                        } else {
                            osc_run_hook('search_form') ;
                        }
                    ?>
                    <div class="clearfix">
                        <button class="btn" type="submit"><?php _e('Apply', 'twitter') ; ?></button>
                    </div>
                </form>
                <?php osc_alert_form() ; ?>
            </div>
            <!-- sidebar end -->
            <div class="content">
                <?php require('search_list.php') ; ?>
            </div>
        </div>
        <?php osc_current_web_theme_path('footer.php') ; ?>
    </body>
</html>