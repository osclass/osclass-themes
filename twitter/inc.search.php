        <!-- search bar -->
        <div class="container">
            <div class="row inc-search">
                <div class="span16 columns">
                    <form action="<?php echo osc_base_url(true) ; ?>" method="get" >
                        <input type="hidden" name="page" value="search" />
                        <fieldset>
                            <input class="xlarge" type="text" name="sPattern" value="">
                            <?php chosen_select_standard() ; ?>
                            <?php chosen_region_select() ; ?>
                            <button type="submit" class="btn"><?php _e('Search', 'twitter') ; ?></button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
        <div class="search-line"></div>
        <!-- search bar end -->