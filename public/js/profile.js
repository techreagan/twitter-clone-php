$(document).ready(function() {
  $('textarea').characterCounter();
});

const tweetBodyInput = document.querySelector('#tweet-body');
const postTweetBtn = document.querySelector('#postTweetBtn');
const postForm = document.querySelector('#postForm');
const tweetDiv = document.querySelector('#tweets');
const loader = document.querySelector('#loader');
let collection = document.querySelectorAll('.collection');
const followBtn = document.querySelectorAll('.follow-btn');
const username = document.querySelector('#username');

let url = 'http://localhost:8888/twitter/';

tweetBodyInput.addEventListener('input', postBtn);
window.addEventListener('DOMContentLoaded', loadAllTweet());

postBtn();
function postBtn() {
  let tweet = tweetBodyInput.value;

  if((tweet == '') || (tweet.length > 280) ) {
    postTweetBtn.classList.add('disabled');
  } else {
    postTweetBtn.classList.remove('disabled');
  }
}

postForm.addEventListener('submit', (e) => {
  loader.classList.remove('hide');

  fetch(url + 'tweets/postTweet', {
    method: 'POST',
    headers: {
      'content-type': 'application/x-www-form-urlencoded',
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: 'tweet=' + tweetBodyInput.value
  }) 
    .then(res => res.text())
    .then(data => {
      // console.log(data);
      loader.classList.add('hide');
      tweetBodyInput.value = '';
      loadAllTweet();
    })  
    .catch(err => console.log(err));
  e.preventDefault();
});

function populateTweets(tweets) {
  tweetDiv.innerHTML = tweets;
}

function loadAllTweet() {
  fetch(url + 'tweets/loadUserTweets/' + username.value, {
    method: 'GET',
    headers: {
      'content-type': 'application/x-www-form-urlencoded',
      'X-Requested-With': 'XMLHttpRequest'
    }
  }) 
    .then(res => res.text())
    .then(data => {
      populateTweets(data);
      // console.log(data);
    })
    .catch(err => console.log(err));
}

followBtn.forEach((btn) => {
  if(btn.classList.contains('following')) {
    btn.innerHTML = 'Following';
  }
})
collection = Array.from(collection);

collection.forEach((collection) => { 
  collection.addEventListener('click', (e) => {
    if(e.target.classList.contains('follow-btn')) {
      
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
    
  })
});

tweetDiv.addEventListener('click', (e) => {
  let tweet = e.target.parentElement;
  let userId = tweet.getAttribute('data-user');
  let tweetId = tweet.getAttribute('data-tweet');
  if(e.target.parentElement.classList.contains('likeBtn')) {
    fetch(url + 'tweets/likeTweet', {
      method: 'POST',
      headers: {
        'content-type': 'application/x-www-form-urlencoded',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: `userId=${userId}&tweetId=${tweetId}`
    })
    .then(res => res.text())
    .then(data => {
      data = JSON.parse(data);
      if(data.like == 'yes') {
        tweet.classList.add('liked')
        tweet.lastElementChild.innerHTML = data.like_number;
      } else {
        tweet.classList.remove('liked')
        tweet.lastElementChild.innerHTML = data.like_number;
      }
      
    })
    .catch(err => err);
    e.preventDefault();
  }

  if(e.target.parentElement.classList.contains('deleteBtn')) {
    let tweetId = e.target.parentElement.getAttribute('data-id');
    fetch(url + 'tweets/deleteTweet', {
      method: 'POST',
      headers: {
        'content-type': 'application/x-www-form-urlencoded',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: `tweetId=${tweetId}`
    })
    .then(res => res.text())
    .then(data => {
      if(data == 'deleted') {
        e.target.parentElement.parentElement.parentElement.parentElement.remove();
      } else {
       console.log('something happened');
      }
      
    })
    .catch(err => err);
    e.preventDefault();
  }
});

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems);

  var modal = document.querySelector('.modal');
  var modalInst = M.Modal.init(modal);
});