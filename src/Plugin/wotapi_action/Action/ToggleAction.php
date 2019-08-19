<?php

namespace Drupal\action_example\Plugin\wotapi_action\Action;

use Drupal\wotapi_action\Object\ParameterBag;
use Drupal\wotapi_action\Plugin\WotapiActionBase;
use PhpGpio\Gpio;

/**
 * Toggles a boolean state on and off.
 *
 * @WotapiAction(
 *   id = "toggle",
 *   access = {"administer permissions"},
 *   description = "Toggles a boolean state on and off.",
 *   at_type = "ToggleAction",
 *   title = "Toggle",
 * )
 */
class ToggleAction extends WotapiActionBase {

  /**
   * {@inheritdoc}
   */
  public function execute(ParameterBag $params) {
    // // https://github.com/ronanguilloux/php-gpio
    $gpio = new GPIO();
    // Check if pin is exported
    if (!$gpio->isExported(17)){
      // echo "Setting up pin 17\n";
      // Setup pin, takes pin number and direction (in or out)
      $gpio->setup(17, "out");
    }

    $this->toggle(17);

    return TRUE;
  }

  // TogglePin: Toggle a pin state (0 -> 1 -> 0)
  public function toggle($pinNo) {
    $status = file_get_contents('/sys/class/gpio/gpio'.$pinNo.'/value');
    if($status == 1){
      // echo "Turning off pin ".$pinNo."\n";
      file_put_contents('/sys/class/gpio/gpio'.$pinNo.'/value', 0);
      // Unexport Pin
      // file_put_contents('/sys/class/gpio/unexport', $pinNo);
    } else {
      // echo "Turning on pin ".$pinNo."\n";
      file_put_contents('/sys/class/gpio/gpio'.$pinNo.'/value', 1);
    }
    return !$status;
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
