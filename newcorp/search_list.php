<table border="0" cellspacing="0">
     <tbody>
        <?php $class = "even" ; ?>
        <?php while(osc_has_items()) { ?>
            <tr class="<?php echo $class; ?>">
                 <td class="text">
                     <h3><a href="<?php echo osc_item_url() ; ?>"><?php echo osc_item_title() ; ?></a></h3>
                     <p><?php echo osc_highlight( strip_tags( osc_item_description() ), 200 ) ; ?></p>
                 </td>
             </tr>
            <?php $class = ($class == 'even') ? 'odd' : 'even' ; ?>
        <?php } ?>
    </tbody>
</table>