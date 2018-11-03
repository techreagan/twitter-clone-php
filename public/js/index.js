$(document).ready(function() {
  $('textarea').characterCounter();
});

let url = 'http://localhost:8888/twitter/';

const tweetBodyInput = document.querySelector('#tweet-body');
const postTweetBtn = document.querySelector('#postTweetBtn');
const postForm = document.querySelector('#postForm');
const followForm = document.querySelector('#followForm');
const followBtn = document.querySelectorAll('#followBtn');
const collection = document.querySelector('.collection');
const tweetDiv = document.querySelector('#tweets');
const loader = document.querySelector('#loader');

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
  fetch(url + 'tweets/loadAllTweets', {
    method: 'GET',
    headers: {
      'content-type': 'application/x-www-form-urlencoded',
      'X-Requested-With': 'XMLHttpRequest'
    }
  }) 
    .then(res => res.text())
    .then(data => {
      populateTweets(data);
    })
    .catch(err => console.log(err));
}

// Following system
followBtn.forEach((btn) => {
  if(btn.classList.contains('following')) {
    btn.innerHTML = 'Following';
  }
})

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

followForm.addEventListener('submit', (e) => {
  
});