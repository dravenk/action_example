<?php

namespace Drupal\action_example\Plugin\wotapi_action\Action;

use Drupal\wotapi_action\Object\ParameterBag;
use Drupal\wotapi_action\Plugin\WotapiActionBase;

/**
 * Fades a multi level switch to a given level over a given duration.
 *
 * @WotapiAction(
 *   id = "fade",
 *   access = {"administer site configuration"},
 *   description = "Fades a multi level switch to a given level over a given duration.",
 *   at_type = "FadeAction",
 *   title = "Fade",
 * )
 */
class FadeAction extends WotapiActionBase {

  /**
   * {@inheritdoc}
   */
  public function execute(ParameterBag $params) {
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public static function outputSchema() {
    return ['type' => 'number'];
  }

  /**
   * {@inheritdoc}
   */
  public static function input() {
    return [
      'type' => 'object',
      'properties' => [
        'brightness' => [
          'type' => 'integer',
          'minimum' => 0,
          'maximum' => 100,
        ],
        'duration' => [
          'type' => 'integer',
          'minimum' => 0,
          'unit' => 'milliseconds',
        ],
      ],
    ];
  }
}
