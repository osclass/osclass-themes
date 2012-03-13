<?php
    /*
     *      OSCLass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2010 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */
?>
<?php
//Fields
$fields = osc_get_item_meta();
$fields_by_slug = array();
$fields_by_name = array();
foreach($fields as $field){
    $field_details = Field::newInstance()->findByPrimaryKey($field['pk_i_id']);
    $fields_by_slug[$field_details['s_slug']] = $field;
    $fields_by_name[] = $field_details['s_name'];
}
?>
<div id="main">
    <div id="item_head">
        <div class="inner">
            <h1><strong><?php echo osc_item_title(); ?></strong></h1>
            <?php if ( $fields_by_slug['s_department']['s_value'] != '' ){ ?><h2><?php echo $fields_by_slug['s_department']['s_value']; ?></h2><?php } ?>
        </div>
        <div id="job-details">
            <ul>
                <li class="right"><?php echo osc_format_date( osc_item_pub_date() ) ; ?></li>
                <?php if ( osc_item_country() != "" ) { ?><li><?php _e("Country", 'seeker'); ?>: <strong><?php echo osc_item_country() ; ?></strong><?php if ( osc_item_region() != "" ) { ?>, <strong><?php echo osc_item_region() ; ?></strong><?php } ?><?php if ( osc_item_city() != "" ) { ?>, <strong><?php echo osc_item_city() ; ?></strong><?php } ?><?php if ( osc_item_city_area() != "" ) { ?>, <strong><?php echo osc_item_city_area() ; ?></strong><?php } ?>
                </li><?php } ?>
                <?php if ( $fields_by_slug['s_position_type']['s_value'] != '' ){ echo '<li>'.__($fields_by_slug['s_position_type']['s_name'], 'seeker') . ': <strong>' . $fields_by_slug['s_position_type']['s_value'].'</strong></li>'; } ?>
            </ul>
            <div class="clear"></div>
        </div>
    </div>
    <div class="share-area"><a href="<?php echo osc_item_send_friend_url() ; ?>" rel="nofollow" class="mail_btn"><i class="icon-envelope"></i><?php _e('Send to a friend', 'seeker') ; ?></a><div class="clear"></div></div>
    <div id="description">
        <dl>
            <dt>Description</dt>
            <dd><?php echo osc_item_description(); ?></dd>

            <?php if ( $fields_by_slug['s_job_experience']['s_value'] != '' ){ ?>
                <dt><?php echo __($fields_by_slug['s_job_experience']['s_name'], 'seeker'); ?></dt>
                <dd><?php echo $fields_by_slug['s_job_experience']['s_value']; ?></dd>
            <?php } ?>

            <?php if ( $fields_by_slug['s_salary']['s_value'] != '' ){ ?>
                <dt><?php echo __($fields_by_slug['s_salary']['s_name'], 'seeker'); ?></dt>
                <dd><?php echo $fields_by_slug['s_salary']['s_value']; ?></dd>
            <?php } ?>

            <?php if ( $fields_by_slug['s_number_positions']['s_value'] != '' ){ ?>
                <dt><?php echo __($fields_by_slug['s_number_positions']['s_name'], 'seeker'); ?></dt>
                <dd><?php echo $fields_by_slug['s_number_positions']['s_value']; ?></dd>
            <?php } ?>

        </dl>
        <div id="custom_fields">
            <?php if( osc_count_item_meta() >= 1 ) { ?>
                <div class="meta_list">
                    <?php while ( osc_has_item_meta() ) { ?>
                        <?php
                        if(osc_item_meta_value()!='' &&  !in_array(osc_item_meta_name(), $fields_by_name)) { ?>
                            <div class="meta">
                                <strong><?php echo osc_item_meta_name(); ?>:</strong> <?php echo osc_item_meta_value(); ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
        <?php osc_run_hook('item_detail', osc_item() ) ; ?>
        <?php osc_run_hook('location') ; ?>
    </div>
    <!-- plugins -->
</div>