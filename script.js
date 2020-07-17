const START_TIME = Math.round(Date.now() / 1000);
const timer = setInterval(updateTimer, 50);

// The timer starts at 1 minute
const TIME_ALLOWED = 60;


function setup() {
  updateTimer();
  load();
}

function load() {
  const request = new XMLHttpRequest();

  request.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200) {
      document.getElementById("information-div").innerHTML = this.responseText;
    }
  }
  request.open("GET", "database.php", true);
  request.send();
}

function saveResult() {
  let answer = document.getElementById("answer-input").value;
  inputs.push(answer);
  console.log(inputs);
  // ajax POST => 'save-answer.php';
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
  try {
    document.getElementById("timer").innerHTML = formatTime(timeLeft);
  } catch(err) {
    clearInterval(timer);
  }

}

function endGame() {
  const request = new XMLHttpRequest();
  const answersJSON = JSON.stringify(inputs);

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
