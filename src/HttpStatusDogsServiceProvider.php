<?php

namespace Drupal\http_status_dogs;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Symfony\Component\DependencyInjection\Reference;

class HttpStatusDogsServiceProvider extends ServiceProviderBase {

  /**
   * {@inheritdoc}
   */
  public function alter(ContainerBuilder $container) {
    parent::alter($container);

    // Hijack the default HTML exception subscriber.
    $container->getDefinition('exception.default_html')
      ->setClass(DefaultExceptionHtmlSubscriber::class)
      ->addArgument(new Reference('config.factory'))
      ->addArgument(new Reference('file.mime_type.guesser'));

    $container->getDefinition('main_content_view_subscriber')
      ->setClass(MainContentViewSubscriber::class)
      ->addArgument(new Reference('config.factory'))
      ->addArgument(new Reference('file.mime_type.guesser'));
  }

}
