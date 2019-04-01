<?php
/**
 * Header - Install
 *
 * @author      NanoAgency
 * @link        http://nanoagency.co
 * @copyright   Copyright (c) 2015 NanoAgency
 * @license     GPL v2
 */
?>
<div id="tabs-container" role="tabpanel">
    <h2 class="nav-tab-wrapper">
        <a class="nav-tab active" href="#welcome"><?php esc_html_e( 'Install', 'redmag' ); ?></a>
        <a class="nav-tab" href="#plugins"><?php esc_html_e( 'Plugins', 'redmag' ); ?></a>
        <a class="nav-tab" href="#sample"><?php esc_html_e( 'Sample Data', 'redmag' ); ?></a>
        <a class="nav-tab" href="#support"><?php esc_html_e( 'Support', 'redmag' ); ?></a>
    </h2>
    <!-- .tab-header -->
    <div class="tab-content">
        <div id="welcome" class="tab-pane active" role="tabpanel">
            <?php redmag_Admin_Pages::redmag_welcome_page(); ?>
        </div>
        <div id="plugins" class="tab-pane" role="tabpanel">
            <?php redmag_Admin_Pages::redmag_plugins_page(); ?>
        </div>
        <div id="sample" class="tab-pane" role="tabpanel">
            <?php redmag_Admin_Pages::redmag_sample_page(); ?>
        </div>
        <div id="support" class="tab-pane" role="tabpanel">
            <?php redmag_Admin_Pages::redmag_support_page(); ?>
        </div>
    </div>
    <!-- .tab-content -->
</div>