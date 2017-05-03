

<?php
$background = get_field('header_background', 'options');
$logo       = get_field('header_logo', 'options');

?>


<header class="header" style="background: linear-gradient( rgba(0, 50, 0, 0.3), rgba(0, 50, 0, 0.3) ), url(<?=$background['url'];?>); background-repeat: no-repeat; background-position: center top; background-size: cover;">
    <div class="container">
        <div class="header__top">


            <div class="header__logo" style="background-image: url(<?=$logo['url'];?>);  ">
            </div>
            




        <nav class="navbar">
            <?php
            if (has_nav_menu('primary_navigation')):

                wp_nav_menu(array(
                    'theme_location' => 'primary_navigation',
                    'menu_class'     => 'navbar__links',
                    'walker'         => new MyWalker
                    )
            );
            endif;
            ?>
        </nav>

    </div>




    <?php if (have_rows('header_module', 'options')): ?>
        <?php while (have_rows('header_module', 'options')): ?>
            <?php the_row(); ?>


            <?php if (get_row_layout() === 'module_slider'): ?>
               <?php
                                //loop?
               $slider['play-speed'] = get_sub_field('slider_play-speed');
               $slider['auto-play']  = get_sub_field('slider_auto-play');
               $slider['use-dots']   = get_sub_field('slider_use-dots');
               $slider['dots']       = $slider['use-dots'] ? 'true' : 'false';
               ?>
               <?php if (have_rows('slider_slide', 'options')): ?>
                <div class="slider row"
                data-dots="<?=$slider['dots'];?>"
                data-play-speed="<?=$slider['play-speed'];?>"
                data-auto-play="<?=$slider['auto-play'];?>">
                <?php while (have_rows('slider_slide', 'options')): ?>
                    <?php the_row();?>
                    <?php
                    $slide['title']       = get_sub_field('slide_title');
                    $slide['description'] = get_sub_field('slide_description');
                    $slide['image']       = get_sub_field('slide_image');
                    ?>
                    <div class="slider__slide" style="background-image: url(<?=$slide['image']['url'];?>);">
                        <div class="slider__content">
                            <div class="slider__title">
                                <?=$slide['title'];?>
                            </div>
                            <div class="slider__description">
                                <?=$slide['description'];?>
                            </div>
                            <?php if (have_rows('slide_component', 'options')): ?>
                                <?php while (have_rows('slide_component', 'options')): ?>
                                    <?php the_row();?>
                                    <?php if (get_row_layout() === 'slide_component_link-button'): ?>
                                        <?php
                                        $linkButton['label']          = get_sub_field('link-button_label');
                                        $linkButton['source']         = get_sub_field('link-button_source');
                                        $linkButton['page']           = get_sub_field('link-button_page');
                                        $linkButton['url']            = get_sub_field('link-button_url');
                                        $linkButton['user-icon']      = get_sub_field('link-button_user-icon');
                                        $linkButton['source']         = get_sub_field('link-button_source');
                                        $linkButton['icon']           = get_sub_field('link-button_icon');
                                        $linkButton['icon-placement'] = get_sub_field('link-button_icon-placement');
                                        $linkButton['link']           = ($linkButton['source'] === 'internal')
                                        ? $linkButton['page'] : $linkButton['url'];
                                        ?>
                                        <a class="slider__link" href="<?=$linkButton['link'];?>">
                                            <?php if ($linkButton['icon-placement'] === 'prepend'): ?>
                                                <?=$linkButton['icon'];?>
                                            <?php endif;?>
                                            <?=$linkButton['label'];?>
                                            <?php if ($linkButton['icon-placement'] === 'append'): ?>
                                                <?=$linkButton['icon'];?>
                                            <?php endif;?>
                                        </a>
                                    <?php endif;?>
                                <?php endwhile;?>
                            <?php endif;?>
                        </div><!-- /.slider__content -->
                    </div><!-- /.slider__slide -->
                <?php endwhile; ?>
            </div><!-- /.slider -->

        <?php endif; ?>
    <?php endif; ?>
<?php endwhile; ?>
<?php endif; ?>
</div>
</header>
