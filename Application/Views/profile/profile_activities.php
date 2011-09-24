<?php
if (! count($vars['activities'])) {
  echo "No activities yet.";
} else {
  $first = true;
  foreach ($vars['activities'] as $i => $activity) {
    $add = $first ? ' first' : '';
    $first = false;
    echo "<div class=\"activity$add\">\n";
    echo "<a href=\"/profile/{$activity['person_id']}\">{$activity['person_name']}</a> ";
    echo $activity['title'] . "<br />\n";
    if (count($activity['media_items'])) {
      echo "<div style=\"clear:both\">";
      foreach ($activity['media_items'] as $mediaItem) {
        if ($mediaItem['type'] == 'IMAGE') {
          echo "<div class=\" ui-corner-all\" style=\"float:left\"><img src=\"" . $mediaItem['url'] . "\" width=\"50\"></img></div>";
        }
      }
      echo "</div>";
    }
    if (count($activity['embeds'])) {
      echo "<div style=\"clear:both\">";
      foreach ($activity['embeds'] as $j => $embed) {
        echo "<div class=\" ui-corner-all\" style=\"float:left\">";
        $width = 300;
        $view = 'embedded';
        $gadget = array(
          'id' => '9' . $j . $i,
          'mod_id' => '9' . $j . $i,
          'version' => '2.0',
          'title' => '',
          'settings' => null,
          'scrolling' => false,
          'context' => $embed['context'],
          'url' => $embed['gadget']
        );
        $person = array(
          'id' => $activity['person_id']
        );
        $this->template('/gadget/gadget.php', array(
          'width' => $width, 
          'gadget' => $gadget, 
          'person' => $person, 
          'view' => $view
        ));
        echo "</div>";
      }
      
    }
    echo "{$activity['body']}\n";
    echo "</div>";
    echo "<div style=\"clear:both\"></div>\n";
  }
}
