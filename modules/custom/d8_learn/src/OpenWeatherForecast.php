<?php
namespace Drupal\d8_learn;

use Symfony\Component\DependencyInjection\ContainerInterface;
// use Drupal\d8_learn\FormManager;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\webprofiler\Config\ConfigFactoryWrapper;
use GuzzleHttp\Client;
use Drupal\Component\Serialization\Json;
// use Drupal\Core\Form\ConfigFormBase;


class OpenWeatherForecast{
  protected $config;
  protected $weatherUrl = 'http://api.openweathermap.org/data/2.5/weather';
  protected $client;

  public function __construct(ConfigFactoryWrapper $config,  Client $client) {
    $this->config = $config;
    $this->client = $client;
  }

  /**
  * @inheritdoc
  */
  public function fetchWeatherData($city) {
    //$config = $this->config->get();
    //$api = $config->get('weather_api_key');
    $api_key = \Drupal::config('d8_learn.config')->get('weather_api_key');
    //print_r($api);die();
    //$config = $this->getConfiguration();
    //dsm($config);
    $url = $this->weatherUrl . '?q=' . $city . '&appid=' . $api_key;
    // $client = new GuzzleHttp\Client();
    $response = $this->client->request('GET', $url);
    //print_r($response); die();
    //$status = $response->getStatusCode();
    $data = $response->getBody()->getContents();
    $output = Json::decode($data);
    //print_r($data);die();
    //$output = $api_key . $city;
    //dsm($output);
    return $output;
  }


  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('http_client'),
      $container->get('config.factory')
    );
  }
}