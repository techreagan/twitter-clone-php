$(document).ready(function() {
  $('textarea').characterCounter();
});

let url = 'http://localhost:8888/twitter/';

const tweetBodyInput = document.querySelector('#tweet-body');
const postTweetBtn = document.querySelector('#postTweetBtn');
const postForm = document.querySelector('#postForm');
const followForm = document.querySelector('#followForm');
const followBtn = document.querySelector('#followBtn');
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
const followerId = followBtn.getAttribute('data-follower-id');
const followingId = followBtn.getAttribute('data-following-id');

followForm.addEventListener('submit', (e) => {
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
      console.log(data);
      // loader.classList.add('hide');
      // tweetBodyInput.value = '';
      // loadAllTweet();
    })  
    .catch(err => console.log(err));


  e.preventDefault();
});