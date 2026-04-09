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


/**
 * Create JSON array, handle POST
 * Test the output before linking to google sheet - NOT DONE
 * 
 * Steps: 
 * 1: Declare function
 * 2: Assign vars and array
 * 3: Sanitize and insert the form field values into the $form_values area
 * 4: Create a fresh array with sanitized values and convert into json 
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

    $webhook_url = 'https://webhook.site/20f453d4-e5e9-452a-acba-04dee358a5b8';

    $response = wp_remote_post(
      $webhook_url,
      [
        'headers' => [
          'Content-Type' => 'application/json',
        ],
        'body' => wp_json_encode($payload),
        'timeout' => 15,
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

  <form method="post" class="pbform">
    <p>
      <label>Name</label><br>
      <input type="text" name="pb_name" required value="<?php echo esc_attr($values['name']); ?>">
    </p>

    <p>
      <label>Email</label><br>
      <input type="email" name="pb_email" required value="<?php echo esc_attr($values['email']); ?>">
    </p>

    <p>
      <label>Message</label><br>
      <textarea name="pb_message" required><?php echo esc_textarea($values['message']); ?></textarea>
    </p>

    <input type="hidden" name="pbform_submitted" value="1">

    <button type="submit">Send</button>
  </form>

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
