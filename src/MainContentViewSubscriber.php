<?php

namespace Drupal\http_status_dogs;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\EventSubscriber\MainContentViewSubscriber as BaseMainContentViewSubscriber;
use Symfony\Component\HttpFoundation\File\MimeType\MimeTypeGuesserInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;

class MainContentViewSubscriber extends BaseMainContentViewSubscriber {

  use DoggyTrait;

  protected $configFactory;

  protected $mimeTypeGuesser;

  protected $dogsAreBetter = FALSE;

  public function __construct($class_resolver, $route_match, $renderers, ConfigFactoryInterface $config_factory, MimeTypeGuesserInterface $mime_type_guesser) {
    parent::__construct($class_resolver, $route_match, $renderers);
    $this->configFactory = $config_factory;
    $this->mimeTypeGuesser = $mime_type_guesser;
  }

  /**
   * {@inheritdoc}
   */
  public function onViewRenderArray(GetResponseForControllerResultEvent $event) {
    $now = getdate();

    // If it's April Fools Day, return a randomly chosen 2xx image. For testing,
    // this is also enabled if dogsAreBetter.
    if (($now['mon'] == 4 && $now['mday'] == 1) || $this->dogsAreBetter) {
      $response = $this->getResponse('2[0-9]{2}');
      if ($response) {
        $event->setResponse($response);
      }
    }
    else {
      parent::onViewRenderArray($event);
    }
  }

}
