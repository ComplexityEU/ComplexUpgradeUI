<?php

namespace DuoIncure\ComplexUpgradeUI;

use DuoIncure\ComplexUpgradeUI\commands\UpgradeCommand;
use pocketmine\plugin\PluginBase;

class UpgradeMain extends PluginBase{

	public function onEnable(): void {
		$this->saveDefaultConfig();
		$this->getServer()->getCommandMap()->register("complexupgradeui", new UpgradeCommand("upgrade", $this));
	}
}
