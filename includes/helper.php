<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function prefix_enqueue() {       
    // JS
    wp_register_script('prefix_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
    wp_enqueue_script('prefix_bootstrap');
    
    wp_enqueue_script('my-styles', WC_PLUGIN_URL . 'assets/insert_variation_main.js' );
    
    // CSS
    wp_register_style('prefix_bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
    wp_enqueue_style('prefix_bootstrap');
    
    wp_enqueue_style('my-styles', WC_PLUGIN_URL . 'assets/styles.css' );
    
    
}

function prefix_enqueue_insert_variation() {       
    // JS
    wp_enqueue_script('my-styles', WC_PLUGIN_URL . 'assets/insert_variation_main.js' );
}

function create_iframe($iframe_function, $header, $task = '') {
    
    if (!empty($task)) {
        $header = '<strong>' . $header  . ': </strong>' . $task;
    } else {
        $header = '<strong>' . $header  . '</strong>';
    }
    
    echo '<div class="row">
            <div class="col-lg-12">
               <div class="panel panel-default">
                  <div class="panel-heading">' . $header . '</div>
                  <div class="panel-body">
                     <div class="row">
                           <div style="overflow: hidden; margin-left: 15px; margin-bottom: 15px; max-width: 150%;">
                              <iframe id="iframe-mt" class="iframe-mt" scrolling="yes" src="admin.php?page='. $iframe_function .'" style="border: 0px none; margin-left: -160px; height: 500px; margin-top: -50px; margin-bottom: -50px; width: 1180px;"> 
                              </iframe>
                           </div>
                           <button id="iframe_sroll_up" name="iframe_sroll_up" class="btn btn-default" style="margin-left: 20px;">Sroll Up</button>
                           <button id="iframe_sroll_down" name="iframe_sroll_down" class="btn btn btn-info" style="margin-left: 20px;">Sroll Down</button>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>';
}
?>