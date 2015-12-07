<?php

/**
 * @file
 * Contains \Drupal\Lightbox2\Controller\Lightbox2Controller.
 */

namespace Drupal\lightbox2\Controller;


use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Render\RendererInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class Lightbox2Controller extends ControllerBase{

  /**
   * The renderer service.
   *
   * @var \Drupal\Core\Render\RendererInterface
   */
  protected $renderer;

  /**
   * @inheritDoc
   */
  public function __construct(RendererInterface $renderer) {
    $this->renderer = $renderer;
  }

  /**
   * @inheritDoc
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('renderer')
    );
  }

  public function login(){
    $form = \Drupal::formBuilder()->getForm('Drupal\user\Form\UserLoginForm');
    $form = $this->renderer->render($form);
//    return $this->renderer->render($form);
//    return $form;
//    return new JsonResponse($form);
    print new JsonResponse($form);
    exit;
  }

  public function test(){
    $form = \Drupal::formBuilder()->getForm('Drupal\user\Form\UserLoginForm');
    return $form;
  }

}