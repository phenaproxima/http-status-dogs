<?php

namespace Drupal\http_status_dogs;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\EventSubscriber\DefaultExceptionHtmlSubscriber as BaseDefaultExceptionHtmlSubscriber;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesserInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class DefaultExceptionHtmlSubscriber extends BaseDefaultExceptionHtmlSubscriber {

  use DoggyTrait;

  protected $configFactory;

  protected $mimeTypeGuesser;

  public function __construct($http_kernel, $logger, $redirect_destination, $access_unaware_router, ConfigFactoryInterface $config_factory, MimeTypeGuesserInterface $mime_type_guesser) {
    parent::__construct($http_kernel, $logger, $redirect_destination, $access_unaware_router);
    $this->configFactory = $config_factory;
    $this->mimeTypeGuesser = $mime_type_guesser;
  }

  /**
   * {@inheritdoc}
   */
  public function onException(GetResponseForExceptionEvent $event) {
    $e = $event->getException();

    if ($e instanceof HttpExceptionInterface) {
      $response = $this->getResponse($e->getStatusCode());
      if ($response) {
        $event->setResponse($response);
      }
    }
  }

}
