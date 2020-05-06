<?php

namespace DuoIncure\ComplexUpgradeUI\ui;

use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\Player;
use pocketmine\utils\TextFormat as TF;
use DuoIncure\ComplexUpgradeUI\UpgradeMain;
use DuoIncure\ComplexUpgradeUI\utils\Constants;
use BreathTakinglyBinary\libDynamicForms\SimpleForm;
use function ucfirst;
use function strtoupper;
use function constant;

class UpgradeForm extends SimpleForm implements Constants {

	/** @var UpgradeMain */
	private $plugin;
	private $cfg, $type;

	/**
	 * AxeForm constructor.
	 * @param UpgradeMain $plugin
	 * @param Player $player
	 */
	public function __construct(UpgradeMain $plugin, Player $player, string $type)
	{
		$this->plugin = $plugin;
		$this->cfg = $plugin->getConfig()->getAll();
		$this->type = $type;
		parent::__construct();
		$msg = $this->cfg["form-title"] ?? "&l&6UpgradeUI";
		$this->setTitle(TF::colorize($msg));
		foreach ($this->cfg["enchants"][$this->type] as $enchantName => $data){
			$ucName = strtoupper($enchantName);
			$currentEnchantLevel = $player->getInventory()->getItemInHand()->getEnchantmentLevel(constant(Enchantment::class . "::" . $ucName));
			if($currentEnchantLevel < ($data["max-level"] ?? constant(self::class . "::" . $ucName . "_MAX"))) {
				$requiredLevels = $currentEnchantLevel * ($this->cfg["xp-per-level"] ?? 5) + 5;
				$this->addButton(TF::GOLD . ucfirst($enchantName) . TF::EOL . TF::DARK_GRAY . "Levels Required: $requiredLevels", constant(self::class . "::" . $ucName));
			} elseif($currentEnchantLevel >= ($data["max-level"] ?? constant(self::class . "::" . $ucName . "_MAX"))){
				$this->addButton(TF::GOLD . ucfirst($enchantName) . TF::EOL . TF::RED . "MAX LEVEL", constant(self::class . "::" . $ucName));
			}
		}
	}

	/**
	 * @param Player $player
	 * @param $data
	 */
	public function onResponse(Player $player, $data): void
	{
		foreach($this->cfg["enchants"][$this->type] as $enchantName => $configData){
			$ucEnchantName = strtoupper($enchantName);
			switch ($data){
				case constant(self::class . "::" . $ucEnchantName):
					$item = $player->getInventory()->getItemInHand();
					$currentLevel = $item->getEnchantmentLevel(constant(Enchantment::class . "::" . $ucEnchantName));
					if($currentLevel >= ($configData["max-level"] ?? constant(self::class . "::" . $ucEnchantName . "_MAX"))){
						$player->sendMessage(TF::RED . "You already have the max level of " . ucfirst($enchantName) . "!");
						return;
					}
					if($player->getXpLevel() < ($currentLevel * ($this->cfg["xp-per-level"] ?? 5) + 5)){
						$player->sendMessage(TF::RED . "You do not have enough XP levels for this!");
						return;
					}
					$enchantmentToAdd = Enchantment::getEnchantment(constant(Enchantment::class . "::" . $ucEnchantName));
					$levelToSet = $currentLevel + 1;
					$item->addEnchantment(new EnchantmentInstance($enchantmentToAdd, $levelToSet));
					$player->getInventory()->setItemInHand($item);
					$playerCurrentXP = $player->getXpLevel();
					$newXPLevel = $playerCurrentXP - ($currentLevel * ($this->cfg["xp-per-level"] ?? 5) + 5);
					$player->setXpLevel($newXPLevel);
					break;
			}
		}
	}
}