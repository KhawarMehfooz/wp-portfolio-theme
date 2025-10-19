<?php

use Roots\Acorn\Application;

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (!file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

Application::configure()
    ->withProviders([
        App\Providers\ThemeServiceProvider::class,
    ])
    ->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (!locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });

add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_style(
        'khwr-editor-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap',
        [],
        null
    );
});

function enqueue_contact_form_scripts()
{
    if (!is_admin()) {
        wp_enqueue_script('jquery');
    }
}
add_action('wp_enqueue_scripts', 'enqueue_contact_form_scripts');

add_action('wp_ajax_handle_contact_form_ajax', 'handle_contact_form_ajax');
add_action('wp_ajax_nopriv_handle_contact_form_ajax', 'handle_contact_form_ajax');

function handle_contact_form_ajax()
{
    if (!isset($_POST['contact_form_nonce']) || !wp_verify_nonce($_POST['contact_form_nonce'], 'handle_contact_form')) {
        wp_send_json_error('Invalid form submission (nonce failed).');
    }

    $name = sanitize_text_field($_POST['name'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    $captcha = $_POST['cf-turnstile-response'] ?? '';

    if (empty($name) || empty($email) || empty($message)) {
        wp_send_json_error('Please fill all required fields.');
    }

    if (get_field('enable_captcha', 'option')) {
        $secret_key = get_field('captcha_secret_key', 'option');
        $response = wp_remote_post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'body' => [
                'secret' => $secret_key,
                'response' => $captcha,
                'remoteip' => $_SERVER['REMOTE_ADDR'],
            ],
        ]);

        $body = json_decode(wp_remote_retrieve_body($response), true);
        if (empty($body['success'])) {
            wp_send_json_error('Captcha verification failed. Please try again.');
        }
    }

    $sender_email = get_field('contact_form_sender_email', 'option') ?: get_bloginfo('admin_email');
    $receiver_email = get_field('contact_form_receiver_email', 'option');

    $headers = [
        'Content-Type: text/html; charset=UTF-8',
        'From: ' . get_bloginfo('name') . ' <' . $sender_email . '>',
        'Reply-To: ' . $email,
    ];

    $subject = "Contact Form - " . get_bloginfo('name');

    $body = "
        <h2>New Message from {$name}</h2>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Message:</strong></p>
        <p>{$message}</p>
    ";

    $mail_sent = wp_mail($receiver_email, $subject, $body, $headers);

    if (!$mail_sent) {
        wp_send_json_error('Something went wrong while sending your message. Please try again later.');
    }

    wp_send_json_success();
}


