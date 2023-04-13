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

	public function execute(CommandSender $sender, string $commandLabel, array $args): void{
		if(!$sender instanceof Player){
			$sender->sendMessage(TF::RED . "You must be in-game to use this command!");
			return;
		}
		if(!$this->testPermission($sender)) return;

		/** @var UpgradeMain $plugin */
		$plugin = $this->getOwningPlugin();

		$itemID = $sender->getInventory()->getItemInHand()->getTypeId();


		if(in_array($itemID, self::PICKAXE, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, self::TYPE_PICKAXE));
		} elseif(in_array($itemID, self::AXE, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, self::TYPE_AXE));
		} elseif(in_array($itemID, self::SHOVEL, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, self::TYPE_SHOVEL));
		} elseif(in_array($itemID, self::SWORD, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, self::TYPE_SWORD));
		} elseif(in_array($itemID, self::HELMET, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, self::TYPE_HELMET));
		} elseif(in_array($itemID, self::CHESTPLATE, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, self::TYPE_CHESTPLATE));
		} elseif(in_array($itemID, self::LEGGINGS, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, self::TYPE_LEGGINGS));
		} elseif(in_array($itemID, self::BOOTS, true)){
			$sender->sendForm(new UpgradeForm($plugin, $sender, self::TYPE_BOOTS));
		} elseif($itemID === self::BOW){
			$sender->sendForm(new UpgradeForm($plugin, $sender, self::TYPE_BOW));
		}
	}
}