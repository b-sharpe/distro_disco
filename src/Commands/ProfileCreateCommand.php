<?php

namespace DistroDisco\Commands;

use DistroDisco\Commands\DiscoCommand;
use Robo\Contract\VerbosityThresholdInterface;

/**
 * Class ProfileCreateCommand
 * @package DistroDisco\Commands
 */
class ProfileCreateCommand extends DiscoCommand {

  /**
   * Creates a new profile.
   *
   * @param $parent
   *   The name of the parent profile.
   * @param $name
   *   The name of the new profile.
   *
   * @command profile:create
   *
   */
  public function discoProfileCreate($parent, $name) {
    $webroot = $this->projectRoot . '/' . $this->drupalConfig['webroot'];

    // Ensure webroot exists.
    if (!is_dir($webroot)) {
      throw new \Exception('Your Drupal webroot does not exist.');
    }

    // Check for base profile.
    $base_profile = $webroot . '/profiles/contrib/' . $parent;
    if (!is_dir($base_profile)) {
      throw new \Exception('Your base profile does not exist.');
    }

    // Check create new profile.
    $new_profile = $webroot . '/profiles/custom/' . $name;
    $create = $this->taskFilesystemStack()->mkdir($new_profile)->run();
    if (!$create->wasSuccessful()) {
      throw new \Exception("Unable to create new profile directory.");
    }

    // Move base to modules dir.
    $new_profile_modules = $new_profile . '/modules/' . $parent;
    $result = $this->taskCopyDir([$base_profile => $new_profile_modules])
      ->setVerbosityThreshold(VerbosityThresholdInterface::VERBOSITY_VERBOSE)
      ->run();

    if (!$result->wasSuccessful()) {
      throw new \Exception("Unable to copy base profile.");
    }

    $this->say("Profile created.");
  }

}
