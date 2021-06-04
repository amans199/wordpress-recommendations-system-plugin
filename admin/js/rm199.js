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
    document.getElementById("rm199__links__template").style.display = "none"
  } else if(value === 'transitioned'){
    document.getElementById("rm199__minimal__template").style.display = "none"
    document.getElementById("rm199__transitioned__template").style.display = "block"
    document.getElementById("rm199__structured__template").style.display = "none"
    document.getElementById("rm199__links__template").style.display = "none"
  } else if(value === 'structured'){
    document.getElementById("rm199__minimal__template").style.display = "none"
    document.getElementById("rm199__transitioned__template").style.display = "none"
    document.getElementById("rm199__links__template").style.display = "none"
    document.getElementById("rm199__structured__template").style.display = "block"
  }else{
    document.getElementById("rm199__minimal__template").style.display = "none"
    document.getElementById("rm199__transitioned__template").style.display = "none"
    document.getElementById("rm199__links__template").style.display = "block"
    document.getElementById("rm199__structured__template").style.display = "none"
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
