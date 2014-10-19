<div class="span6 ">
    <article class="property-item clearfix">

        <h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>

        <?php
        if(has_post_thumbnail($post->ID)){
            ?>
            <figure>
                <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                    <?php
                    the_post_thumbnail('property-thumb-image',array(
                        'alt'	=> get_the_title(),
                        'title'	=> get_the_title()
                    ));
                    ?>
                </a>
                <figcaption>
                    <?php
                    $status_terms = get_the_terms( $post->ID,"property-status" );
                    if(!empty( $status_terms )){
                        $status_count = 0;
                        foreach( $status_terms as $term ){
                            if( $status_count > 0 ){
                                echo ', ';
                            }
                            echo $term->name;
                            $status_count++;
                        }
                    }
                    ?>
                </figcaption>
            </figure>
            <?php
        }
        ?>

        <div class="detail">
            <h5 class="price">
                <?php
                property_price();
                $type_terms = get_the_terms( $post->ID,"property-type" );
                if(!empty($type_terms)){
                    echo '<small> - ';
                    foreach($type_terms as $type_term){
                        echo $type_term->name;
                    }
                    echo '</small>';
                }
                ?>
            </h5>
            <p><?php framework_excerpt(30); ?></p>
            <a class="more-details" href="<?php the_permalink() ?>"><?php _e('More Details ','framework'); ?><i class="fa fa-caret-right"></i></a>
        </div>

        <div class="property-meta">
            <?php get_template_part('property-details/property-metas'); ?>
        </div>

    </article>
</div>