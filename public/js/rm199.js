
function deleteThisKeyword(e) {
  var thisKeyword = e.target.parentElement.children[0].innerHTML,
    allKeywords = document.getElementById('rm199_all_keywords').value,
    postID = document.getElementById('rm199_post_id').value,
    rm199User = document.getElementById('rm199_user').value;
  // start updating 

  var ourUpdatedPost = {
    'title': rm199User,
    'content': allKeywords.toString().replace(thisKeyword, "")
  }

  // console.log(' rm199Obj.security ' + rm199Obj.security + 'fffff' + ourUpdatedPost.content)

  // var xhr = new XMLHttpRequest();
  // xhr.open('GET', url, false);
  // xhr.setRequestHeader('X-WP-Nonce', nonce);
  // xhr.onload = function () {
  //   if (xhr.status === 200) {
  //     self.postMessage(xhr.response);
  //   }
  // };
  // xhr.send();


  var request = new XMLHttpRequest();
  request.open('POST', rm199Obj.siteurl + '/wp-json/wp/v2/user-preference/' + postID, true);
  request.setRequestHeader('X-WP-Nonce', rm199Obj.security);
  // request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
  request.onload = function () {
    if (request.status === 200) {
      // self.postMessage(request.response);
      console.log('fvfvfff')
    }
  };
  request.send(ourUpdatedPost);


  // $.ajax({
  //   beforeSend: (xhr) => {
  //     xhr.setRequestHeader('X-WP-Nonce', rm199Obj.security)
  //   },
  //   url: rm199Obj.siteurl + '/wp-json/wp/v2/user_preference/' + postID,
  //   type: 'POST',
  //   data: ourUpdatedPost,
  //   success: (response) => {
  //     console.log("congrats");
  //     console.log(response);
  //   },
  //   error: (response) => {
  //     console.log("sorry");
  //     console.log(response);
  //   }
  // });
}

