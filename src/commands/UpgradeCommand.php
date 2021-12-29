<?php

namespace DuoIncure\ComplexUpgradeUI\commands;

use DuoIncure\ComplexUpgradeUI\ui\UpgradeForm;
use DuoIncure\ComplexUpgradeUI\utils\Constants;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\plugin\PluginOwned;
use pocketmine\plugin\PluginOwnedTrait;
use pocketmine\utils\TextFormat as TF;
use DuoIncure\ComplexUpgradeUI\UpgradeMain;

class UpgradeCommand extends Command implements PluginOwned, Constants {

    use PluginOwnedTrait;

	public function __construct(UpgradeMain $plugin) {
	    $this->owningPlugin = $plugin;
		parent::__construct("upgrade", "Upgrade your forms using XP!", "/upgrade");
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
		/** @var UpgradeMain $plugin */
		$plugin = $this->getOwningPlugin();

		$itemID = $sender->getInventory()->getItemInHand()->getId();
		if(in_array($itemID, self::PICKAXE, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, "pickaxe"));
		} elseif(in_array($itemID, self::AXE, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, "axe"));
		} elseif(in_array($itemID, self::SHOVEL, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, "shovel"));
		} elseif(in_array($itemID, self::SWORD, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, "sword"));
		} elseif(in_array($itemID, self::HELMET, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, "helmet"));
		} elseif(in_array($itemID, self::CHESTPLATE, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, "chestplate"));
		} elseif(in_array($itemID, self::LEGGINGS, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, "leggings"));
		} elseif(in_array($itemID, self::BOOTS, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, "boots"));
		} elseif($itemID === self::BOW){
			$sender->sendForm(new UpgradeForm($plugin, $sender, "bow"));
		}
	}
}