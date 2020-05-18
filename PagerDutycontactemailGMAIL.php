<?php
$emailAddress = "gomezezequielmaximiliano@gmail.com";

$messages = json_decode($HTTP_RAW_POST_DATA); // alternately, try file_get_contents('php://input');

if ($messages) foreach ($messages->messages as $webhook) {
  $service = $webhook->data->incident->service->name;
  $description = $webhook->data->incident->trigger_summary_data->subject." ".$webhook->data->incident->trigger_summary_data->description;
  $status = $webhook->data->incident->status;
  $subject = "$status: $description on $service";
  $link = $webhook->data->incident->html_url;
  $body = "$subject\n$link\n\n$HTTP_RAW_POST_DATA";
  mail($emailAddress, $subject, $body);
}
//PagerDuty doesn't keep the output of this script.
?>