<?php

namespace Drupal\http_status_dogs;

use Symfony\Component\HttpFoundation\Response;

trait DoggyTrait {

  private function configFactory() {
    return $this->configFactory ?: \Drupal::configFactory();
  }

  private function mimeTypeGuesser() {
    return $this->mimeTypeGuesser ?: \Drupal::service('file.mime_type.guesser');
  }

  public static function getMask($status_code = NULL) {
    $mask = '/';
    if ($status_code) {
      $mask .= '^' . $status_code;
    }
    return $mask . '\.(jpe?g|gif|png)$/i';
  }

  protected function getResponse($status_code) {
    $uri = $this->getImage($status_code);

    if (file_exists($uri)) {
      $data = file_get_contents($uri);

      $headers = [];
      if ($mime = $this->mimeTypeGuesser()->guess($uri)) {
        $headers['Content-Type'] = $mime;
      }
      return new Response($data, $status_code, $headers);
    }
  }

  protected function getImage($status_code) {
    $config = $this->configFactory()
      ->get('http_status_dogs.settings')
      ->get();

    $dir = rtrim($config['images_dir'], '/');

    // In wat mode, return a randomly chosen image.
    if ($config['wat']) {
      $choices = file_scan_directory($dir, static::getMask());
      shuffle($choices);
    }
    // Otherwise, return the appropriate image for this status code.
    else {
      $choices = file_scan_directory($dir, static::getMask($status_code));
    }
    return reset($choices)->uri;
  }

}
