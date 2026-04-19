<?php

/**
 * Title: Post List
 * Slug: consultica/post-list
 * Categories: consultica
 * @package Consultica
 * @since 1.0.0
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|80","bottom":"var:preset|spacing|80","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--80);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--80);padding-left:var(--wp--preset--spacing--40)"><!-- wp:buttons {"style":{"spacing":{"margin":{"top":"var:preset|spacing|40"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-buttons" style="margin-top:var(--wp--preset--spacing--40)"><!-- wp:button {"backgroundColor":"base","textColor":"primary","style":{"elements":{"link":{"color":{"text":"var:preset|color|primary"}}},"typography":{"fontSize":"12px","fontStyle":"normal","fontWeight":"700","lineHeight":"1.6"},"spacing":{"padding":{"left":"var:preset|spacing|30","right":"var:preset|spacing|30","top":"0","bottom":"0"}}}} -->
        <div class="wp-block-button"><a class="wp-block-button__link has-primary-color has-base-background-color has-text-color has-background has-link-color has-custom-font-size wp-element-button" style="padding-top:0;padding-right:var(--wp--preset--spacing--30);padding-bottom:0;padding-left:var(--wp--preset--spacing--30);font-size:12px;font-style:normal;font-weight:700;line-height:1.6"><?php echo esc_html__( 'Our Blogs', 'consultica' ); ?></a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->

    <!-- wp:heading {"textAlign":"center","style":{"typography":{"lineHeight":"1.3","fontStyle":"normal","fontWeight":"600"},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"base"} -->
    <h2 class="wp-block-heading has-text-align-center has-base-color has-text-color has-link-color" style="font-style:normal;font-weight:600;line-height:1.3"><?php echo esc_html__( 'latest from our Blogs', 'consultica' ); ?><br></h2>
    <!-- /wp:heading -->

    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained","contentSize":"75%"}} -->
    <div class="wp-block-group"><!-- wp:paragraph {"align":"center","style":{"typography":{"lineHeight":"1.6","fontStyle":"normal","fontWeight":"400"},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"base","fontSize":"small"} -->
        <p class="has-text-align-center has-base-color has-text-color has-link-color has-small-font-size" style="font-style:normal;font-weight:400;line-height:1.6"><?php echo esc_html__( 'Ut varius tincidunt libero. Curabitur at lacus ac velit ornare lobortis. Phasellus dolor. Vestibulum', 'consultica' ); ?> </p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->

    <!-- wp:query {"queryId":17,"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"parents":[],"format":[]},"metadata":{"categories":["posts"],"patternName":"core/query-standard-posts","name":"Standard"}} -->
    <div class="wp-block-query"><!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
        <!-- wp:group {"className":" home-blogs","style":{"spacing":{"blockGap":"var:preset|spacing|40","padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","right":"var:preset|spacing|50","left":"var:preset|spacing|50"},"margin":{"top":"var:preset|spacing|20","bottom":"var:preset|spacing|20"}}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group  home-blogs" style="margin-top:var(--wp--preset--spacing--20);margin-bottom:var(--wp--preset--spacing--20);padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:post-featured-image {"isLink":true,"width":"","height":"250px","scale":"contain","style":{"border":{"radius":"10px"}}} /-->

            <!-- wp:post-title {"textAlign":"left","isLink":true,"style":{"spacing":{"margin":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|xx-small"}},"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"textColor":"base"} /-->

            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"left"}} -->
            <div class="wp-block-group"><!-- wp:post-author {"textAlign":"left","avatarSize":24,"showAvatar":false,"textColor":"base","fontSize":"x-small"} /-->

                <!-- wp:paragraph {"fontSize":"x-small"} -->
                <p class="has-x-small-font-size">·</p>
                <!-- /wp:paragraph -->

                <!-- wp:post-date {"format":"M j, Y","textColor":"base","fontSize":"x-small"} /-->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
        <!-- /wp:post-template -->

        <!-- wp:query-no-results -->
        <!-- wp:paragraph {"align":"center","placeholder":"Add text or blocks that will display when a query returns no results."} -->
        <p class="has-text-align-center"></p>
        <!-- /wp:paragraph -->
        <!-- /wp:query-no-results -->
    </div>
    <!-- /wp:query -->
</div>
<!-- /wp:group -->