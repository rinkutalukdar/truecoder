<?php
namespace Drupal\d8_learn\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
// use Drupal\d8_learn\FormManager;
// use Drupal\Core\Config\ConfigFactoryInterface;
// use Drupal\webprofiler\Config\ConfigFactoryWrapper;
// use GuzzleHttp\Client;
// use Drupal\Component\Serialization\Json;
// use Drupal\Core\Form\ConfigFormBase;


class CustomEventManager implements EventSubscriberInterface{
  // protected $config;
  // protected $weatherUrl = 'http://api.openweathermap.org/data/2.5/weather';
  // protected $client;

  // public function __construct(ConfigFactoryWrapper $config,  Client $client) {
  //   $this->config = $config;
  //   $this->client = $client;
  // }
  public static function getSubscribedEvents(){
    $events[KernelEvents::RESPONSE][] = array('addCustomHeaders');
    return $events;
  }

  public function addCustomHeaders(FilterResponseEvent $event) {
    $response = $event->getResponse();
    $response->headers->add(['Access-Control-Allow-Origin' => '*']);
  }
}