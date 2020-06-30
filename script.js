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
