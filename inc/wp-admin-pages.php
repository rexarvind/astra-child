<?php

defined('ABSPATH') || die('403 Forbidden');

add_action('admin_menu', function () {
    add_dashboard_page('View CSV Data', 'View CSV Data', 'manage_options', 'child-view-csv-data', 'child_view_csv_data');
});
function child_view_csv_data() {
    ?>
    <div class="wrap">
        <h1>View CSV Data</h1>
        <p>Upload a csv file to view it's content.</p>
        <form enctype="multipart/form-data" method="POST" action="">
            <input type="file" name="csv_file" multiple="false" accept=".csv" required title="Upload CSV File" />
            <input type="submit" value="Upload" name="upload_csv" class="button button-primary" />
        </form>
        <?php if (isset($_REQUEST['upload_csv'])) {

            $csv_file = $_FILES['csv_file'];
            $inputFileName = $csv_file['tmp_name'];
            $fp = fopen($inputFileName, 'r');
            ?>
            <hr>
            <div style="overflow:auto;">
                <table class="striped widefat wp-list-table">
                    <tbody>
                        <?php while (($row = fgetcsv($fp)) !== false) { ?>
                            <tr>
                                <?php foreach ($row as $key => $value) { ?>
                                    <td><?php echo $value; ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php fclose($fp);
        } ?>
    </div>
    <?php
}
