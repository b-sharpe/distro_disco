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

  /**
   * Drupal Configuration.
   *
   * @var mixed
   */
  protected $drupalConfig;

  /**
   * Path to project root.
   *
   * @var string
   */
  protected $projectRoot;

  /**
   * DiscoCommand constructor.
   */
  public function __construct() {
    $this->projectRoot = Robo::config()->get('project_root');
    $this->drupalConfig = Robo::config()->get('drupal');
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
