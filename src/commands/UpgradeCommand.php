<?php

namespace DuoIncure\ComplexUpgradeUI\commands;

use DuoIncure\ComplexUpgradeUI\ui\UpgradeForm;
use DuoIncure\ComplexUpgradeUI\utils\Constants;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use DuoIncure\ComplexUpgradeUI\UpgradeMain;

class UpgradeCommand extends Command implements Constants {

	/** @var UpgradeMain */
	private UpgradeMain $plugin;

	public function __construct(string $name, UpgradeMain $owner) {
		$this->plugin = $owner;
		parent::__construct($name, "Upgrade your forms using XP!", "/upgrade");
		$this->setDescription("Upgrade your forms using XP!");
		$this->setPermission("upgradeui.command.upgrade");
		$this->setAliases(["complexupgradeui", "upgradeui"]);
	}

	public function execute(CommandSender $sender, string $commandLabel, array $args) {
		if(!$sender instanceof Player){
			$sender->sendMessage(TF::RED . "You must be in-game to use this command!");
			return;
		}
		if(!$this->testPermission($sender)){
			$sender->sendMessage(TF::RED . "You do not have permission to use this command!");
		    return;
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