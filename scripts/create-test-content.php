<?php

$node = \Drupal\node\Entity\Node::create([
  'type' => 'page',
  'title' => 'Welcome to Holy Rosary',
  'status' => 1,
]);
$node->save();

\Drupal::configFactory()
  ->getEditable('system.site')
  ->set('page.front', '/node/' . $node->id())
  ->save();

echo 'Test content created: node/' . $node->id() . "\n";