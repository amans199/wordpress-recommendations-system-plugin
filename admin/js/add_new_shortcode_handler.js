// Form submission listener
function add_new_shortcode_handler(e) {
  e.preventDefault();
  var post_types_content = '',
    categories_content = '',
    tags_content = ''
  if (document.querySelector('.rm199_input_more_post_types').style.display !== "none") {
    post_types_content = document.getElementById('rm199__more_post_types_input').value
  } else {
    post_types_content = document.getElementById('rm199_post_type').value
  }
  if (document.querySelector('.rm199_input_more_categories').style.display !== "none") {
    categories_content = document.getElementById('rm199__more_categories_input').value
  } else {
    categories_content = document.getElementById('rm199_categories').value
  }

  if (document.querySelector('.rm199_input_more_tags').style.display !== "none") {
    tags_content = document.getElementById('rm199__more_tags_input').value
  } else {
    tags_content = document.getElementById('rm199_tags').value
  }

  var url = new URL(window.location.href);
  var edit_mode_id = url.searchParams.get("edit_shortcode")


  var created_in = document.getElementById('shortcode_created_in').value

  var title = document.getElementById('rm199__title_input').value,
    description = document.getElementById('rm199__description_input').value,
    can_user_select_keywords = document.getElementById('filter_by_keyword').checked,
    show_only_for_loggedin_users = document.getElementById('show_only_for_loggedin_users').checked,
    number_of_items = document.getElementById("number_of_posts_2_show").value,
    post_types = post_types_content,
    categories = categories_content,
    tags = tags_content,
    template = document.getElementById('rm199_so_template').value,
    main_color = document.getElementById('choose_main_color').value,
    secondary_color = document.getElementById('choose_secondary_color').value,
    text_color = document.getElementById('choose_text_color').value,
    rm199_custom_css = document.getElementById('code_custom_css').value,
    uniq_code = document.getElementById('rm199_if_edit_mode').value != '' ? document.getElementById('rm199_if_edit_mode').value : rm199Obj.rm199_code,
    shortcode_content;

  shortcode_content = {
    title: title !== '' ? title : "Recommended for you:",
    description: description,
    can_user_select_keywords: can_user_select_keywords !== '' ? can_user_select_keywords : false,
    show_only_for_loggedin_users: show_only_for_loggedin_users !== '' ? show_only_for_loggedin_users : false,
    number_of_items: number_of_items !== '' ? number_of_items : 3,
    post_types: post_types !== '' ? post_types : "all",
    categories: categories !== '' ? categories : "all",
    tags: tags !== '' ? tags : "all",
    main_color: main_color !== '' ? main_color : null,
    secondary_color: secondary_color !== '' ? secondary_color : null,
    text_color: text_color !== '' ? text_color : null,
    template: template !== '' ? template : "minimal",
    code: uniq_code
  }

  if (shortcode_content) {
    jQuery.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', rm199Obj.security)
      },
      url: rm199Obj.ajax_url,
      type: 'POST',
      data: {
        action: 'add_new_shortcode_cb',
        'shortcode_content': shortcode_content,
        'shortcode_uniqid': uniq_code,
        'rm199_custom_css': rm199_custom_css,
        'edit_mode_id': edit_mode_id ? edit_mode_id : '',
        'created_in': created_in
      }
    })
      .success(function (results) {
        // console.log('User Meta Updated!');
        // console.log(results)
        // document.querySelector(`.all_keywords_shown .rm199__keyword-${um_val.replace(/\s/g, '')}`).remove()
        // location.reload()
        window.location = '/wp-admin/admin.php?page=rm199_manager&highlight_shortcode=' + uniq_code;
      })
      .fail(function (data) {
        console.log(data.responseText);
        console.log('Request failed: ' + data.statusText);
      });

  } else {
    // Show user error message.
  }
  return false;   // Stop our form from submitting
};