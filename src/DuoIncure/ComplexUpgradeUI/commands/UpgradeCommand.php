<?php

namespace DuoIncure\ComplexUpgradeUI\commands;

use DuoIncure\ComplexUpgradeUI\ui\UpgradeForm;
use DuoIncure\ComplexUpgradeUI\utils\Constants;
use pocketmine\command\PluginCommand;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat as TF;
use DuoIncure\ComplexUpgradeUI\UpgradeMain;

class UpgradeCommand extends PluginCommand implements Constants {

	/** @var UpgradeMain */
	private $plugin;

	public function __construct(string $name, Plugin $owner)
	{
		$this->plugin = $owner;
		parent::__construct($name, $owner);
		$this->setDescription("Upgrade your forms using XP!");
		$this->setPermission("upgradeui.command.upgrade");
		$this->setAliases(["complexupgradeui", "upgrade", "cuui", "uui"]);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args)
	{
		if(!$sender instanceof Player){
			$sender->sendMessage(TF::RED . "You must be in-game to use this command!");
		}
		if(!$sender->hasPermission("upgradeui.command.upgrade")){
			$sender->sendMessage(TF::RED . "You do not have permission to use this command!");
		}
		$itemID = $sender->getInventory()->getItemInHand()->getId();
		if(in_array($itemID, self::PICKAXE, true)){
			$sender->sendForm(new UpgradeForm($this->plugin, $sender, "pickaxe"));
		} elseif(in_array($itemID, self::AXE, true)){
			$sender->sendForm(new UpgradeForm($this->plugin, $sender, "axe"));
		} elseif(in_array($itemID, self::SHOVEL, true)){
			$sender->sendForm(new UpgradeForm($this->plugin, $sender, "shovel"));
		} elseif(in_array($itemID, self::SWORD, true)){
			$sender->sendForm(new UpgradeForm($this->plugin, $sender, "sword"));
		} elseif(in_array($itemID, self::HELMET, true)){
			$sender->sendForm(new UpgradeForm($this->plugin, $sender, "helmet"));
		} elseif(in_array($itemID, self::CHESTPLATE, true)){
			$sender->sendForm(new UpgradeForm($this->plugin, $sender, "chestplate"));
		} elseif(in_array($itemID, self::LEGGINGS, true)){
			$sender->sendForm(new UpgradeForm($this->plugin, $sender, "leggings"));
		} elseif(in_array($itemID, self::BOOTS, true)){
			$sender->sendForm(new UpgradeForm($this->plugin, $sender, "boots"));
		} elseif($itemID === self::BOW){
			$sender->sendForm(new UpgradeForm($this->plugin, $sender, "bow"));
		}
	}
}