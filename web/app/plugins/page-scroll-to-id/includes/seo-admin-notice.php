<?php
if (!class_exists('SEO_Admin_Notice')) {

    class SEO_Admin_Notice{
        public function __construct(){
            add_action('admin_notices', array($this, 'admin_notice'));
            add_action('network_admin_notices', array($this, 'admin_notice'));
            add_action('admin_init', array($this, 'dismiss_admin_notice'));
        }

        public function dismiss_admin_notice(){
            if (!isset($_GET['seo-adaction']) || $_GET['seo-adaction'] != 'seo_dismiss_adnotice') {
                return;
            }

            $url = admin_url();
            update_option('seo_dismiss_adnotice', 'true');

            wp_redirect($url);
            exit;
        }

        public function admin_notice(){
            if (get_option('seo_dismiss_adnotice', 'false') == 'true') {
                return;
            }

            $dismiss_url = esc_url_raw(
                add_query_arg(
                    array(
                        'seo-adaction' => 'seo_dismiss_adnotice'
                    ),
                    admin_url()
                )
            );
            $this->notice_css();
            $learn_more_url = 'https://seobuddy.com/seo-checklist/pagescroll';
            ?>
            <div id="ps2id-seo-admin-notice" class="notice notice-info">
                <p>
                    Thank you for using Page Scroll to id! If you like our plugin and want to support our effort to provide it for free, we would also like to recommend this 
                    <a href="<?php echo $learn_more_url; ?>" target="_blank"><strong class="em-text">102-Point SEO Checklist</strong></a>. It includes 42 step-by-step guides (SOPs) to every important SEO action you need to take to optimize your website and get more organic traffic. And using discount coupon <em>PAGESCROLL</em> you get a 25% off the original price!
                    <br />
                    <a href="<?php echo $learn_more_url; ?>" target="_blank" class="seo-checklist-learn-more">Learn more</a>
                    <a href="<?php echo $dismiss_url; ?>"><?php _e('Dismiss this notice'); ?></a>
                </p>
                <a href="<?php echo $learn_more_url; ?>" target="_blank" class="seo-checklist-logo" title="Learn more">
                    <img src="<?php echo plugins_url('the-seo-checklist-by-seo-buddy.png', __FILE__); ?>" />
                </a>
                <a href="<?php echo $dismiss_url; ?>" class="notice-dismiss seo-checklist-dismiss" title="<?php _e('Dismiss this notice'); ?>">
                   <span class="screen-reader-text"><?php _e('Dismiss this notice'); ?>.</span>
                </a>
            </div>
            <?php
        }

        public function notice_css(){
            ?>
            <style type="text/css">
            #ps2id-seo-admin-notice{
                position: relative;
                padding-right: 48px;
            }
            .seo-checklist-learn-more{
                margin-right: 1em;
            }
            .seo-checklist-logo{
                display: block;
                height: auto;
                max-width: 100%;
            }
            .seo-checklist-logo img{
                height: auto;
                max-width: 100%;
            }
            .em-text{
                font-weight: 400;
                font-size: 110%;
            }
            .notice-dismiss.seo-checklist-dismiss{
                text-decoration: none;
            }
            @media only screen and (min-width: 768px){
                .seo-checklist-logo{
                    position: absolute;
                    top: 56%;
                    transform: translateY(-50%);
                    right: 48px;
                }
                #ps2id-seo-admin-notice > p{
                    margin-right: 350px;
                }
            }
            @media only screen and (max-width: 767px){
                #ps2id-seo-admin-notice > p{
                    margin-bottom: 1em;
                }
            }
            </style>
            <?php
        }

        public static function instance(){
            static $instance = null;

            if (is_null($instance)) {
                $instance = new self();
            }

            return $instance;
        }
    }
}

SEO_Admin_Notice::instance();
?>