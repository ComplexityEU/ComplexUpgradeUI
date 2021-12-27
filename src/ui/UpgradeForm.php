<?php

namespace DuoIncure\ComplexUpgradeUI\ui;

use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use DuoIncure\ComplexUpgradeUI\UpgradeMain;
use DuoIncure\ComplexUpgradeUI\utils\Constants;
use BreathTakinglyBinary\libDynamicForms\SimpleForm;
use function str_replace;
use function ucfirst;
use function strtoupper;
use function constant;
use function ucwords;

class UpgradeForm extends SimpleForm implements Constants {

	private string $type;
	private array $cfg;

    /**
     * UpgradeForm constructor.
     * @param UpgradeMain $plugin
     * @param Player $player
     * @param string $type
     */
	public function __construct(UpgradeMain $plugin, Player $player, string $type) {
		$this->cfg = $plugin->getConfig()->getAll();
		$this->type = $type;
		parent::__construct();
		$msg = $this->cfg["form-title"] ?? "&l&6UpgradeUI";
		$this->setTitle(TF::colorize($msg));
		foreach ($this->cfg["enchants"][$this->type] as $enchantName => $data){
			$ucName = strtoupper($enchantName);
			$eidMap = EnchantmentIdMap::getInstance();
			$enchantName = str_replace("_", " ", $enchantName);
			$currentEnchantLevel = $player->getInventory()->getItemInHand()->getEnchantmentLevel($eidMap->fromId(constant(EnchantmentIds::class . "::" . $ucName)));
			if($currentEnchantLevel < ($data["max-level"] ?? constant(self::class . "::" . $ucName . "_MAX"))) {
				$requiredLevels = $currentEnchantLevel * ($this->cfg["xp-per-level"] ?? 5) + 5;
				$this->addButton(TF::GOLD . ucwords($enchantName) . TF::EOL . TF::DARK_GRAY . "Levels Required: $requiredLevels", constant(self::class . "::" . $ucName));
			} elseif($currentEnchantLevel >= ($data["max-level"] ?? constant(self::class . "::" . $ucName . "_MAX"))){
				$this->addButton(TF::GOLD . ucwords($enchantName) . TF::EOL . TF::RED . "MAX LEVEL", constant(self::class . "::" . $ucName));
			}
		}
	}

	/**
	 * @param Player $player
	 * @param $data
	 */
	public function onResponse(Player $player, $data): void {
		foreach($this->cfg["enchants"][$this->type] as $enchantName => $configData){
			$ucEnchantName = strtoupper($enchantName);
			switch ($data){
				case constant(self::class . "::" . $ucEnchantName):
					$item = $player->getInventory()->getItemInHand();
                    $eidMap = EnchantmentIdMap::getInstance();
					$currentLevel = $item->getEnchantmentLevel($eidMap->fromId(constant(EnchantmentIds::class . "::" . $ucEnchantName)));
					if($currentLevel >= ($configData["max-level"] ?? constant(self::class . "::" . $ucEnchantName . "_MAX"))){
						$player->sendMessage(TF::RED . "You already have the max level of " . ucfirst($enchantName) . "!");
						return;
					}
					if($player->getXpManager()->getXpLevel() < ($currentLevel * ($this->cfg["xp-per-level"] ?? 5) + 5)){
						$player->sendMessage(TF::RED . "You do not have enough XP levels for this!");
						return;
					}
					$enchantmentToAdd = $eidMap->fromId(constant(EnchantmentIds::class . "::" . $ucEnchantName));
					$levelToSet = $currentLevel + 1;
					$item->addEnchantment(new EnchantmentInstance($enchantmentToAdd, $levelToSet));
					$player->getInventory()->setItemInHand($item);
					$playerCurrentXP = $player->getXpManager()->getXpLevel();
					$newXPLevel = $playerCurrentXP - ($currentLevel * ($this->cfg["xp-per-level"] ?? 5) + 5);
					$player->getXpManager()->setXpLevel($newXPLevel);
					break;
			}
		}
	}
}