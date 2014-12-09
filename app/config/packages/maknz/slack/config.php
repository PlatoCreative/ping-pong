<?php

return [
  
  /*
  |-------------------------------------------------------------
  | Incoming webhook endpoint
  |-------------------------------------------------------------
  |
  | The endpoint which Slack generates when creating a 
  | new incoming webhook. It will look something like 
  | https://acc.slack.com/services/hooks/incoming-webhook?token=abc
  |
  */

  'endpoint' => 'https://hooks.slack.com/services/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',

  /*
  |-------------------------------------------------------------
  | Default channel
  |-------------------------------------------------------------
  |
  | The default channel we should post to. The channel can either be a 
  | channel like #general, a private #group, or a @username.
  |
  */

  'channel' => '#ping-pong',

  /*
  |-------------------------------------------------------------
  | Default username
  |-------------------------------------------------------------
  |
  | The default username we should post as
  |
  */

  'username' => 'PingPong',

  /*
  |-------------------------------------------------------------
  | Default icon
  |-------------------------------------------------------------
  |
  | The default icon to use. This can either be a URL to an image or Slack
  | emoji like :ghost: or :heart_eyes:
  |
  */

  'icon' => null,

];
