let followForms = document.querySelectorAll('.followForm');
const followBtn = document.querySelectorAll('.follow-btn');
const username = document.querySelector('#username');

let url = 'http://localhost:8888/twitter/';

followBtn.forEach((btn) => {
  if(btn.classList.contains('following')) {
    btn.innerHTML = 'Following';
  }
});

followForms.forEach((followForm) => {
  followForm.addEventListener('click', (e) => {
    if(e.target.classList.contains('follow-btn')) {
      console.log('hello');
      const followerId = e.target.getAttribute('data-follower-id');
      const followingId = e.target.getAttribute('data-following-id');
      fetch(url + 'followSystem/follow', {
        method: 'POST',
        headers: {
          'content-type': 'application/x-www-form-urlencoded',
          'X-Requested-With': 'XMLHttpRequest'
        },
        body: `followerId=${followerId}&followingId=${followingId}`
      }) 
        .then(res => res.text())
        .then(data => {
          if(data == 'follow') {
            e.target.classList.add('following');
            e.target.innerHTML = 'Following';
          } else {
            e.target.classList.remove('following');
            e.target.innerHTML = 'Follow';
          }
        })  
        .catch(err => console.log(err));
      e.preventDefault();    
    }
    
  });
});

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems);
});
