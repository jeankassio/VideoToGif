# VideoToGif
A simple video to gif converter that uses FFMPEG and simplifies the whole process for you. The entire process is done in base64, from input to output


[![Total Downloads](https://poser.pugx.org/jeankassio/VideoToGif/downloads)](https://packagist.org/packages/jeankassio/VideoToGif)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](https://opensource.org/licenses/MIT)


You must have [FFMpeg](https://ffmpeg.org/) installed in your PATH on your system. If not, follow this [tutorial](https://phoenixnap.com/kb/install-ffmpeg-ubuntu).

## Installation

The recommended way to install is using [Composer](https://getcomposer.org).

```bash
$ composer require jeankassio/videotogif
```

## How to use?

```php
use JeanKassio\VideoToGif;
  
  $converter = new VideoToGif();
  
  $b64 = "data:video/mp4;base64,AAAAGGZ0eXBtcDQyAAAAAGlzb2...";
  
  $result = $converter->convert($b64);

  var_dump($result);
```


### And the result will look like:

```php

array(4) { 
  ["gif"]=> string(304970) "data:image/gif;base64,R0lGODlhkAGWAfcAAD4AND4UPUMHN1YBNEkUO1UYPGUWO1cl..." (Hidden to save on reading)
  ["fps"]=> int(29) 
  ["width"]=> int(400) 
  ["height"]=> int(406) 
}

```
