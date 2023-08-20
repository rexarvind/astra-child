<?php

defined('ABSPATH') || die('403 Forbidden');

/* use smtp to send emails from wp_mail(). for email use app password and not the actual password */

add_action('phpmailer_init', function ($phpmailer) {
    $smtp_config = get_option('child_smtp_config');
    $smtp_config = $smtp_config ? unserialize($smtp_config) : [];
    if (isset($smtp_config['enabled']) && $smtp_config['enabled'] == 'yes') {
        $phpmailer->isSMTP();
        $phpmailer->Port = $smtp_config['port'];
        $phpmailer->SMTPAuth = true;
        $phpmailer->SMTPSecure = $smtp_config['secure'] == 'none' ? false : $smtp_config['secure'];
        $phpmailer->Host = $smtp_config['host'];
        $phpmailer->Username = $smtp_config['username'];
        $phpmailer->Password = $smtp_config['password'];
        $phpmailer->From = $smtp_config['sender_email'];
        $phpmailer->FromName = $smtp_config['sender_name'];
    }
});

/* log email errors */
add_action('wp_mail_failed', function ($error) {
    error_log($error->get_error_message());
});

/* change sender email */
add_filter('wp_mail_from', function ($original_email_address) {
    $smtp_config = get_option('child_smtp_config');
    $smtp_config = $smtp_config ? unserialize($smtp_config) : [];
    if (isset($smtp_config['sender_email']) && filter_var(trim($smtp_config['sender_email']), FILTER_VALIDATE_EMAIL)) {
        return trim($smtp_config['sender_email']);
    }
    return $original_email_address;
});

/* change sender name */
add_filter('wp_mail_from_name', function ($original_email_from) {
    $smtp_config = get_option('child_smtp_config');
    $smtp_config = $smtp_config ? unserialize($smtp_config) : [];
    if (isset($smtp_config['sender_name']) && trim($smtp_config['sender_name']) !== '') {
        return $smtp_config['sender_name'];
    }
    return $original_email_from;
});

/* send test email with wp_mail and mail start */
add_action('admin_menu', function () {
    add_dashboard_page('Send Test Email', 'Send Test Email', 'manage_options', 'child-send-test-email', 'child_send_test_email_html');
});
function child_send_test_email_html()
{
    $admin_url = admin_url('/');
    $ajax_url = $admin_url . 'admin-ajax.php';
    $nonce = wp_create_nonce('send-test-email-ajax-nonce');
    $smtp_config = get_option('child_smtp_config');
    $smtp_config = $smtp_config ? unserialize($smtp_config) : [];
    $smtp_config_nonce = wp_create_nonce('child-smtp-config-ajax-nonce');
?>
    <div class="wrap">
        <h1><strong>Send Test Emails</strong></h1>
        <p>Instantly check if your website is sending emails or not.</p>
        <hr>
        <form method="post" id="child-send-test-email-form" action="<?php echo $ajax_url; ?>">
            <table cellpadding="8" border="0" style="width:540px;max-width:100%">
                <tbody>
                    <tr>
                        <td>Emails:</td>
                        <td colspan="2">
                            <input type="text" title="Emails" name="emails" placeholder="abc@site.com, xyz@site.com" required style="width:100%;">
                        </td>
                    </tr>
                    <tr>
                        <td>Method:</td>
                        <td>
                            <label>
                                <input type="radio" value="wp_mail" name="method" title="WP Mail" required checked> WP Mail
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" value="mail" name="method" title="WP Mail" required> PHP Mail
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="padding-top:0;padding-bottom:0;">
                            <div id="child-send-test-email-status" class="form-response"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="_nonce" value="<?php echo $nonce; ?>">
                            <input type="hidden" name="action" value="child-send-test-email-ajax">
                        </td>
                        <td colspan="2">
                            <button type="submit" class="button button-primary form-submit-btn" style="position:relative;">
                                <span class="form-submit-btn-loader" style="display:none;">
                                    <img src="<?php echo $admin_url; ?>images/spinner.gif" alt="loading">
                                </span>
                                Send Test Email
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
        <hr>
        <h2><strong>SMTP Settings</strong></h2>
        <p>These settings will be applied to your website for sending emails.</p>
        <form id="child-smtp-config-form" method="post" action="<?php echo $ajax_url; ?>">
            <table cellpadding="8" border="0" style="width:540px;max-width:100%;">
                <tbody>
                    <tr>
                        <td>Enabled:</td>
                        <td colspan="2">
                            <label>
                                <input type="radio" name="enabled" title="Yes" value="yes" <?php echo (isset($smtp_config['enabled']) && $smtp_config['enabled'] == 'yes') ? 'checked' : ''; ?> required> Yes
                            </label>
                        </td>
                        <td colspan="2">
                            <label>
                                <input type="radio" name="enabled" title="No" value="no" <?php echo ((isset($smtp_config['enabled']) && $smtp_config['enabled'] == 'no') || !isset($smtp_config['enabled']) || (isset($smtp_config['enabled']) && $smtp_config['enabled'] !== 'yes')) ? 'checked' : ''; ?> required> No
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>Host:</td>
                        <td colspan="2">
                            <input type="text" name="host" title="Host" value="<?php echo isset($smtp_config['host']) ? $smtp_config['host'] : ''; ?>" required style="width:100%;">
                        </td>
                        <td>Port:</td>
                        <td>
                            <input type="number" name="port" title="Port" value="<?php echo isset($smtp_config['port']) ? $smtp_config['port'] : ''; ?>" required style="width:100%;">
                        </td>
                    </tr>
                    <tr>
                        <td>Secure:</td>
                        <td>
                            <label>
                                <input type="radio" name="secure" value="ssl" <?php echo (isset($smtp_config['secure']) && $smtp_config['secure'] == 'ssl') ? 'checked' : ''; ?> required> SSL
                            </label>
                        </td>
                        <td>
                            <label>
                                <input type="radio" name="secure" value="tls" <?php echo (isset($smtp_config['secure']) && $smtp_config['secure'] == 'tls') ? 'checked' : ''; ?> required> TLS
                            </label>
                        </td>
                        <td colspan="2">
                            <label>
                                <input type="radio" name="secure" value="none" <?php echo (isset($smtp_config['secure']) && $smtp_config['secure'] == 'none') ? 'checked' : ''; ?> required> None
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td colspan="4">
                            <input type="text" name="username" title="Username" placeholder="" value="<?php echo isset($smtp_config['username']) ? $smtp_config['username'] : ''; ?>" required style="width:100%;">
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td colspan="4">
                            <input type="text" name="password" title="Password" placeholder="" value="<?php echo isset($smtp_config['password']) ? $smtp_config['password'] : ''; ?>" required style="width:100%;">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Sender Email:</td>
                        <td colspan="3">
                            <input type="email" name="sender_email" title="Sender Email" value="<?php echo isset($smtp_config['sender_email']) ? $smtp_config['sender_email'] : ''; ?>" required style="width:100%;">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Sender Name:</td>
                        <td colspan="3">
                            <input type="text" name="sender_name" title="Sender Name" value="<?php echo isset($smtp_config['sender_name']) ? $smtp_config['sender_name'] : ''; ?>" required style="width:100%;">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" style="padding-top:0;padding-bottom:0;">
                            <div id="child-smtp-config-status" class="form-response"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="hidden" name="_nonce" value="<?php echo $smtp_config_nonce; ?>">
                            <input type="hidden" name="action" value="child-smtp-config-ajax">
                        </td>
                        <td colspan="3">
                            <button type="submit" class="button button-primary form-submit-btn" style="position:relative;">
                                <span class="form-submit-btn-loader" style="display:none;">
                                    <img src="<?php echo $admin_url; ?>images/spinner.gif" alt="loading">
                                </span>
                                Update SMTP Settings
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <style type="text/css">
        .form-submit-btn {
            position: relative;
        }

        .form-submit-btn-loader {
            position: absolute;
            left: 5px;
            top: 0;
            bottom: 0;
            align-items: center;
            justify-content: center;
        }

        .form-response.success,
        .form-response.error {
            padding: 5px 9px;
            border: 1px solid;
            border-radius: 4px;
            margin: 0 !important;
        }

        .form-response.success {
            background: #dcfce7;
            color: #166534;
            border-color: #166534;
        }

        .form-response.error {
            background: #fee2e2;
            color: #991b1b;
            border-color: #991b1b;
        }
    </style>
    <script type="text/javascript">
        jQuery(function($) {
            var form = document.getElementById('child-send-test-email-form');
            var statusEl = document.getElementById('child-send-test-email-status');
            if (form && statusEl) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    var submitBtn = form.querySelector('.form-submit-btn');
                    submitBtn.disabled = true;
                    var submitLoader = form.querySelector('.form-submit-btn-loader');
                    submitLoader.style.display = 'flex';
                    statusEl.textContent = 'Connecting...';
                    statusEl.classList.remove('success', 'error');
                    var formData = new FormData(form);
                    jQuery.ajax({
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        url: form.getAttribute('action'),
                    }).done(function(res) {
                        var res = JSON.parse(res)
                        if (res.message) {
                            statusEl.textContent = res.message;
                            statusEl.classList.add(res.status ? 'success' : 'error');
                        }
                        submitBtn.disabled = false;
                        submitLoader.style.display = 'none';
                    }).fail(function(err) {
                        console.log(err);
                        statusEl.classList.add('error');
                        statusEl.textContent = 'An error occurred, please check browser console.';
                        submitBtn.disabled = false;
                        submitLoader.style.display = 'none';
                    });
                });
            }
        });
    </script>
    <script type="text/javascript">
        jQuery(function($) {
            var form = document.getElementById('child-smtp-config-form');
            var statusEl = document.getElementById('child-smtp-config-status');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    var submitBtn = form.querySelector('.form-submit-btn');
                    submitBtn.disabled = true;
                    var submitLoader = form.querySelector('.form-submit-btn-loader');
                    submitLoader.style.display = 'flex';
                    statusEl.textContent = 'Connecting...';
                    statusEl.classList.remove('success', 'error');
                    var formData = new FormData(form);
                    jQuery.ajax({
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        url: form.getAttribute('action'),
                    }).done(function(res) {
                        var res = JSON.parse(res)
                        if (res.message) {
                            statusEl.textContent = res.message;
                            statusEl.classList.add(res.status ? 'success' : 'error');
                        }
                        submitBtn.disabled = false;
                        submitLoader.style.display = 'none';
                    }).fail(function(err) {
                        console.log(err);
                        statusEl.classList.add('error');
                        statusEl.textContent = 'An error occurred, please check browser console.';
                        submitBtn.disabled = false;
                        submitLoader.style.display = 'none';
                    });
                });
            }
        });
    </script>
<?php
}

function child_send_test_email_ajax()
{
    $emails = isset($_POST['emails']) ? $_POST['emails'] : '';
    $method = isset($_POST['method']) ? $_POST['method'] : '';
    $nonce = isset($_POST['_nonce']) ? $_POST['_nonce'] : '';
    $bcc_email = SITE_DEV_EMAIL;
    $timestamp = date('d M, Y h:i:s A');
    if (wp_verify_nonce($nonce, 'send-test-email-ajax-nonce')) {
        $emails = explode(',', $emails);
        $hasInvalidEmail = false;
        foreach ($emails as $key => $email) {
            if (!filter_var(trim($email), FILTER_VALIDATE_EMAIL)) {
                $hasInvalidEmail = true;
                break;
            }
        }
        if ($hasInvalidEmail) {
            echo json_encode(['status' => false, 'message' => 'Only use valid email address.']);
        } else {
            $to = implode(',', $emails);
            $subject = 'Test Email sent on ' . $timestamp;
            $body = 'Just testing email delivery.';
            if ($method == 'wp_mail') {
                $headers = [
                    'Content-Type: text/html; charset=UTF-8',
                    'Bcc: ' . $bcc_email,
                ];
                if (wp_mail($to, $subject, $body, $headers)) {
                    echo json_encode(['status' => true, 'message' => 'Email sent successfully. Check the inbox or spam folder.']);
                } else {
                    echo json_encode(['status' => false, 'message' => 'Error occurred, can not send email. Please check email configurations.']);
                }
            } else if ($method == 'mail') {
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= "Bcc: " . $bcc_email . "\r\n";
                if (mail($to, $subject, $body, $headers)) {
                    echo json_encode(['status' => true, 'message' => 'Email sent successfully. Check the inbox or spam folder.']);
                } else {
                    echo json_encode(['status' => false, 'message' => 'Error occurred, can not send email. Please check email configurations.']);
                }
            } else {
                echo json_encode(['status' => false, 'message' => 'Unknown method, please choose either WP Mail or PHP Mail.']);
            }
        }
    } else {
        echo json_encode(['status' => false, 'message' => 'Please refresh page, security token expired.']);
    }
    exit();
}
add_action('wp_ajax_child-send-test-email-ajax', 'child_send_test_email_ajax');
/* send test email with wp_mail and mail end */

/* smtp config start */
function child_smtp_config_ajax()
{
    $nonce = isset($_POST['_nonce']) ? $_POST['_nonce'] : '';
    if (wp_verify_nonce($nonce, 'child-smtp-config-ajax-nonce')) {
        $enabled = isset($_POST['enabled']) ? $_POST['enabled'] : 'no';
        $host = isset($_POST['host']) ? $_POST['host'] : '';
        $port = isset($_POST['port']) ? $_POST['port'] : '';
        $secure = isset($_POST['secure']) ? $_POST['secure'] : 'none';
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $sender_email = isset($_POST['sender_email']) ? $_POST['sender_email'] : '';
        $sender_name = isset($_POST['sender_name']) ? $_POST['sender_name'] : '';
        $data = [
            'enabled' => $enabled,
            'host' => $host,
            'port' => $port,
            'secure' => $secure,
            'username' => $username,
            'password' => $password,
            'sender_email' => $sender_email,
            'sender_name' => $sender_name,
        ];
        $data_string = serialize($data);
        $update_status = update_option('child_smtp_config', $data_string);
        if ($update_status) {
            echo json_encode(['status' => true, 'message' => 'Settings updated successfully.']);
        } else {
            echo json_encode(['status' => false, 'message' => 'An error occurred.']);
        }
    } else {
        echo json_encode(['status' => false, 'message' => 'Please refresh page, security token expired.']);
    }
    exit();
}
add_action('wp_ajax_child-smtp-config-ajax', 'child_smtp_config_ajax');
/* smtp config end */
