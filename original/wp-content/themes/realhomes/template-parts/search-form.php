<?php
global $theme_search_fields;
if( !empty($theme_search_fields) ):
?>
<div class="as-form-wrap">
    <form class="advance-search-form clearfix" action="<?php global $theme_search_url; echo $theme_search_url; ?>" method="get">
    <?php

    if(in_array('property-id',$theme_search_fields)){
        ?>
        <div class="option-bar large">
            <label for="property-id-txt"><?php _e('Property ID', 'framework'); ?></label>
            <input type="text" name="property-id" id="property-id-txt" value="<?php echo isset($_GET['property-id'])?$_GET['property-id']:''; ?>" placeholder="<?php _e('Any', 'framework'); ?>" />
        </div>
        <?php
    }
    if(in_array('location',$theme_search_fields)){
        ?>
        <div class="option-bar large">
            <label for="select-location"><?php _e('Property Location', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="location" id="select-location" class="search-select">
                    <?php advance_hierarchical_options('property-city'); ?>
                </select>
            </span>
        </div>
        <?php
    }
    if(in_array('status',$theme_search_fields)){
        ?>
        <div class="option-bar large">
            <label for="select-status"><?php _e('Property Status', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="status" id="select-status" class="search-select">
                    <?php advance_search_options('property-status'); ?>
                </select>
            </span>
        </div>
        <?php
    }
    if(in_array('type',$theme_search_fields)){
        ?>
        <div class="option-bar large">
            <label for="select-property-type"><?php _e('Property Type', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="type" id="select-property-type" class="search-select">
                    <?php advance_hierarchical_options('property-type'); ?>
                </select>
            </span>
        </div>
        <?php
    }
    if(in_array('min-beds',$theme_search_fields)){
        ?>
        <div class="option-bar small">
            <label for="select-bedrooms"><?php _e('Min Beds', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="bedrooms" id="select-bedrooms" class="search-select">
                    <?php numbers_list('bedrooms'); ?>
                </select>
            </span>
        </div>
        <?php
    }
    if(in_array('min-baths',$theme_search_fields)){
        ?>
        <div class="option-bar small">
            <label for="select-bathrooms"><?php _e('Min Baths', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="bathrooms" id="select-bathrooms" class="search-select">
                    <?php numbers_list('bathrooms'); ?>
                </select>
            </span>
        </div>
        <?php
    }
    if(in_array('min-max-price',$theme_search_fields)){
        ?>
        <div class="option-bar small price-for-others">
            <label for="select-min-price"><?php _e('Min Price', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="min-price" id="select-min-price" class="search-select">
                    <?php min_prices_list(); ?>
                </select>
            </span>
        </div>

        <div class="option-bar small price-for-others">
            <label for="select-max-price"><?php _e('Max Price', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="max-price" id="select-max-price" class="search-select">
                    <?php max_prices_list(); ?>
                </select>
            </span>
        </div>

        <div class="option-bar small price-for-rent hide-fields">
            <label for="select-min-price"><?php _e('Min Price', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="min-price" id="select-min-price-for-rent" class="search-select" disabled="disabled">
                    <?php min_prices_for_rent_list(); ?>
                </select>
            </span>
        </div>

        <div class="option-bar small price-for-rent hide-fields">
            <label for="select-max-price"><?php _e('Max Price', 'framework'); ?></label>
            <span class="selectwrap">
                <select name="max-price" id="select-max-price-for-rent" class="search-select" disabled="disabled">
                    <?php max_prices_for_rent_list(); ?>
                </select>
            </span>
        </div>
        <?php
    }
    if(in_array('min-max-area',$theme_search_fields)){
        $area_unit = get_option("theme_area_unit");
        ?>
        <div class="option-bar small">
            <label for="min-area"><?php _e('Min Area', 'framework'); ?> <span><?php if($area_unit){ echo "($area_unit)"; } ?></span></label>
            <input type="text" name="min-area" id="min-area" pattern="[0-9]+" value="<?php echo isset($_GET['min-area'])?$_GET['min-area']:''; ?>" placeholder="<?php _e('Any', 'framework'); ?>" title="<?php _e('Please only provide digits!','framework'); ?>" />
        </div>

        <div class="option-bar small">
            <label for="max-area"><?php _e('Max Area', 'framework'); ?> <span><?php if($area_unit){ echo "($area_unit)"; } ?></span></label>
            <input type="text" name="max-area" id="max-area" pattern="[0-9]+" value="<?php echo isset($_GET['max-area'])?$_GET['max-area']:''; ?>" placeholder="<?php _e('Any', 'framework'); ?>" title="<?php _e('Please only provide digits!','framework'); ?>" />
        </div>
        <?php
    }
    ?>
    <div class="option-bar">
        <input type="submit" value="<?php _e('Search', 'framework'); ?>" class=" real-btn btn">
    </div>
    </form>
</div>
<?php
endif;
?>