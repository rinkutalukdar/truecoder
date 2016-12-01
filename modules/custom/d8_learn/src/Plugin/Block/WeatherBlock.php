<?php
namespace Drupal\d8_learn\Plugin\Block;

use Drupal\Core\Block\BlockBase;
#use Drupal\Plugin\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\d8_learn\OpenWeatherForecast;

/**
  * Provides a 'WeatherBlock' clock.
  * @Block(
  *  id = "weather_block",
  *  admin_label = @Translation("Weather Block")
  * )
  */

class WeatherBlock extends BlockBase implements ContainerFactoryPluginInterface{
  protected $openWeatherForecast;

  public function __construct(array $configuration, $plugin_id, $plugin_definition,OpenWeatherForecast $openWeatherForecast) {
  	parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->openWeatherForecast = $openWeatherForecast;
  }

  /**
  * {@inheritdoc}
  */
  public function blockForm($form, FormStateInterface $form_state) {
    $config = $this->getConfiguration();
    //dsm($config);
    $form['weather_api_key'] = array(
      '#title' => t('Weather API Key'),
      '#type' => 'textfield',
      '#maxlenghth' => 5,
      //'#default_value' => $config['weather_city_name']
    );
    $form['weather_city_name'] = array(
      '#title' => t('City'),
      '#type' => 'textfield',
      '#default_value' => $config['weather_city_name']
    );
    return $form;
  }


  public function build() {
  	$config = $this->getConfiguration();
  	$data = $this->openWeatherForecast->fetchWeatherData('Mumbai');
  	// $output = array(
  	//   'temp: '.  $data['main']['temp'],
   //    'pressure: ' . $data['main']['pressure'],
   //    'humidity: ' . $data['main']['humidity'],
   //    'temp_min :' .  $data['main']['temp_min'],
   //    'temp_max: ' . $data['main']['temp_max'],
  	// );
    $build['#attached'] = array(
      'library' =>  array(
        'd8_learn/d8_learn'
      ),
    );
	$build['weather_block_city'] = array(
	  '#theme' => 'weather_widget',
	  '#weather_data' => $data['main']
	);
	return $build;
  }

  
  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
  	$this->setConfiguration(['weather_api_key' => $form_state->getValue('weather_api_key')]);
  	$this->setConfiguration(['weather_city_name' => $form_state->getValue('weather_city_name')]);
  }


  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('d8_learn.open_weather_forecast')
    );
  }
}

