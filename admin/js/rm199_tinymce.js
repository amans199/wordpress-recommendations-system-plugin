(function(){


  // console.log(JSON.parse(document.querySelector('#rm199_tinymce_shortcodes').value))

  const rm199Shortcodes = []
  if(JSON.parse(document.querySelector('#rm199_tinymce_shortcodes').value).length === 0){
    return;
  }

  JSON.parse(document.querySelector('#rm199_tinymce_shortcodes').value).forEach(elem => {
    var elemDescription = JSON.parse(elem.options).description
    if (elemDescription.length > 40) {
      elemDescription = elemDescription.substring(0,40) + "...";
  }

  var listText = elemDescription + ' ' + '(' + elem.code + ')'
    rm199Shortcodes.push({text:listText ,value:elem.code})
  });
  

  // console.log(document.querySelector('#rm199_tinymce_shortcodes'))

  tinymce.create('tinymce.plugins.rm199', {
    init: function(ed, url){
      ed.addButton('rm199_shortcode', {
        title: 'Recommendations Master',
        cmd: 'rm199_shortcodeCmd',
        image: url + '/img/icon_2.svg'
      });
      ed.addCommand('rm199_shortcodeCmd', function(){
        var win = ed.windowManager.open({
          title: 'Attach a Recommendation pack (RM199)',
          body: [
            {
              type: 'listbox', 
              name: 'shortcodes_list',
              label: 'All Recommendations Packs',
              class:'rm199_shortcodes_listbox',
              minWidth: 500,
              values:rm199Shortcodes
            }
          ],
          buttons: [
            {
              text: "Insert",
              subtype: "primary",
              onclick: function() {
                win.submit();
              }
            },
            {
              text: "Cancel",
              onclick: function() {
                win.close();
              }
            }
          ],
          onsubmit: function(e){
            var returnText = '[rm199_posts  id=' + e.data.shortcodes_list + ']';
            ed.execCommand('mceInsertContent', 0, returnText);
          }
        });
      });
    },
    getInfo: function() {
      return {
        longname: 'rm199 Buttons',
        author: 'Ahmed Mansour amans199',
        authorurl: 'https://www.amans199.com',
        version: "1.0"
      };
    }
  });
  tinymce.PluginManager.add( 'rm199_tinymceplugin', tinymce.plugins.rm199 );
})();