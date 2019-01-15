<?php

namespace DistroDisco\Commands;

use Robo\Tasks;
use Robo\Robo;

/**
 * Class DiscoCommand
 *
 * @package DiscoCommand\Commands
 */
abstract class DiscoCommand extends Tasks {

  /** configuration. */
  protected $drupalConfig;

  /**
   * DiscoCommand constructor.
   */
  public function __construct() {
    $drupalConfig = Robo::config()->get('drupal');
    $this->drupalConfig = $drupalConfig;
  }

  /**
   * Override the confirm method from consolidation/Robo to allow automatic
   * confirmation.
   *
   * @param string $question
   */
  public function confirm($question) {
    if ($this->input()->getOption('yes')) {
      $this->say('Ignoring confirmation question as --yes option passed.');

      return TRUE;
    }
    return parent::confirm($question);
  }

}
