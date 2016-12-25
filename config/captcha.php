<?php


/*if (!class_exists('CaptchaConfiguration')) { return; }

// BotDetect PHP Captcha configuration options

return [
  // Captcha configuration for example page
  'ExampleCaptcha' => [
    'UserInputID' => 'CaptchaCode',
    'ImageWidth' => 250,
    'ImageHeight' => 50,
  ],

];
*/

return [
    'secret' => env('NOCAPTCHA_SECRET'),
    'sitekey' => env('NOCAPTCHA_SITEKEY'),
];
