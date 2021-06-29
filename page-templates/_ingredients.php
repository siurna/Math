<?php
/*
 * Template Name: Ingredients Template  
 * Post Type: Page
*/
?>
<?php get_header(); ?>

<?php get_template_part( 'template-parts/page-heading' ); ?>

<section id="content">
    <div class="container">
        <div class="table-responsive">
            <table class="table-ingredients">

                <tr>
                    <th></th>
                    <th><?php esc_html_e( 'Saugumas', 'math' ); ?></th>
                    <th><?php esc_html_e( 'Gali kimšti poras', 'math' ); ?></th>
                    <th><?php esc_html_e( 'Gali erzinti odą', 'math' ); ?></th>
                    <th><?php esc_html_e( 'Gali sukelti alergiją', 'math' ); ?></th>
                    <th><?php esc_html_e( 'Paskirtis', 'math' ); ?></th>
                </tr>

                <?php
                $ingredients = get_terms( array('ingredients') );

                foreach ($ingredients as $ingredient) :
                    
                    $ingredient_slug = $ingredient->slug;
                    $ingredient_id = $ingredient->term_id; ?>

                    <tr>
                        <td><?= '<h6>'. $ingredient->name .'</h6>'; ?></td>
                        <?php $safety = get_field('saugumas', 'term_' . $ingredient_id); ?>
                        <td class="text-center <?= ($safety[0] == 'Safe') ? 'safe' : (($safety[0] == 'Good') ? 'good' : 'danger'); ?>">
                            <span class="table-label"><?php esc_html_e( 'Saugumas', 'math' ); ?></span>
                            <?= ($safety[0] == 'Safe') ? _e( 'Saugus', 'math' ) : 
                            (($safety[0] == 'Good')) ? _e( 'Vidutinio saugumo', 'math' ) : 
                            ($safety[0] == 'Danger') ? _e( 'Pavojingas', 'math' ) : ''; ?>                        
                        </td>
                        <td class="text-center">
                            <?php $poros_range = get_field('gali_kimsti_poras', 'term_' . $ingredient_id) ?>
                            
                            <div class="span table-label"><?php esc_html_e( 'Gali kimšti poras', 'math' ); ?></div>

                            <div>
                                <?php for ($i = 1; $i <= 5; $i++) : ?>
                                    <div class="range-counter <?= ($i <= $poros_range) ? 'active' : ''; ?>"></div>
                                <?php endfor; ?>     
                            </div>

                        </td>
                        <td class="text-center">
                            <?php $oda_range = get_field('gali_erzinti_oda', 'term_' . $ingredient_id); ?>
                            
                            <span class="table-label"><?php esc_html_e( 'Gali erzinti odą', 'math' ); ?></span>
                            <div>
                                <?php for ($x = 1; $x <= 5; $x++) : ?>
                                    <div class="range-counter <?= ($x <= $oda_range) ? 'active' : ''; ?>"></div>
                                <?php endfor; ?>
                            </div>

                        </td>
                        
                        <?php $alergen = get_field('gali_sukelti_alergija', 'term_' . $ingredient_id); ?>
                        <td class="text-center <?= ( $alergen[0] == 'Taip' ) ? 'allergy-yes' : 'allergy-no';?>" >

                            <span class="table-label"><?php esc_html_e( 'Gali sukelti alergiją', 'math' ); ?></span>

                            <?= ( $alergen[0] == 'Taip' ) ? $alergen[0] : esc_html_e( 'Ne', 'math' );?>

                        </td>
                        <td class="text-center">
                        
                            <span class="table-label"><?php esc_html_e( 'Paskirtis', 'math' ); ?></span>

                            <?php the_field('paskirtis', 'term_' . $ingredient_id); ?>

                        </td>
                    </tr>

                <?php endforeach; ?>
            </table>
        </div>
    </div>
</section>
<?php get_footer(); ?>