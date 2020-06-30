function load() {
  console.log("Reached here")
  const request = new XMLHttpRequest();

  request.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
    }
  }
  request.open("GET", "database.php", true);
  request.send();

}
