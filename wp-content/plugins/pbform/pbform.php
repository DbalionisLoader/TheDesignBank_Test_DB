<?php

/**
 * Plugin Name: PB Form
 * Description: Plugin to send form JOSN form data via REST API to a google sheet.
 * Version: 1.0.0
 * Author: David B.
 */

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Shortcut definitions
 */

add_shortcode('pbform', 'pb_form_render_shortcode');

function pb_form_enqueue_styles()
{

  $css_file = plugin_dir_path(__FILE__) . 'assets/css/contact-form.css';
  wp_enqueue_style(
    'contact-form',
    plugin_dir_url(__FILE__) . 'assets/css/contact-form.css',
    array(),
    filemtime($css_file)
  );
}

add_action('wp_enqueue_scripts', 'pb_form_enqueue_styles');




/**
 * Create JSON array, handle POST
 * Test the output before linking to google sheet - NOT DONE
 * 
 * Steps: 
 * 1: Declare function
 * 2: Assign vars and array
 * 3: Sanitize and insert the form field values into the $form_values area
 * 4: Create a fresh payload array with sanitized values and convert into json
 * 5: wp_remote_post the payload to google script url to add it google sheet
 */

function pb_form_render_shortcode()
{

  $json_output2 = '';
  $form_values = [
    'name' => '',
    'email' => '',
    'message' => '',
  ];

  if ('POST' === $_SERVER['REQUEST_METHOD'] && isset($_POST['pbform_submitted'])) {

    $form_values['name'] = isset($_POST['pb_name']) ? sanitize_text_field(wp_unslash($_POST['pb_name']))
      : '';

    $form_values['email'] = isset($_POST['pb_email']) ? sanitize_email(wp_unslash($_POST['pb_email']))
      : '';

    $form_values['message'] = isset($_POST['pb_message']) ? sanitize_textarea_field(wp_unslash($_POST['pb_message']))
      : '';

    $payload = [
      'name' => $form_values['name'],
      'email' => $form_values['email'],
      'message' => $form_values['message'],
    ];

    $json_output2 = wp_json_encode($payload, JSON_PRETTY_PRINT);

    /* Should be in .env */
    $webhook_url = 'https://script.google.com/macros/s/AKfycbzVKxPeK-ws3Qgcm9Fs7fEDAJvVM0KUrYQiaRKGDv2JlZdhgVfAkbjLCmFbIO-Thb-w/exec';

    $response = wp_remote_post(
      $webhook_url,
      [
        'headers' => [
          'Content-Type' => 'application/json',
        ],
        'body' => wp_json_encode($payload),
        'timeout' => 15,
        'redirection' => 0,
      ]
    );

    if (is_wp_error($response)) {
      $debug_output = 'Error: ' . $response->get_error_message();
    } else {
      $response_code = wp_remote_retrieve_response_code($response);
      $response_body = wp_remote_retrieve_body($response);

      $debug_output = "POST sent successfully\n";
      $debug_output .= "Response code: " . $response_code . "\n";
      $debug_output .= "Payload:\n" . wp_json_encode($payload, JSON_PRETTY_PRINT) . "\n\n";
      $debug_output .= "Response body:\n" . $response_body;
    }
  }


  ob_start();
?>
  <div class="pb-form-wrapper">
    <div class="pb-form-heading">
      <h2>Request a quote</h2>
    </div>
    <form method="post" class="pbform">
      <div class="pb-contact-field">
        <label for="pb_name">Name</label>
        <input type="text" class="pb-form-input" id="pb_name" name="pb_name" placeholder="Type Here" required value="<?php echo esc_attr($form_values['name']); ?>">
      </div>

      <div class="pb-contact-field">
        <label for="pb_email">Email</label>
        <input type="email" class="pb-form-input" id="pb_email" name="pb_email" placeholder="Type Here" required value="<?php echo esc_attr($form_values['email']); ?>">
      </div>

      <div class="pb-contact-field">
        <label for="pb_message">Message</label>
        <textarea id="pb_message" name="pb_message" class="pb-form-textarea" placeholder="Type Here" required><?php echo esc_textarea($form_values['message']); ?></textarea>
      </div>

      <div class="pb-contact-submit">
        <input type="hidden" name="pbform_submitted" value="1">
        <button type="submit">Submit</button>
      </div>
    </form>
  </div>
  <?php
  if ($json_output2): ?>
    <h3>JSON OUTPUT TEST</h3>
    <pre><?php echo esc_html($json_output2); ?></pre>
  <?php endif; ?>
  <?php if ($debug_output): ?>
    <h3>JSON RESPONSE TEST</h3>
    <h3>Debug output</h3>
    <pre><?php echo esc_html($debug_output); ?></pre>
  <?php endif; ?>

<?php
  return ob_get_clean();
}
