function togglePostTypesBox() {
  if (document.querySelector('.rm199_input_more_post_types').style.display !== 'none') {
    document.querySelector('.rm199_input_more_post_types').style.display = 'none';
    document.getElementById('rm199_post_type').disabled = false;
    document.getElementById('rm199_so_post_types').value = document.getElementById('rm199_post_type').value
  } else {
    document.querySelector('.rm199_input_more_post_types').style.display = 'flex';
    document.getElementById('rm199_post_type').disabled = true;
    document.getElementById('rm199_so_post_types').value = document.getElementById('rm199__more_post_types_input').value
  }
}


function toggleCategoryBox() {
  if (document.querySelector('.rm199_input_more_categories').style.display !== 'none') {
    document.querySelector('.rm199_input_more_categories').style.display = 'none';
    document.getElementById('rm199_categories').disabled = false;
    document.getElementById('rm199_so_categories').value = document.getElementById('rm199_categories').value

  } else {
    document.querySelector('.rm199_input_more_categories').style.display = 'flex';
    document.getElementById('rm199_categories').disabled = true;
    document.getElementById('rm199_so_categories').value = document.getElementById('rm199__more_categories_input').value
  }
}


function toggleTagsBox() {
  if (document.querySelector('.rm199_input_more_tags').style.display !== 'none') {
    document.querySelector('.rm199_input_more_tags').style.display = 'none';
    document.getElementById('rm199_tags').disabled = false;
    document.getElementById('rm199_so_tags').value = document.getElementById('rm199_tags').value
  } else {
    document.querySelector('.rm199_input_more_tags').style.display = 'flex';
    document.getElementById('rm199_tags').disabled = true;
    document.getElementById('rm199_so_tags').value = document.getElementById('rm199__more_tags_input').value
  }
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


// add options 
function rm199_title(value) {
  document.getElementById('rm199_so_title').value = value;
  document.getElementById('rm199__overview__title').textContent = value
}

function rm199_description(value) {
  document.getElementById('rm199_so_description').value = value;
}

function rm199_filter_by_keyword() {
  var canUserSelectKeywords = document.getElementById('filter_by_keyword').checked;
  document.getElementById('rm199_so_can_user_select_keywords').value = canUserSelectKeywords ? 'true' : 'false';
}

function rm199_show_only_for_loggedin_users() {
  var show_only_for_loggedin_users = document.getElementById('show_only_for_loggedin_users').checked;
  document.getElementById('show_only_for_loggedin_users').value = show_only_for_loggedin_users ? 'true' : 'false';
}

function rm199_number_of_posts(value) {
  document.getElementById('rm199_so_number_of_items').value = value ? value : '3';
  document.getElementById('rm199__overview__number').textContent = value ? value : '3';
}

// function rm199_number_of_posts(value) {
//   document.getElementById('rm199_so_can_user_select_keywords').value = value ? value : '3';
// }

function rm199_post_type(value) {
  var postTypesBox = document.querySelector('.rm199_input_more_post_types').style.display;
  if (postTypesBox !== "none") {
    document.getElementById('rm199_so_post_types').value = document.getElementById('rm199__more_post_types_input').value
    return;
  }
  document.getElementById('rm199_so_post_types').value = value
}


function rm199_categories(value) {
  var postTypesBox = document.querySelector('.rm199_input_more_categories').style.display;
  if (postTypesBox !== "none") {
    document.getElementById('rm199_so_categories').value = document.getElementById('rm199__more_categories_input').value
    return;
  }
  document.getElementById('rm199_so_categories').value = value
}

function rm199_tags(value) {
  var postTypesBox = document.querySelector('.rm199_input_more_tags').style.display;
  if (postTypesBox !== "none") {
    document.getElementById('rm199_so_tags').value = document.getElementById('rm199__more_tags_input').value
    return;
  }
  document.getElementById('rm199_so_tags').value = value
}

function template(value) {
  document.getElementById('rm199_so_template').value = value
  if (value === 'minimal') {
    document.getElementById("rm199__minimal__template").style.display = "block"
    document.getElementById("rm199__structured__template").style.display = "none"
  } else {
    document.getElementById("rm199__structured__template").style.display = "block"
    document.getElementById("rm199__minimal__template").style.display = "none"
  }
}

function choose_main_color(value) {
  document.getElementById('rm199_so_main_color').value = value
}

function choose_secondary_color(value) {
  document.getElementById('rm199_so_secondary_color').value = value
}

function choose_text_color(value) {
  document.getElementById('rm199_so_text_color').value = value
}

function table_mOvr(src, clrOver) {
  if (!src.contains(event.fromElement)) {
    src.style.backgroundColor = clrOver;
  }
}

function table_mOut(src, clrIn) {
  if (!src.contains(event.toElement)) {
    src.style.backgroundColor = clrIn;
  }
}


function unlockThis(e) {
  var tableOverlays = document.querySelectorAll('.table__overlay');
  [].forEach.call(tableOverlays, function (tableOverlay) {
    tableOverlay.style.display = 'flex';
  })
  e.target.style.display = 'none';
  console.log("this" + e.target)
}

// todo : don't allow user to enter directly on generate button if not submitted all info needed in form 

// function get_all_options(){
//   rm199_title('We Recommend You Those Posts')
// }