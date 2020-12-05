var url = new URL(window.location.href);
var highlight_shortcode = url.searchParams.get("highlight_shortcode")
// if (highlight_shortcode != '') {
//   console.log(highlight_shortcode)
// }
// var highlighted_element = document.querySelector('tr').filter(function () {
//   return document.querySelector(this).data("code") == highlight_shortcode
// });
// console.log(highlighted_element)
if (highlight_shortcode) {
  // highlighted_element.style.background = '#ddd'
  setTimeout(() => {
    var all_tr = document.querySelectorAll("tr");
    // console.log(all_tr)
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
    // document.getElementById('rm199_so_post_types').value = document.getElementById('rm199_post_type').value
  } else {
    document.querySelector('.rm199_input_more_post_types').style.display = 'flex';
    document.getElementById('rm199_post_type').disabled = true;
    // document.getElementById('rm199_so_post_types').value = document.getElementById('rm199__more_post_types_input').value
  }
}


function toggleCategoryBox() {
  if (document.querySelector('.rm199_input_more_categories').style.display !== 'none') {
    document.querySelector('.rm199_input_more_categories').style.display = 'none';
    document.getElementById('rm199_categories').disabled = false;
    // document.getElementById('rm199_so_categories').value = document.getElementById('rm199_categories').value

  } else {
    document.querySelector('.rm199_input_more_categories').style.display = 'flex';
    document.getElementById('rm199_categories').disabled = true;
    // document.getElementById('rm199_so_categories').value = document.getElementById('rm199__more_categories_input').value
  }
}


function toggleTagsBox() {
  if (document.querySelector('.rm199_input_more_tags').style.display !== 'none') {
    document.querySelector('.rm199_input_more_tags').style.display = 'none';
    document.getElementById('rm199_tags').disabled = false;
    // document.getElementById('rm199_so_tags').value = document.getElementById('rm199_tags').value
  } else {
    document.querySelector('.rm199_input_more_tags').style.display = 'flex';
    document.getElementById('rm199_tags').disabled = true;
    // document.getElementById('rm199_so_tags').value = document.getElementById('rm199__more_tags_input').value
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

// function copy_shortcode_for_user_preferences() {
//   var copyText = document.getElementById("shortcode_for_user_preferences");
//   copyText.select();
//   copyText.setSelectionRange(0, 99999); /*For mobile devices*/
//   document.execCommand("copy");
// }


// add options 
function rm199_title(value) {
  // document.getElementById('rm199_so_title').value = value;
  document.getElementById('rm199__overview__title').textContent = value
}

// function rm199_description(value) {
//   document.getElementById('rm199_so_description').value = value;
// }

// function rm199_filter_by_keyword() {
//   var canUserSelectKeywords = document.getElementById('filter_by_keyword').checked;
//   document.getElementById('rm199_so_can_user_select_keywords').value = canUserSelectKeywords ? 'true' : 'false';
// }

// function rm199_show_only_for_loggedin_users() {
//   var show_only_for_loggedin_users = document.getElementById('show_only_for_loggedin_users').checked;
//   document.getElementById('rm199_so_show_only_for_loggedin_users').value = show_only_for_loggedin_users ? 'true' : 'false';
// }

function rm199_number_of_posts(value) {
  document.getElementById('rm199__overview__number').textContent = value ? value : '3';
}

// function rm199_number_of_posts(value) {
//   document.getElementById('rm199_so_can_user_select_keywords').value = value ? value : '3';
// }

// function rm199_post_type(value) {
//   var postTypesBox = document.querySelector('.rm199_input_more_post_types').style.display;
//   if (postTypesBox !== "none") {
//     document.getElementById('rm199_so_post_types').value = document.getElementById('rm199__more_post_types_input').value
//     return;
//   }
//   document.getElementById('rm199_so_post_types').value = value
// }


// function rm199_categories(value) {
//   var postTypesBox = document.querySelector('.rm199_input_more_categories').style.display;
//   if (postTypesBox !== "none") {
//     document.getElementById('rm199_so_categories').value = document.getElementById('rm199__more_categories_input').value
//     return;
//   }
//   document.getElementById('rm199_so_categories').value = value
// }

// function rm199_tags(value) {
//   var postTypesBox = document.querySelector('.rm199_input_more_tags').style.display;
//   if (postTypesBox !== "none") {
//     document.getElementById('rm199_so_tags').value = document.getElementById('rm199__more_tags_input').value
//     return;
//   }
//   document.getElementById('rm199_so_tags').value = value
// }

// function template(value) {
//   document.getElementById('rm199_so_template').value = value
//   if (value === 'minimal') {
//     document.getElementById("rm199__minimal__template").style.display = "block"
//     document.getElementById("rm199__structured__template").style.display = "none"
//   } else {
//     document.getElementById("rm199__structured__template").style.display = "block"
//     document.getElementById("rm199__minimal__template").style.display = "none"
//   }
// }




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

// function choose_main_color(value) {
//   document.getElementById('rm199_so_main_color').value = value
// }

// function choose_secondary_color(value) {
//   document.getElementById('rm199_so_secondary_color').value = value
// }

// function choose_text_color(value) {
//   document.getElementById('rm199_so_text_color').value = value
// }


// function choose_code_custom_css(value) {
//   document.getElementById('rm199_so_custom_css').value = value
// }


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

// todo : don't allow user to enter directly on generate button if not submitted all info needed in form 

// function get_all_options(){
//   rm199_title('We Recommend You Those Posts')
// }


function rm199_preferences_title(e){
  var thisInput = e.target,
  title=thisInput.value,
  txtShown = document.querySelector(".rm199_preferences_example__txt")
  txtShown.textContent = title
}

// window.onload(()=>{
// if(document.querySelector('#toggle_preferences_input').checked)

// })

window.onload = function() {
  // var enable_preferences_bar = document.querySelector('#toggle_preferences_input').checked;
  
    if (document.body.contains(document.querySelector('#toggle_preferences_input'))) {
      document.querySelector('#toggle_preferences_input').addEventListener( 'change', function() {
        if(this.checked) {
            document.querySelector('.add_blur_if_disabled').style.display = "none";
        } else {
            document.querySelector('.add_blur_if_disabled').style.display = "block";
        }
    });
  }

}


