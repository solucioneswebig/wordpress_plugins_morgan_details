<?php

 /**
  * Create or edit a service
  *
  * @param null|int $project_id
  * @return int
  */
  function create($project_id = 0, $posted = array())
  {
      $is_update = $project_id ? true : false;
      $data = array('post_author' => $posted['post_author'],'post_title' => $posted['service_name'], 'post_content' => $posted['service_description'], 'post_type' => 'post', 'post_status' => 'publish');
      if ($is_update) {
          $data['ID'] = $project_id;
          $project_id = wp_update_post($data, true);
      } else {
          $project_id = wp_insert_post($data, true);
      }
      /*if ($project_id) {
          $this->insert_project_user_role($posted, $project_id);
          wp_set_post_terms($project_id, $posted['project_cat'], 'project_category', false);
          if ($is_update) {
              do_action('cpm_project_update', $project_id, $data);
          } else {
              update_post_meta($project_id, '_project_archive', 'no');
              update_post_meta($project_id, '_project_active', 'yes');
              $settings = $this->settings_user_permission();
              update_post_meta($project_id, '_settings', $settings);
              do_action('cpm_project_new', $project_id, $data);
          }
      }*/
       // Redireccionamos para prevenir que no haya duplicados
    wp_redirect(esc_url_raw(add_query_arg('post_submitted', $project_id)));
    exit;
  }