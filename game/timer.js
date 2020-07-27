const TIMER = setInterval(updateTimer, 500);
const TIME_ALLOWED = 60;
document.getElementById("back-button").addEventListener("click", function(){
  sessionStorage.removeItem("startTime");
});

// Get number of seconds since page loaded and display it after formating it
function updateTimer() {
  let startTime;

  // Get time from sessionStorage or set it if starting the game.
  if(sessionStorage.getItem("startTime") == null) {
    startTime = Math.round(Date.now() / 1000);
    sessionStorage.setItem("startTime", startTime);
  } else {
    startTime = sessionStorage.getItem("startTime");
  }

  let currentTime = Math.round(Date.now() / 1000);
  let difference = currentTime - startTime;
  let timeLeft = TIME_ALLOWED - difference;

  // Clear the timer and go to results page
  if(timeLeft <= 0) {
    sessionStorage.removeItem("startTime");
    location.href = 'stats.php';
  }

  // If the timer fails, stop it from running
  try {
    document.getElementById("timer").innerHTML = formatTime(timeLeft);
  } catch(err) {
    clearInterval(TIMER);
    console.log("There was an error with the timer");
  }
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
