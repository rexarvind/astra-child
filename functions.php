<?php

// safely require php files
if (!function_exists('child_require_once')) {
    function child_require_once($path = ''){
        $path = get_stylesheet_directory() . $path;
        file_exists($path) ? require_once($path) : null;
    }
}

child_require_once('/inc/cpt.php');
child_require_once('/inc/header-hook.php');
child_require_once('/inc/footer-hook.php');


function child_enqueue_styles(){
    $tpl_dir = get_stylesheet_directory();
    $tpl_dir_uri = get_stylesheet_directory_uri();


    $path = '/css/bootstrap.min.css';
    if(file_exists($tpl_dir . $path)){
        wp_register_style('child-bootstrap-style', $tpl_dir_uri . $path, array(), '5.2.3');
    }
    $path = '/js/bootstrap.bundle.min.js';
    if(file_exists($tpl_dir . $path)){
        wp_register_script('child-bootstrap-script', $tpl_dir_uri . $path, array(), '5.2.3', true);
    }

    $path = '/js/alpine.min.js';
    if(file_exists($tpl_dir . $path)){
        wp_register_script('child-alpine-script', $tpl_dir_uri . $path, array(), '3.10.5', true);
    }


    $path = '/css/main.css';
    if(file_exists($tpl_dir . $path)){
        wp_register_style('child-main-style', $tpl_dir_uri . $path, array(), filemtime($tpl_dir . $path));
    }
    $path = '/js/main.js';
    if(file_exists($tpl_dir . $path)){
        wp_register_script('child-main-script', $tpl_dir_uri . $path, array('jquery'), filemtime($tpl_dir . $path), true);
    }

    // connect scripts for few templates like this in array format
    // if( is_page_template(['tpl-home.php', 'tpl-about.php']) ){
        wp_enqueue_style('child-bootstrap-style');
        wp_enqueue_script('child-bootstrap-script');
    // }

	wp_enqueue_style('child-main-style');
    wp_enqueue_script('child-main-script');

    // connecting alpine last so DOM event is ready
    if( is_page_template('tpl-alpine-demo.php') ){
        wp_enqueue_script('child-alpine-script');
    }
}
add_action('wp_enqueue_scripts', 'child_enqueue_styles', 50);



function child_setup_theme(){
    add_theme_support('custom-header', array(
        'height' => '40',
        'flex-height' => true,
        'width' => '140',
        'flex-width' => true,
        'uploads' => true,
        'header-text' => true,
    ));
    add_theme_support(
        'custom-logo',
        array(
            'height' => 145,
            'weight' => 45,
            'flex-height' => true,
            'flex-weight' => true,
        )
    );

    // register_nav_menus(array(
    //     'footer1' => __('Footer 1', 'astra-child'),
    //     'footer2' => __('Footer 2', 'astra-child'),
    // ));
}
add_action('after_setup_theme', 'child_setup_theme');



// Support for ACF Option page
if( function_exists('acf_add_options_page') ){
    acf_add_options_page();
}

// Remove extra <p> tags from Contact Form 7
add_filter('wpcf7_autop_or_not', '__return_false');
add_filter( 'wpcf7_validate_configuration', '__return_false' );


// sample ajax request
// http://example.com/wp-admin/admin-ajax.php?action=test_ajax
function test_ajax(){
    echo json_encode(['status'=> true, 'message'=> 'Request successfull.']);
    exit(0);
}
add_action('wp_ajax_test_ajax', 'test_ajax');
add_action('wp_ajax_nopriv_test_ajax', 'test_ajax');



add_action('admin_menu', function(){
    add_dashboard_page('View CSV Data', 'View CSV Data', 'manage_options', 'child-view-csv-data', 'child_view_csv_data',);
});
function child_view_csv_data(){
    ?>
    <div class="wrap">
        <h1>View CSV Data</h1>
        <p>Upload a csv file to view it's content.</p>
        <form enctype="multipart/form-data" method="POST" action="">
            <input type="file" name="csv_file" multiple="false" accept=".csv" required title="Upload CSV File" />
            <input type="submit" value="Upload" name="upload_csv" class="button button-primary" />
        </form>
    </div>
    <?php

    if (isset($_REQUEST['upload_csv'])) {
        $csv_file = $_FILES['csv_file'];
        $inputFileName = $csv_file['tmp_name'];
        $fp = fopen($inputFileName, 'r');
        ?>
        <div style="overflow:auto;">
            <table class="striped widefat wp-list-table">
                <tbody>
                    <?php while (($row = fgetcsv($fp)) !== FALSE) { ?>
                        <tr>
                            <?php foreach ($row as $key => $value) { ?>
                                <td><?php echo $value; ?></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <?php
        fclose($fp);
    }
}

