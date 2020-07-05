<?php
class Song {
  public $album;
  public $title;
  public $artist;

  function __construct($album, $title, $artist) {
    $this->album = $album;
    $this->title = $title;
    $this->artist = $artist;
  }

  function get_name() {
    return $this->name;
  }

  function get_title() {
    return $this->title;
  }

  function get_artist() {
    return $this->artist;
  }
}
?>