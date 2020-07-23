<?php
$post = $_POST;
// Makes sure the array is only initialized the first time
echo $post;

if(!isset($results)) {
  $results = array();
}

if(isset($post['answer-input'])) {
  // success / fail
  // ok / error
  $data = [];
  $response = json_encode($data);
}