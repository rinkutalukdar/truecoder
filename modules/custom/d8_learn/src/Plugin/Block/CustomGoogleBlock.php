<?php

namespace Drupal\d8_learn\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use AntoineAugusti\Books\Fetcher;
use GuzzleHttp\Client;
use Drupal\Component\Serialization\Json;

/**
 * Provides a 'CustomGoogleBlock' block.
 *
 * @Block(
 *  id = "custom_google_block",
 *  admin_label = @Translation("Custom Google Book"),
 * )
 */
class CustomGoogleBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form['isbn'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('ISBN'),
      '#description' => $this->t(''),
      '#default_value' => isset($this->configuration['isbn']) ? $this->configuration['isbn'] : '',
      // '#maxlength' => ISBN No,
      '#size' => 100,
      '#weight' => '0',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['isbn'] = $form_state->getValue('isbn');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $client = new Client(['base_uri' => 'https://www.googleapis.com/books/v1/']);
    $fetcher = new Fetcher($client);
    $book = $fetcher->forISBN($this->configuration['isbn']);
    // $data = $book->getBody()->getContents();
    // $output = Json::decode($book);
    //dsm($book->title);
    $build['custom_google_block_isbn']['#markup'] = '<p>' . $book->title . '</p>';

    return $build;
  }

}
