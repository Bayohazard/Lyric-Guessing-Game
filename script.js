const START_TIME = Math.round(Date.now() / 1000);
const TIMER = setInterval(updateTimer, 50);

// The timer starts at 1 minute(60 seconds)
const TIME_ALLOWED = 100;

let songInformation;

function setup() {
  updateTimer();
  load();
}

function load() {
  const request = new XMLHttpRequest();

  request.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200) {
      songInformation = JSON.parse(this.responseText);
      document.getElementById("title").innerHTML = songInformation["Title"];
      document.getElementById("artist").innerHTML = songInformation["Artist"];
    }
  }
  request.open("GET", "get-random-song.php", true);
  request.send();
}

function saveAnswer() {
  let answer = document.getElementById("answer-input").value;
  const request = new XMLHttpRequest();

  songInformation["Input"] = answer;
  let submission = JSON.stringify(songInformation);

  request.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
    }
  }
  request.open("POST", "save-answer.php", true);
  request.send();

}

// Get number of seconds since page loaded and display it after formating it
function updateTimer() {
  let currentTime = Math.round(Date.now() / 1000);
  let difference = currentTime - START_TIME;
  let timeLeft = TIME_ALLOWED - difference;
  if(timeLeft <= 0) {
    timeLeft = 0;
    location.href = 'stats.php';
  }
  // If the timer fails, stop it from running
  try {
    document.getElementById("timer").innerHTML = formatTime(timeLeft);
  } catch(err) {
    clearInterval(TIMER);
  }

}

function endGame() {
  const request = new XMLHttpRequest();

  request.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200) {
      document.getElementById("main-div").innerHTML = this.responseText;
    }
  }
  request.open("GET", "check-answers.php?inputs="+answersJSON, true);
  request.send();
}

// Formats number of seconds into MM:SS
function formatTime(sec) {
  let minutes = Math.floor(sec / 60);
  let seconds = sec - (minutes * 60);

  if (minutes < 10) {
    minutes = "0" + minutes;
  }
  if (seconds < 10) {
    seconds = "0" + seconds;
  }
  return `${minutes}:${seconds}`;
}
