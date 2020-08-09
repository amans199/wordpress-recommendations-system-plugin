
// function deleteThisKeyword(e) {
//   var thisKeyword = e.target,
//     thisKeywordValue = e.target.value
//   console.log("thisKeyword : " + thisKeyword)
//   console.log("thisKeywordValue : " + thisKeywordValue)
//   //   allKeywords = document.getElementById('rm199_all_keywords').value,
//   //   postID = document.getElementById('rm199_post_id').value,
//   //   rm199User = document.getElementById('rm199_user').value;

//   // var ourUpdatedPost = {
//   // 'title': rm199User,
//   // 'content': allKeywords.toString().replace(thisKeyword, "")
//   // }

//   // console.log(' rm199Obj.security ' + rm199Obj.security + 'fffff' + ourUpdatedPost.content)

//   // var xhr = new XMLHttpRequest();
//   // xhr.open('GET', url, false);
//   // xhr.setRequestHeader('X-WP-Nonce', nonce);
//   // xhr.onload = function () {
//   //   if (xhr.status === 200) {
//   //     self.postMessage(xhr.response);
//   //   }
//   // };
//   // xhr.send();


//   // var request = new XMLHttpRequest();
//   // request.open('POST', rm199Obj.siteurl + '/wp-json/wp/v2/user-preference/' + postID, true);
//   // request.setRequestHeader('X-WP-Nonce', rm199Obj.security);
//   // // request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
//   // request.onload = function () {
//   //   if (request.status === 200) {
//   //     // self.postMessage(request.response);
//   //     console.log('fvfvfff')
//   //   }
//   // };
//   // request.send(ourUpdatedPost);
//   const UpdatedUserMeta = [{
//     action: 'update_preferences',
//     'preferences': thisKeyword,
//   }]

//   console.log("rm199Obj.ajaxurl : " + rm199Obj.ajaxurl)
//   console.log("rm199Obj.security : " + rm199Obj.security)
//   console.log("rm199Obj.siteurl : " + rm199Obj.siteurl)
//   console.log("rm199Obj.user : " + rm199Obj.user)
//   console.log("preference : " + thisKeyword)
//   jQuery.ajax({
//     beforeSend: (xhr) => {
//       xhr.setRequestHeader('X-WP-Nonce', rm199Obj.security)
//     },
//     url: rm199Obj.siteurl + '/wp-json/wp/v2/users/' + rm199Obj.user,
//     type: 'POST',
//     data: UpdatedUserMeta,
//     success: (response) => {
//       console.log("congrats");
//       console.log(response);
//     },
//     error: (response) => {
//       console.log("sorry");
//       console.log(response);
//     }
//   });
// }

// // jQuery(function ($) {
// //   var getData = function (request, response) {
// //     $.getJSON(
// //       window.location.protocol + "//" + window.location.hostname + "/wp-json/speedguard/search?term=" + request.term,
// //       function (data) {
// //         if (data !== null) {
// //           var results = [];
// //           for (var key in data) {
// //             var valueToPush = {}; // or "var valueToPush = new Object();" which is the same
// //             valueToPush["label"] = data[key].label;
// //             valueToPush["value"] = data[key].ID;
// //             valueToPush["permalink"] = data[key].permalink;
// //             results.push(valueToPush);
// //           }
// //           //response(results); 
// //           response(results.slice(0, 5));

// //         }
// //       });
// //   };
