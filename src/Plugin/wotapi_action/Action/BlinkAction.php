<?php

namespace Drupal\action_example\Plugin\wotapi_action\Action;

use Drupal\wotapi_action\Object\ParameterBag;
use Drupal\wotapi_action\Plugin\WotapiActionBase;
use PhpGpio\Gpio;

/**
 * Toggles a boolean state on and off.
 *
 * @WotapiAction(
 *   id = "blink",
 *   access = {"administer permissions"},
 *   description = "Blinking LED.",
 *   at_type = "BlinkAction",
 *   title = "Blink",
 * )
 */
class BlinkAction extends WotapiActionBase {

  /**
   * {@inheritdoc}
   */
  public function execute(ParameterBag $params) {

    echo "Setting up pin 17\n";
    $gpio = new GPIO();
    $gpio->setup(17, "out");

    echo "Turning on pin 17\n";
    $gpio->output(17, 1);

    echo "Sleeping!\n";
    sleep(3);

    echo "Turning off pin 17\n";
    $gpio->output(17, 0);

    echo "Unexporting all pins\n";
    $gpio->unexportAll();
    return TRUE;
  }

  /**
   * {@inheritdoc}
   */
  public static function outputSchema() {
    return NULL;
  }

  /**
   * {@inheritdoc}
   */
  public static function input() {
    return NULL;
  }
}
