<?php
        $post_meta_data = get_post_custom($post->ID);

        if( !empty($post_meta_data['REAL_HOMES_ganado_edad'][0]) ) {
                $prop_age = floatval($post_meta_data['REAL_HOMES_ganado_edad'][0]);
                $age_label = 'Meses de Edad';
                echo '<span><i class="icon-age"></i>'. $prop_age .'&nbsp;'.$age_label.'</span>';
        }

        if( !empty($post_meta_data['REAL_HOMES_ganado_peso'][0]) ) {
                $prop_weight = floatval($post_meta_data['REAL_HOMES_ganado_peso'][0]);
                $weight_label = 'Peso';
                echo '<span><i class="icon-weight"></i>'. $prop_weight .'&nbsp;'.$weight_label.'</span>';
        }

  ?>