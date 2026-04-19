<?php
$pro_purchase_url = "https://trendthemeswp.com/products/consultica-pro";
$doc_url = "https://trendthemeswp.com/products/consultica-pro";
$live_demo_url = "http://demos.trendthemeswp.com/consultica-pro/";
$support_url = "https://trendthemeswp.com/contact-us/";

$theme_name = esc_html( $theme->Name );
$free_theme_name = str_replace( ' Pro', '',$theme_name );
?>
<div class="consultica--about-page--wrapper">
    <div id="consultica-admin-about-page">
        <div class="consultica-admin-card-header">
            <div class="consultica-header-left">
                <h2>
                    <?php echo esc_html( $theme->Name ); ?>
                </h2>
                <p>
                    <?php esc_html_e( 'Consultica - A Multipurpose, browser & device-friendly Full Site Editing Theme for WordPress', 'consultica' ); ?>
                </p>

            </div>
            <div class="consultica-header-right">
                <div class="consultica-card-header-button-group">
                    <a href="<?php echo $live_demo_url; ?>" class="consultica-admin-button premium-button" target="_blank"
                        rel="noreferrer"><span class="dashicons dashicons-book-alt"></span>
                        <?php esc_html_e( 'Pro Live Demo', 'consultica' ); ?>
                    </a>
                </div>
            </div>
        </div>

        <div class="feature-list">
            <div class="consultica-about-container">
                <div class="consultica-admin-card features">
                    <div class="consultica-about-container consultica-compare-table">
                        <div class="admin-grid-1">
                            <h3>
                                <?php echo esc_html( $free_theme_name ); ?>
                                <?php esc_html_e( 'Free Vs Pro', 'consultica' ); ?>
                            </h3>
                            <p class="consultica-compare-table-subtitle"><a href="<?php echo $pro_purchase_url; ?>"
                                    target="__blank">
                                    <?php echo esc_html( 'Get Consultica Pro', 'consultica' ); ?>
                                    <i class="dashicons dashicons-arrow-right-alt"></i>
                                </a></p>
                            <table>
                                <thead>
                                    <tr>
                                        <th>
                                            <?php echo esc_html( $theme->Name ); ?>
                                            <?php esc_html_e( 'Free', 'consultica' ); ?>
                                            <?php esc_html_e( '( Limited blocks available )', 'consultica' ); ?>
                                            
                                        </th>
                                        <th>
                                            <?php esc_html_e( 'Features', 'consultica' ); ?>
                                        </th>
                                        <th>
                                            <?php esc_html_e( 'Consultica Pro ( More Blocks & Settings available )', 'consultica' ); ?>
                                        </th>
                                    </tr>
                                </thead>
                                                             <tbody>
                                    <tr>
                                        <td><span class="dashicons"><?php echo esc_html__('Limited', 'consultica'); ?></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('All Pre-Built Template', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons"><?php echo esc_html__('Unlimited', 'consultica'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Easy Setup', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Responsive Desgin', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons"><?php echo esc_html__('Good', 'consultica'); ?></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Speed and Performance', 'consultica'); ?>
                                        </td>
                                        <td><span class=""><?php echo esc_html__('Ultra fast and Lightweight', 'consultica'); ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('SEO Friendly', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Animation', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Back to Top Button (Scrool to Top)', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Icon Picker', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Contact Form', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('24/7 premium support', 'consultica'); ?>
                                        </td>
                                        <td><?php esc_html_e('High-Priority Dedicated Support', 'consultica'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Different niches starter sites', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Secure transaction', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Lifetime Updates', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('No coding required', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="dashicons dashicons-yes"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Better Customization Without Code', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Advanced Templates', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Multiple Header/Footer Layouts', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons ">Limited</span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Block Patterns', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons">Unlimited</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons">Limited</span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Global Style Variations', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Premium Support', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Frequent Updates', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Drag and Drop functionality', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e(' Featured Slider', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php esc_html_e('Limited', 'consultica'); ?>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Typography and color options', 'consultica'); ?>
                                        </td>
                                        <td><?php esc_html_e('Unlimited', 'consultica'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php esc_html_e('Limited', 'consultica'); ?>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Import components/ templates', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('One Click Demo Import', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Gutenberg block editor', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Profile card (Block)', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php esc_html_e('Limited', 'consultica'); ?>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Blog (block)', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span><?php esc_html_e('Unlimited', 'consultica'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Testimonials(block)', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><?php esc_html_e('Limited', 'consultica'); ?>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Templates and block patterns', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><?php esc_html_e('Limited', 'consultica'); ?>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Advanced Color Options', 'consultica'); ?>
                                        </td>
                                        <td><?php esc_html_e('Unlimited', 'consultica'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Enable Testimonial Slider', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Enable Sponsor Slider', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class="dashicons dashicons-no"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Enable Sticky Header', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Google Maps zoom level settings', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>

                                    <tr>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                        <td>
                                            <?php esc_html_e('Edit each areas of website(header, footer, sidebar)', 'consultica'); ?>
                                        </td>
                                        <td><span class="dashicons dashicons-yes"></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="consultica-about-side">
                <div class="consultica-admin-card cart-two">
                    <h3 class="consultica-admin-card-title is-small">
                        <?php esc_html_e( 'Questions Welcome - We\'re here to help', 'consultica' ); ?>
                    </h3>
                    <p>
                        <?php esc_html_e( '"Fearless Setup - Our Dedicated Team will have your website up in minutes', 'consultica' ); ?>
                    </p><a href="<?php echo $support_url; ?>" class="consultica-admin-button primary large"
                        target="_blank">
                        <?php esc_html_e( 'Get Support', 'consultica' ); ?>
                    </a>
                    <a href="<?php echo $pro_purchase_url; ?>" class="consultica-admin-button primary large"
                        target="_blank">
                        <?php esc_html_e( 'Get Premium Version', 'consultica' ); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>