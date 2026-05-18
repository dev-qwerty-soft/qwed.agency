<?php

class ContactForm {
  private $table_name;
  private $form_id;
  private $form_name;
  private $fields;
  private $settings;
  private static $forms = [];
  private static $main_menu_initialized = false;

  public function __construct($form_name, $fields = [], $settings = []) {
    global $wpdb;
    $this->form_name = sanitize_text_field($form_name);
    $this->form_id = md5($this->form_name);
    $this->table_name = $wpdb->prefix . 'contact_form_submissions';
    $this->fields = $fields;
    $this->settings = wp_parse_args($settings, [
      'title' => $this->form_name,
      'button_text' => 'Submit',
      'success_message' => 'Message sent successfully!',
      'error_message' => 'Form submission error.',
    ]);
    self::$forms[$this->form_id] = $this;
    add_action('init', [$this, 'init']);
    add_action('wp_ajax_submit_contact_form_' . $this->form_id, [$this, 'handle_form_submission']);
    add_action('wp_ajax_nopriv_submit_contact_form_' . $this->form_id, [$this, 'handle_form_submission']);
    add_action('wp_ajax_delete_submission', [$this, 'delete_submission']);
    add_action('wp_ajax_delete_multiple_submissions', [$this, 'delete_multiple_submissions']);
    add_action('wp_ajax_get_submission_details', [$this, 'get_submission_details']);
    add_shortcode('contact_form_' . $this->form_id, [$this, 'render_form']);
    if (!self::$main_menu_initialized) {
      add_action('admin_menu', [__CLASS__, 'add_main_menu']);
      add_action('wp_head', [__CLASS__, 'enqueue_wp_head']);
      add_action('admin_head', [__CLASS__, 'enqueue_wp_head']);
      self::$main_menu_initialized = true;
    }
  }

  public function init() {
    $this->create_table();
  }

  private function create_table() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS {$this->table_name} (
      id mediumint(9) NOT NULL AUTO_INCREMENT,
      form_id varchar(100) NOT NULL,
      form_data longtext NOT NULL,
      ip_address varchar(45),
      user_agent text,
      created_at datetime DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (id),
      KEY form_id (form_id)
    ) $charset_collate;";
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
  }

  public static function add_main_menu() {
    add_menu_page('Contact Forms', 'Contact Forms', 'manage_options', 'contact-forms-main', [__CLASS__, 'render_main_page'], 'dashicons-email', 30);
    foreach (self::$forms as $form_id => $form) {
      add_submenu_page('contact-forms-main', $form->form_name, $form->form_name . ' (' . count($form->get_submissions($form->form_id)) . ')', 'manage_options', 'contact-form-' . $form_id, [
        $form,
        'render_admin_page',
      ]);
    }
  }

  public static function enqueue_wp_head() {
    $nonces = [];
    foreach (self::$forms as $form_id => $form) {
      $nonces[$form_id] = wp_create_nonce('contact_form_nonce_' . $form_id);
    }
    echo '<script>window.contactForm = ' .
      json_encode([
        'ajax_url' => admin_url('admin-ajax.php'),
        'admin_nonce' => wp_create_nonce('contact_form_admin_nonce'),
        'nonces' => $nonces,
      ]) .
      '</script>';
  }

  public static function render_main_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form_submissions';
    $html = '<div class="wrap contact-forms-main-page">';
    $html .= '<h1>Contact Forms</h1>';
    $html .= '<p>Select form from left menu to view submissions</p>';
    $html .= '<div class="forms-overview">';
    $html .= '<h2>Available forms:</h2>';
    $html .= '<table class="wp-list-table widefat striped">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th>Form Name</th>';
    $html .= '<th>Shortcode</th>';
    $html .= '<th>Submissions Count</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    foreach (self::$forms as $form_id => $form) {
      $count = count($form->get_submissions($form_id));
      $shortcode = '[contact_form_' . $form_id . ']';
      $html .= '<tr>';
      $html .= '<td><strong><a href="' . admin_url('admin.php?page=contact-form-' . $form_id) . '">' . esc_html($form->form_name) . '</a></strong></td>';
      $html .= '<td>';
      $html .= '<div class="shortcode-wrapper">';
      $html .= '<code class="shortcode-text">' . esc_html($shortcode) . '</code>';
      $html .= '<button class="button button-small copy-shortcode-btn" data-shortcode="' . esc_attr($shortcode) . '" title="Copy shortcode">';
      $html .= '<span class="dashicons dashicons-admin-page"></span>';
      $html .= '</button>';
      $html .= '</div>';
      $html .= '</td>';
      $html .= '<td>' . intval($count) . '</td>';
      $html .= '</tr>';
    }
    $html .= '</tbody>';
    $html .= '</table>';
    $html .= '</div>';
    $html .= '</div>';
    echo $html;
  }

  public function get_submissions($form_id) {
    global $wpdb;
    return $wpdb->get_results($wpdb->prepare("SELECT * FROM {$this->table_name} WHERE form_id = %s ORDER BY created_at DESC", $form_id));
  }

  public function render_form($atts) {
    $atts = shortcode_atts(
      [
        'title' => $this->settings['title'],
        'button_text' => $this->settings['button_text'],
      ],
      $atts
    );
    $html = '';
    $html .=
      '<form class="contact-form" data-title="' .
      esc_attr($atts['title']) .
      '" id="form-' .
      esc_attr($this->form_id) .
      '" action="' .
      home_url() .
      '" method="post" data-form-id="' .
      esc_attr($this->form_id) .
      '">';
    foreach ($this->fields as $field) {
      $html .= $this->render_field($field);
    }
    $html .= '<div class="form-group form-group-submit">';
    $html .= '<button type="submit" class="submit-btn">' . esc_html($atts['button_text']) . '</button>';
    $html .= '</div>';
    $html .= '<div class="form-message"></div>';
    $html .= '</form>';
    return $html;
  }

  private function render_field($field) {
    $defaults = [
      'name' => '',
      'type' => 'text',
      'label' => '',
      'placeholder' => '',
      'class' => '',
      'required' => false,
      'options' => [],
      'autocomplete' => '',
    ];
    $field = wp_parse_args($field, $defaults);

    $autocomplete_map = [
      'name' => 'name',
      'first_name' => 'given-name',
      'last_name' => 'family-name',
      'email' => 'email',
      'phone' => 'tel',
      'address' => 'street-address',
      'city' => 'address-level2',
      'state' => 'address-level1',
      'zip' => 'postal-code',
      'country' => 'country-name',
      'organization' => 'organization',
      'company' => 'organization',
    ];

    $autocomplete_attr = '';
    if (!empty($field['autocomplete'])) {
      $autocomplete_attr = 'autocomplete="' . esc_attr($field['autocomplete']) . '"';
    } elseif (isset($autocomplete_map[$field['name']])) {
      $autocomplete_attr = 'autocomplete="' . esc_attr($autocomplete_map[$field['name']]) . '"';
    }

    $required_attr = $field['required'] ? 'required' : '';
    $required_label = $field['required'] ? ' *' : '';
    $form_slug = sanitize_title($this->form_name);
    $field_id = $form_slug . '-' . esc_attr($field['name']);

    $wrapper_class = 'form-group';
    if (!empty($field['class'])) {
      $wrapper_class .= ' ' . esc_attr($field['class']);
    }

    $html = '<div class="' . $wrapper_class . '">';
    if (!empty($field['label'])) {
      $html .= '<label for="' . $field_id . '">' . esc_html($field['label']) . $required_label . '</label>';
    }
    switch ($field['type']) {
      case 'textarea':
        $html .=
          '<textarea id="' .
          $field_id .
          '" name="' .
          esc_attr($field['name']) .
          '" placeholder="' .
          esc_attr($field['placeholder']) .
          '" ' .
          $autocomplete_attr .
          ' ' .
          $required_attr .
          '></textarea>';
        break;
      case 'select':
        $html .= '<select id="' . $field_id . '" name="' . esc_attr($field['name']) . '" ' . $autocomplete_attr . ' ' . $required_attr . '>';
        $html .= '<option value="">' . esc_html($field['placeholder']) . '</option>';
        foreach ($field['options'] as $value => $label) {
          $html .= '<option value="' . esc_attr($value) . '">' . esc_html($label) . '</option>';
        }
        $html .= '</select>';
        break;
      case 'radio':
        foreach ($field['options'] as $value => $label) {
          $radio_id = $field_id . '-' . sanitize_title($value);
          $html .= '<label class="radio-label" for="' . $radio_id . '">';
          $html .= '<input type="radio" id="' . $radio_id . '" name="' . esc_attr($field['name']) . '" value="' . esc_attr($value) . '" ' . $required_attr . '>';
          $html .= esc_html($label);
          $html .= '</label>';
        }
        break;
      case 'checkbox':
        foreach ($field['options'] as $value => $label) {
          $checkbox_id = $field_id . '-' . sanitize_title($value);
          $html .= '<label class="checkbox-label" for="' . $checkbox_id . '">';
          $html .= '<input type="checkbox" id="' . $checkbox_id . '" name="' . esc_attr($field['name']) . '[]" value="' . esc_attr($value) . '">';
          $html .= esc_html($label);
          $html .= '</label>';
        }
        break;
      default:
        $html .=
          '<input type="' .
          esc_attr($field['type']) .
          '" id="' .
          $field_id .
          '" name="' .
          esc_attr($field['name']) .
          '" placeholder="' .
          esc_attr($field['placeholder']) .
          '" ' .
          $autocomplete_attr .
          ' ' .
          $required_attr .
          '>';
        break;
    }
    $html .= '</div>';
    return $html;
  }

  public function handle_form_submission() {
    check_ajax_referer('contact_form_nonce_' . $this->form_id, 'nonce');
    global $wpdb;
    $form_data = [];
    foreach ($this->fields as $field) {
      $field_name = $field['name'];
      if (isset($_POST[$field_name])) {
        if (is_array($_POST[$field_name])) {
          $form_data[$field_name] = array_map('sanitize_text_field', $_POST[$field_name]);
        } else {
          $form_data[$field_name] = sanitize_text_field($_POST[$field_name]);
        }
        if (!empty($field['required']) && empty($form_data[$field_name])) {
          wp_send_json_error([
            'message' => 'Fill all required fields',
          ]);
        }
        if ($field['type'] === 'email' && !empty($form_data[$field_name])) {
          if (!is_email($form_data[$field_name])) {
            wp_send_json_error([
              'message' => 'Invalid email',
            ]);
          }
        }
      }
    }
    $result = $wpdb->insert(
      $this->table_name,
      [
        'form_id' => $this->form_id,
        'form_data' => json_encode($form_data, JSON_UNESCAPED_UNICODE),
        'ip_address' => $_SERVER['REMOTE_ADDR'],
        'user_agent' => $_SERVER['HTTP_USER_AGENT'],
      ],
      ['%s', '%s', '%s', '%s']
    );
    if ($result) {
      do_action('contact_form_submitted_' . $this->form_id, $wpdb->insert_id, $form_data);
      wp_send_json_success([
        'message' => $this->settings['success_message'],
      ]);
    } else {
      wp_send_json_error([
        'message' => $this->settings['error_message'],
      ]);
    }
  }

  public function delete_submission() {
    check_ajax_referer('contact_form_admin_nonce', 'nonce');
    global $wpdb;
    $submission_id = intval($_POST['submission_id']);
    $result = $wpdb->delete($this->table_name, ['id' => $submission_id], ['%d']);
    if ($result) {
      wp_send_json_success(['message' => 'Submission deleted']);
    } else {
      wp_send_json_error(['message' => 'Failed to delete submission']);
    }
  }

  public function delete_multiple_submissions() {
    check_ajax_referer('contact_form_admin_nonce', 'nonce');
    global $wpdb;
    $decoded = json_decode(wp_unslash($_POST['submission_ids'] ?? ''), true);
    $submission_ids = array_map('intval', is_array($decoded) ? $decoded : []);
    if (empty($submission_ids)) {
      wp_send_json_error(['message' => 'No submissions selected']);
    }
    $placeholders = implode(',', array_fill(0, count($submission_ids), '%d'));
    $result = $wpdb->query($wpdb->prepare("DELETE FROM {$this->table_name} WHERE id IN ($placeholders)", ...$submission_ids));
    if ($result) {
      wp_send_json_success(['message' => 'Submissions deleted']);
    } else {
      wp_send_json_error(['message' => 'Failed to delete submissions']);
    }
  }

  public function get_submission_details() {
    check_ajax_referer('contact_form_admin_nonce', 'nonce');
    global $wpdb;
    $submission_id = intval($_POST['submission_id']);
    $submission = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$this->table_name} WHERE id = %d", $submission_id));
    if ($submission) {
      wp_send_json_success(['submission' => $submission]);
    } else {
      wp_send_json_error(['message' => 'Submission not found']);
    }
  }

  public function render_admin_page() {
    global $wpdb;
    $submissions = $wpdb->get_results($wpdb->prepare("SELECT * FROM {$this->table_name} WHERE form_id = %s ORDER BY created_at DESC", $this->form_id));
    $shortcode = '[contact_form_' . $this->form_id . ']';

    $html = '<div class="wrap contact-forms-main-page">';
    $html .= '<h1>' . esc_html($this->form_name) . ' - Submissions (' . count($submissions) . ')</h1>';

    $html .= '<div class="shortcode-section">';
    $html .= '<h3>Shortcode:</h3>';
    $html .= '<div class="shortcode-wrapper">';
    $html .= '<code class="shortcode-text">' . esc_html($shortcode) . '</code>';
    $html .= '<button class="button button-small copy-shortcode-btn" data-shortcode="' . esc_attr($shortcode) . '" title="Copy shortcode">';
    $html .= '<span class="dashicons dashicons-admin-page"></span>';
    $html .= '</button>';
    $html .= '</div>';
    $html .= '</div>';

    $html .= '<div class="bulk-actions">';
    $html .= '<label for="select-all-submissions">';
    $html .= '<input type="checkbox" id="select-all-submissions">';
    $html .= '<span>Select All</span>';
    $html .= '</label>';
    $html .= '<button class="button" id="deselect-all-submissions">Deselect All</button> ';
    $html .= '<button class="button button-primary" id="delete-selected-submissions">Delete Selected</button>';
    $html .= '</div>';
    $html .= '<table class="wp-list-table widefat striped">';
    $html .= '<thead>';
    $html .= '<tr>';
    $html .= '<th></th>';
    $html .= '<th>ID</th>';
    $max_fields = min(count($this->fields), 3);
    foreach (array_slice($this->fields, 0, $max_fields) as $field) {
      $html .= '<th>' . esc_html($field['label']) . '</th>';
    }
    $html .= '<th>Date</th>';
    $html .= '<th>Actions</th>';
    $html .= '</tr>';
    $html .= '</thead>';
    $html .= '<tbody>';
    if ($submissions) {
      foreach ($submissions as $submission) {
        $data = json_decode($submission->form_data, true);
        $html .= '<tr data-id="' . $submission->id . '">';
        $html .= '<td><input id="submission-checkbox-' . $submission->id . '" type="checkbox" class="submission-checkbox" value="' . $submission->id . '"></td>';
        $html .= '<td>Submission ' . $submission->id . '</td>';
        foreach (array_slice($this->fields, 0, $max_fields) as $field) {
          $value = isset($data[$field['name']]) ? $data[$field['name']] : '';
          if (is_array($value)) {
            $display_value = esc_html(implode(', ', $value));
          } else {
            $display_value = esc_html($value);
          }
          if (strlen($display_value) > 50) {
            $display_value = substr($display_value, 0, 50) . '...';
          }
          $html .= '<td>' . $display_value . '</td>';
        }
        $html .= '<td>' . date('d.m.Y H:i', strtotime($submission->created_at)) . '</td>';
        $html .= '<td>';
        $html .= '<button class="button button-primary view-submission" data-id="' . $submission->id . '" data-form-id="' . esc_attr($this->form_id) . '">View</button>';
        $html .= '</td>';
        $html .= '</tr>';
      }
    } else {
      $html .= '<tr>';
      $html .= '<td colspan="' . ($max_fields + 4) . '">No submissions yet</td>';
      $html .= '</tr>';
    }
    $html .= '</tbody>';
    $html .= '</table>';
    $html .= '</div>';
    $html .= '<div id="submission-modal-' . esc_attr($this->form_id) . '" class="submission-modal">';
    $html .= '<div class="modal-content">';
    $html .= '<div class="modal-header">';
    $html .= '<h2>Submission Details</h2>';
    $html .= '<span class="close-modal">&times;</span>';
    $html .= '</div>';
    $html .= '<div class="modal-body"></div>';
    $html .= '<div class="modal-footer">';
    $html .= '<button class="button button-primary delete-submission-modal">Delete Submission</button>';
    $html .= '<button class="button close-modal-btn">Close</button>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    echo $html;
  }
}

$fields = [
  [
    'name' => 'name',
    'type' => 'text',
    'label' => 'Name',
    'placeholder' => 'Enter your name',
    'class' => 'input-field',
    'required' => true,
    'autocomplete' => 'name',
  ],
];

$form = new ContactForm('Contact Form Main', $fields, [
  'button_text' => 'Send',
]);
