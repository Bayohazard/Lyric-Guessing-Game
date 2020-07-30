function displayRandomSong() {
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

  // Add input field to JSON and convert it to a string
  songInformation["Input"] = answer;
  let submission = JSON.stringify(songInformation);

  request.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200) {
      //console.log(JSON.parse(this.responseText));
    }
  }

  request.open("POST", "save-answer.php", true);
  request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  request.send("Input=" + submission);

}