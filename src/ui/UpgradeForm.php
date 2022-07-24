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

    /**
     * UpgradeForm constructor.
     * @param UpgradeMain $plugin
     * @param Player $player
     * @param string $type
     */
	public function __construct(
	    private UpgradeMain $plugin,
        Player $player,
        private string $type
    ) {
		$cfg = $plugin->getConfig();

		parent::__construct();
		$msg = $cfg->get("form-title", "&l&6UpgradeUI");
		$this->setTitle(TF::colorize($msg));
		foreach ($cfg->getNested("enchants.{$this->type}") as $enchantName => $data){
			$ucName = strtoupper($enchantName);
			$eidMap = EnchantmentIdMap::getInstance();
			$enchantName = str_replace("_", " ", $enchantName);
			$currentEnchantLevel = $player->getInventory()->getItemInHand()->getEnchantmentLevel($eidMap->fromId(constant(EnchantmentIds::class . "::" . $ucName)));
			if($currentEnchantLevel < ($data["max-level"] ?? constant(self::class . "::" . $ucName . "_MAX"))) {
				$requiredCostText = $this->getCostText($currentEnchantLevel);
				$this->addButton(TF::GOLD . ucwords($enchantName) . TF::EOL . TF::DARK_GRAY . $requiredCostText, constant(self::class . "::" . $ucName));
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
		foreach($this->plugin->getConfig()->getNested("enchants.{$this->type}") as $enchantName => $configData){
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
                    $this->plugin->getEconomyProvider()->getMoney($player, function(float|int $amount) use ($player, $currentLevel, $item, $eidMap, $ucEnchantName){
                        $cost = $this->getCost($currentLevel);
                        if($amount < $cost){
                            $player->sendMessage(TF::RED . "You cannot afford this enchantment!");
                            return;
                        }

                        $enchantmentToAdd = $eidMap->fromId(constant(EnchantmentIds::class . "::" . $ucEnchantName));
                        $levelToSet = $currentLevel + 1;
                        $item->addEnchantment(new EnchantmentInstance($enchantmentToAdd, $levelToSet));
                        $player->getInventory()->setItemInHand($item);

                        $this->plugin->getEconomyProvider()->takeMoney($player, $cost);
                    });
					break;
			}
		}
	}

	public function getCostText(int $currentEnchantLevel): string{
	    switch($this->plugin->getConfig()->getNested("economy.provider")){
            case "bedrockeconomy":
            case "economyapi":
                $monUnit = $this->plugin->getEconomyProvider()->getMonetaryUnit();
                $cost = $currentEnchantLevel * $this->plugin->getConfig()->getNested("economy.cost", 10000) + 10000;
                return "Cost: {$monUnit}{$cost}";
            case "xp":
                $cost = $currentEnchantLevel * $this->plugin->getConfig()->getNested("economy.cost", 5) + 5;
                return "Required Levels: {$cost}";
        }
        // Shouldn't be returned.
        return "Cost: N/A";
    }

    public function getCost(int $currentEnchantLevel): float|int{
        return match ($this->plugin->getConfig()->getNested("economy.provider")) {
            "bedrockeconomy", "economyapi" => $currentEnchantLevel * $this->plugin->getConfig()->getNested("economy.cost", 10000) + 10000,
            "xp" => $currentEnchantLevel * $this->plugin->getConfig()->getNested("economy.cost", 5) + 5,
            default => 0,
        };
    }
}