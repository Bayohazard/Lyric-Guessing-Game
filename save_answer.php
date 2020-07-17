<?php

$post = $_POST;

print_r($post);
if (isset($post['answer-input'])) {
  // success / fail
  // ok / error
  $data = ['status' => 'ok', 'message' => 'Answer saved successfully.'];
  $response = json_encode($data);
}