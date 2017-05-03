<?php $fieldName = 'footer';?>
<?php if (have_rows($fieldName, 'options')): ?>
    <footer class="footer">
        <div class="container">
            <div class="row">
                <?php $i = 0;?>
                <?php while (have_rows($fieldName, 'options')): ?>

                    <?php
                    the_row();
                    $layout     = get_row_layout();
                    $label      = get_sub_field('label');


                    //fix line
                    $contentMod = $i > 0 && $i < count(get_field($fieldName, 'options')) - 1 ? 'footer__section--seperator' : '';


                    ?>

                    <?php

                    if ('image' === $layout) {
                        $sectionWrapperClass = 'col-sm-12';
                    } else {
                        $sectionWrapperClass = 'col-sm-6';
                    }

                    ?>

                    <section class="
                    footer__section-wrapper
                    <?=$sectionWrapperClass;?>

                    col-xs-12 col-md"
                    >

                    <div class="
                    footer__section
                    <?=$contentMod;?>

                    ">

                    <?php if (have_rows('items', 'options')): ?>
                        <h4 class="footer__title">
                            <?=$label;?>
                        </h4>
                        <ul class="footer__items">
                            <?php while (have_rows('items', 'options')): ?>
                                <?php the_row();?>

                                <?php if ('text' === $layout): ?>
                                    <?php if ($text = get_sub_field('text')): ?>
                                        <li class="footer__item">
                                            <?=$text;?>
                                        </li>
                                    <?php endif;?>

                                <?php elseif ('link' === $layout): ?>
                                    <?php
                                    $label  = get_sub_field('label');
                                    $source = get_sub_field('source');
                                    $page   = get_sub_field('page');
                                    $url    = get_sub_field('url');
                                    $link   = $source === 'internal' ? $page : $url;
                                    ?>
                                    <li class="footer__item">
                                        <a class="footer__link" href="<?=$link;?>">
                                            <?=$label;?>
                                        </a>
                                    </li>
                                <?php elseif ('social_icon' === $layout): ?>
                                    <?php
                                    $network = strtolower(get_sub_field('network', 'options'));
                                    $url     = get_sub_field('url', 'options');
                                    ?>
                                    <li class="footer__item--icon footer__item">
                                        <a href="<?=$url;?>" class="btn-social-icon--grass btn btn-social-icon btn-<?=$network;?>">
                                            <span class="fa fa-<?=$network;?>">
                                            </span>
                                        </a>
                                    </li>
                                <?php endif;?>
                            <?php endwhile;?>
                        </ul>
                    <?php elseif ($logo = get_sub_field('image')): ?>
                        <img class="footer__logo" alt="<?=$logo['alt'];?>" src="<?=$logo['sizes']['thumbnail'];?>" />
                    <?php endif;?>
                </div>
            </section>
            <?php $i++;?>
        <?php endwhile;?>
    </div>
</div>
</footer>
<?php endif;?>
