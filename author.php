<?php
/**
 * The template for displaying the author pages.
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package understrap
 */

get_header();
$container   = get_theme_mod( 'understrap_container_type' );
?>


    <div class="wrapper" id="author-wrapper">

        <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

            <div class="row">

                <!-- Do the left sidebar check -->
                <?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

                <main class="site-main" id="main">

                    <header class="page-header author-header">

                        <?php
					$curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug',
						$author_name ) : get_userdata( intval( $author ) );
					?>

                            <h2>
                                <?php esc_html_e( 'Tipster:', 'understrap' ); ?>
                                <?php echo esc_html( $curauth->nickname ); ?>
                            </h2>

                            <?php if ( ! empty( $curauth->ID ) ) : ?>
                            <?php echo get_avatar( $curauth->ID ); ?>
                            <?php endif; ?>

                            <dl>
                                <?php if ( ! empty( $curauth->user_url ) ) : ?>
                                <dt>
                                    <?php esc_html_e( 'Website', 'understrap' ); ?>
                                </dt>
                                <dd>
                                    <a href="<?php echo esc_url( $curauth->user_url ); ?>">
                                        <?php echo esc_html( $curauth->user_url ); ?>
                                    </a>
                                </dd>
                                <?php endif; ?>

                                <?php if ( ! empty( $curauth->user_description ) ) : ?>
                                <dt>
                                    <?php esc_html_e( 'Profile', 'understrap' ); ?>
                                </dt>
                                <dd>
                                    <?php echo esc_html( $curauth->user_description ); ?>
                                </dd>
                                <?php endif; ?>
                            </dl>

                            <h4 class="text-center">
                                <?php esc_html_e( 'Historique de', 'understrap' ); ?>
                                <?php echo esc_html( $curauth->nickname ); ?> :
                            </h4>

                    </header>
                    <!-- .page-header -->

                    <ul>

                        <!-- The Loop -->
                       
                        <?php 
                            $the_query = new WP_Query('category_name=Pronostic');
                           if ( have_posts() ) :
                            while ($the_query->have_posts()) : 
                               
                            $the_query->the_post();
                          $resultat = get_field('statut');
                         
                            if ($resultat != "En attente") : ?>
                            <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">ÉVÉNEMENT</th>
                                        <th scope="col">DATE</th>
                                        <th scope="col">SÉLECTION</th>
                                        <th scope="col">CÖTE</th>
                                        <th scope="col">RÉSULTAT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <td>
                                        <img class="sport_logo" src="<?php showIconSport();?>"> </td>
                                    <td>
                                        <?php the_field('adversaire_1');?> VS
                                        <?php the_field('adversaire_2');?>
                                    </td>

                                    <td>
                                        <?php the_field('date_du_match');?>
                                    </td>
                                    <td>
                                        <?php the_field('choix_de_pari');?>
                                        <br>
                                        <?php the_field('pronostic');?>

                                    </td>
                                    <td>
                                        <?php the_field('côte');?>
                                    </td>
                                    <td>
                               <img class="img-result"src="<?php showIconStatut();?>" alt="">
                            
                        </td>
                                </tbody>
                            </table>
                        </div>
<!-- // row -->
</div>


                        <?php  endif;?>
                        <?php endwhile; ?>

                        <?php else : ?>

<?php get_template_part( 'loop-templates/content', 'none' ); ?>

<?php endif; ?>

                        <!-- End Loop -->

                    </ul>

                </main>
                <!-- #main -->

                <!-- The pagination component -->
                <?php understrap_pagination(); ?>

            </div>
            <!-- #primary -->

            <!-- Do the right sidebar check -->
            <?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

        </div>
        <!-- .row -->

    </div>
    <!-- Container end -->

    </div>
    <!-- Wrapper end -->

    <?php get_footer(); ?>