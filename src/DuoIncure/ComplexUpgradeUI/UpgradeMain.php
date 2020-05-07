<?php

namespace DuoIncure\ComplexUpgradeUI;

use DuoIncure\ComplexUpgradeUI\commands\UpgradeCommand;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use function file_exists;
use function mkdir;
use function version_compare;

class UpgradeMain extends PluginBase {

	public const VERSION = 1;

	/** @var Config */
	private $cfg;

	public function onEnable()
	{
		if(!file_exists($this->getDataFolder())){
			@mkdir($this->getDataFolder());
		} else if(!file_exists($this->getDataFolder() . "config.yml")){
			$this->getLogger()->info("Config Not Found! Creating new config...");
			$this->saveDefaultConfig();
		}
		$this->cfg = new Config($this->getDataFolder() . "config.yml", Config::YAML);
		$this->cfg = $this->cfg->getAll();
		if(version_compare(self::VERSION, $this->cfg["version"], ">")){
			$this->getLogger()->error("Config Version is outdated! Please delete your current config file!");
			$this->getServer()->getPluginManager()->disablePlugin($this);
		}
		$this->getServer()->getCommandMap()->register("complexupgradeui", new UpgradeCommand("upgradeui", $this));
	}
}
