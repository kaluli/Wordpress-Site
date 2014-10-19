<div class="sort-controls">
    <strong><?php _e('Sort By','framework');?>:</strong>
    &nbsp;
    <select name="sort-properties" id="sort-properties">
        <option value="default"><?php _e('Default Order','framework');?></option>
        <option value="price-asc" <?php echo ($_GET['orderby']=='price-asc')?'selected':''; ?>><?php _e('Price Low to High','framework');?></option>
        <option value="price-desc" <?php echo ($_GET['orderby']=='price-desc')?'selected':''; ?>><?php _e('Price High to Low','framework');?></option>
        <option value="date-asc" <?php echo ($_GET['orderby']=='date-asc')?'selected':''; ?>><?php _e('Date Old to New','framework');?></option>
        <option value="date-desc" <?php echo ($_GET['orderby']=='date-desc')?'selected':''; ?>><?php _e('Date New to Old','framework');?></option>
    </select>
</div>