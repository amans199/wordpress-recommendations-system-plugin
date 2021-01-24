var url = new URL(window.location.href);
var highlight_shortcode = url.searchParams.get("highlight_shortcode")

if (highlight_shortcode) {
  setTimeout(() => {
    var all_tr = document.querySelectorAll("tr");
    all_tr.forEach(element => {
      if (element.dataset.code == highlight_shortcode) {
        element.style.background = '#ddd'
      }
    });
  })
}


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

function copy_shortcode_for_shortcode(e, shortcode) {
  var fullShortcode = '[rm199_posts id=' + shortcode + ']'
  var copyText = document.querySelector('[value="' + fullShortcode + '"]');
  copyText.select();
  copyText.setSelectionRange(0, 99999); /*For mobile devices*/
  document.execCommand("copy");

  jQuery('.shortcodes_copier .dashicons').addClass('dashicons-admin-page')
  jQuery('.shortcodes_copier .dashicons').removeClass('dashicons-yes')
  jQuery('[data-code-for-style="' + shortcode + '"]').removeClass('dashicons-admin-page')
  jQuery('[data-code-for-style="' + shortcode + '"]').addClass('dashicons-yes')
  setTimeout(() => {
    jQuery('.shortcodes_copier .dashicons').addClass('dashicons-admin-page')
    jQuery('.shortcodes_copier .dashicons').removeClass('dashicons-yes')
  }, 1000)
}


// add options 
function rm199_title(value) {
  document.getElementById('rm199__overview__title').textContent = value
}

function rm199_number_of_posts(value) {
  document.getElementById('rm199__overview__number').textContent = value ? value : '3';
}



function template(value) {
  document.getElementById('rm199_so_template').value = value
  if (value === 'minimal') {
    document.getElementById("rm199__minimal__template").style.display = "block"
    document.getElementById("rm199__transitioned__template").style.display = "none"
    document.getElementById("rm199__structured__template").style.display = "none"
  } else if(value === 'transitioned'){
    document.getElementById("rm199__minimal__template").style.display = "none"
    document.getElementById("rm199__transitioned__template").style.display = "block"
    document.getElementById("rm199__structured__template").style.display = "none"
  }else{
    document.getElementById("rm199__minimal__template").style.display = "none"
    document.getElementById("rm199__transitioned__template").style.display = "none"
    document.getElementById("rm199__structured__template").style.display = "block"
  }
}


function table_mOvr(src, clrOver) {
  if (!highlight_shortcode) {
    if (!src.contains(event.fromElement)) {
      src.style.backgroundColor = clrOver;
    }
  }
}

function table_mOut(src, clrIn) {
  if (!highlight_shortcode) {
    if (!src.contains(event.toElement)) {
      src.style.backgroundColor = clrIn;
    }
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

function add_to_types_list(e,id){
var thisType=e.target,
  thisTypeText=thisType.outerText,
  input= document.getElementById(id)
  postType= ','+thisTypeText

  if(input.value === ''){
    postType= thisTypeText
  }

  if(input.value.includes(thisTypeText)){
    return;
  }

  input.value +=postType

}




window.onload = function() {
    if (document.body.contains(document.querySelector('#toggle_preferences_input'))) {
      var toggle_preferences_input = document.querySelector('#toggle_preferences_input').checked;
      if(toggle_preferences_input) {
        document.querySelector('.add_blur_if_disabled').style.display = "none";
    } else {
        document.querySelector('.add_blur_if_disabled').style.display = "block";
    }
      document.querySelector('#toggle_preferences_input').addEventListener( 'change', function() {
        if(this.checked) {
            document.querySelector('.add_blur_if_disabled').style.display = "none";
        } else {
            document.querySelector('.add_blur_if_disabled').style.display = "block";
        }
    });
  }
}


// topbar Settings

function rm199_topbar_title(e){
  var thisInput = e.target,
  title=thisInput.value,
  txtShown = document.querySelector(".rm199_preferences_example__txt")
  txtShown.textContent = title
}

function rm199_topbar_link(e){
  var thisInput = e.target,
  title=thisInput.value,
  txtShown = document.querySelector(".rm199_preferences_example__link_txt button")
  txtShown.textContent = title
}

// function add_to_preferences_include_handler(e){
  // console.log(e.target.value)
  // document.querySelector("#preferences_may_include_obj").value += 'e.target.value'
// }

// bg_colorVal=document.querySelector("#choose_main_color_topbar").value,
// text_colorVal=document.querySelector("#choose_text_color_topbar").value,
// text_link_colorVal=document.querySelector("#choose_button_link_color_topbar").value,
function topbar_change_the_bg_color(e){
  var bg_colorVal=document.querySelector("#choose_main_color_topbar").value
  if(bg_colorVal){
    document.querySelector('.rm199_preferences_example').style.background=bg_colorVal
  }
}

function topbar_change_the_txt_color(e){
  var  text_colorVal=document.querySelector("#choose_text_color_topbar").value
  if(text_colorVal){
    document.querySelector('.rm199_preferences_example p').style.color=text_colorVal
  }
}

function topbar_change_the_link_color(e){
  var text_link_colorVal=document.querySelector("#choose_button_link_color_topbar").value
  if(text_link_colorVal){
    document.querySelector('.rm199_preferences_example button').style.color=text_link_colorVal
  }
}

function select_all_tags_and_categories(e){
  if(document.querySelector("#preferences_handler_select_all").checked){
    document.querySelector('#preferences_handler_tags').checked=true
    document.querySelector('#preferences_handler_categories').checked=true
  }else{
    document.querySelector('#preferences_handler_tags').checked=false
    document.querySelector('#preferences_handler_categories').checked=false
  }
}


function display_topbar_till_user_choose_preferences(e){
 var display_topbar_till_user_choose_preferences=document.querySelector("#display_topbar_till_user_choose_preferences").checked
 if(display_topbar_till_user_choose_preferences){
 document.querySelector('.topbar_duration_seconds').disabled=true
 }else{
 document.querySelector('.topbar_duration_seconds').disabled=false
 }
}