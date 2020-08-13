
// function toggleThisCheckbox(id) {
//   var checkboxEl = document.getElementById(id);
//   console.log("checkboxEl.checked : " + checkboxEl.checked)
//   console.log("checkboxEl.value : " + checkboxEl.value)
//   if (checkboxEl.checked == true) {
//     checkboxEl.value = false;
//   } else {
//     checkboxEl.value = true;
//   }
// }
// jQuery(document).ready(function ($) {
//   console.log("heellppps")
// })

function togglePostTypesBox() {
  if (document.querySelector('.rm199_input_more_post_types').style.display !== 'none') {
    document.querySelector('.rm199_input_more_post_types').style.display = 'none';
    document.getElementById('rm199_post_type').disabled = false;
  } else {
    document.querySelector('.rm199_input_more_post_types').style.display = 'flex';
    document.getElementById('rm199_post_type').disabled = true;
  }
}


function toggleCategoryBox() {
  if (document.querySelector('.rm199_input_more_categories').style.display !== 'none') {
    document.querySelector('.rm199_input_more_categories').style.display = 'none';
    document.getElementById('rm199_categories').disabled = false;
  } else {
    document.querySelector('.rm199_input_more_categories').style.display = 'flex';
    document.getElementById('rm199_categories').disabled = true;
  }
}


function toggleTagsBox() {
  if (document.querySelector('.rm199_input_more_tags').style.display !== 'none') {
    document.querySelector('.rm199_input_more_tags').style.display = 'none';
    document.getElementById('rm199_tags').disabled = false;
  } else {
    document.querySelector('.rm199_input_more_tags').style.display = 'flex';
    document.getElementById('rm199_tags').disabled = true;
  }
}

function closeSshortcodeBox() {
  document.querySelector('.shortcodes_box--container').style.display = 'none';
}

function copy_shortcode_for_recommendations() {
  var copyText = document.getElementById("shortcode_for_recommendations");
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/
  document.execCommand("copy");
}

function copy_shortcode_for_user_preferences() {
  var copyText = document.getElementById("shortcode_for_user_preferences");
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/
  document.execCommand("copy");
}

function generate_shortcode() {
  document.querySelector('.shortcodes_box--container').style.display = 'flex';

  var title = document.getElementById('rm199__title_input').value,
    canUserSelectKeywords = document.getElementById('filter_by_keyword').checked,
    showOnlyForLoggedInUsers = document.getElementById('show_only_for_loggedin_users').checked,
    numberOfItems = document.getElementById('number_of_posts_2_show').value,
    postTypes = document.getElementById('rm199_post_type').value,
    categories = document.getElementById('rm199_categories').value,
    tags = document.getElementById('rm199_tags').value,
    templates = document.getElementsByName('template'),
    mainColor = document.getElementById('choose_main_color').value,
    secondaryColor = document.getElementById('choose_secondary_color').value,
    textColor = document.getElementById('choose_text_color').value,
    chosenTemplate = ""

  // if more than one post types 
  var postTypesBox = document.querySelector('.rm199_input_more_post_types').style.display;
  if (postTypesBox !== "none") {
    postTypes = document.getElementById('rm199__more_post_types_input').value
  }

  // if more than one category 
  var categoriesBox = document.querySelector('.rm199_input_more_categories').style.display;
  if (categoriesBox !== "none") {
    categories = document.getElementById('rm199__more_categories_input').value;
  }

  // if more than tag 
  var tagsBox = document.querySelector('.rm199_input_more_tags').style.display;
  if (tagsBox !== "none") {
    tags = document.getElementById('rm199__more_tags_input').value;
  }

  // get the chosen template 
  for (temp = 0; temp < templates.length; temp++) {
    if (templates[temp].checked) {
      chosenTemplate = templates[temp].value;
    }
  }


  document.getElementById("shortcode_for_recommendations").value =
    `[rm199_posts title="${title ? title : 'Recommended for you:'}" 
    ${canUserSelectKeywords ? 'keywords_selection="true"' : 'latest_posts="true"'}
    ${showOnlyForLoggedInUsers ? 'show_for_loggedin_only="true"' : 'show_for_all_users="true"'}
    number_of_posts="${numberOfItems ? numberOfItems : 3}" 
    main_color="${mainColor}" 
    secondary_color="${secondaryColor}" 
    text_color="${textColor}" 
    postTypes="${postTypes ? postTypes : 'post'}" 
    template="${chosenTemplate}" 
    categories="${categories}" tags="${tags}" ]`
  // todo : make the input shortcode only appear if the admin allows it users to choose keywords 
  // if (canUserSelectKeywords) {
  document.getElementById("shortcode_for_user_preferences").value = "[rm199_input]"
  // }
}



