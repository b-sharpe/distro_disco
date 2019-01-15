<?php

namespace DistroDisco\Commands;


/**
 * Class ProfileCreateCommand
 * @package DistroDisco\Commands
 */
class ProfileCreateCommand extends DiscoCommand {

  /**
   * Creates a new profile.
   *
   * @command profile:create
   * @alias env:info
   * @alias e:i
   */
  public function discoProfileCreate($name) {

    


    $this->say("Profile created.");
  }

}
