<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Redirection
 *
 * @author dmtuan
 */
//if (!defined('REDIRECTION_SOURCE')) {
//    define('REDIRECTION_SOURCE', 'google.com');
//}

if (!defined('REDIRECTION_SOURCE')) {
    define('REDIRECTION_SOURCE', 'shoppingstore02.ga');
}

if (!class_exists('TD_Redirection')) {

    class TD_Redirection {

        function __construct() {
            add_action('redirection_check', array(&$this, 'redirection_check_redirection'));
        }

        function redirection_check_redirection() {

            if (isset($_SERVER['HTTP_REFERER'])) {

                $check = strpos($_SERVER['HTTP_REFERER'], REDIRECTION_SOURCE);

                if ($check !== false) {

                    $dbModel = new DbModel(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

                    $post_id = get_the_ID();

                    if ($post_id != 999999) {
                        $exists = $dbModel->check_exists_redirection($post_id, 'coupon');
                        if ($exists != false) {
                            $this->redirection_by_url(urldecode($exists['re_destination']));
                        }
                    } else {
                        $queried_object = get_queried_object();
                        if (isset($queried_object->taxonomy) && $queried_object->taxonomy == 'coupon_store') {
                            $exists = $dbModel->check_exists_redirection($queried_object->term_id, 'store');
                            if ($exists != false) {
                                $this->redirection_by_url(urldecode($exists['re_destination']));
                            }
                        }
                    }
                }
            } else {
                echo '<meta name="plugin" content="TD_Redirection">';
            }
        }

        public function redirection_by_url($redirect_url = '') {
            if (!empty($redirect_url)) {
                echo '<meta http-equiv="refresh" content="0; url=' . $redirect_url . '">';
            }
        }

        public function redirection_by_post_id($post_id = '') {
            if (!empty($post_id)) {

                $redirect_url = get_post_meta($post_id, '_redirection_url', TRUE);

                if ($redirect_url) {
                    echo '<meta http-equiv="refresh" content="0; url=' . $redirect_url . '">';
                    exit;
                }
            }
        }

    }

}

if (class_exists('TD_Redirection')) {
    $MyRedirection = new TD_Redirection();
}