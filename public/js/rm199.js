

window.onload = (event) => {
  setTimeout(()=>{
    if (document.body.contains(document.getElementById('rm199_topbar_sys'))) {


      // .rm199_topbar :: STYLES
      document.querySelector(".rm199_topbar").style.background = document.querySelector(".rm199_topbar").dataset.background;
      document.querySelector(".rm199_topbar").style.color = document.querySelector(".rm199_topbar").dataset.color;
      document.querySelector("#rm199_preferences_modal_btn").style.color = document.querySelector(".rm199_topbar").dataset.btn_color;

      
      // End Styling


      if (!localStorage.rm199_preferences) {
        document.querySelector("#rm199_topbar_sys").style.display = "block"
      }else{
        console.log('preferences is in local storage ')
        console.log(localStorage.rm199_preferences)
      }
      // console.log( "ready!" );
  
        // Get DOM Elements
          const modal = document.querySelector('#rm199_preferences_modal');
          const modalBtn = document.querySelector('#rm199_preferences_modal_btn');
          const closeBtn = document.querySelector('.close');
  
          // Events
          modalBtn.addEventListener('click', openModal);
          closeBtn.addEventListener('click', closeModal);
          window.addEventListener('click', outsideClick);
  
      // Open
      function openModal() {
        modal.style.display = 'block';
      }
  
      // Close
      function closeModal() {
        modal.style.display = 'none';
      }
  
      // Close If Outside Click
      function outsideClick(e) {
        if (e.target == modal) {
          modal.style.display = 'none';
        }
      }
  
  } else {
    // console.log( "ready! no" );
  }
  },1000)
};




