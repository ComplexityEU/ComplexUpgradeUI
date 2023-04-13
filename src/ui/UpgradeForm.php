<?php

namespace DuoIncure\ComplexUpgradeUI\ui;

use BreathTakinglyBinary\libDynamicForms\SimpleForm;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\StringToEnchantmentParser;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat as TF;
use DuoIncure\ComplexUpgradeUI\UpgradeMain;
use DuoIncure\ComplexUpgradeUI\utils\Constants;
use function str_replace;
use function strtolower;
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
		$this->setTitle(TF::colorize($cfg->get("form-title", "&l&6UpgradeUI")));
		foreach ($cfg->getNested("enchants.{$this->type}") as $enchantName => $data){
			$ucName = strtoupper($enchantName);
			$eidMap = EnchantmentIdMap::getInstance();
			$enchantName = str_replace("_", " ", $enchantName);
            if(($enchantment = $eidMap->fromId(constant(EnchantmentIds::class . "::" . $ucName))) !== null) {
                $currentEnchantLevel = $player->getInventory()->getItemInHand()->getEnchantmentLevel($enchantment);
                if ($currentEnchantLevel < ($data["max-level"] ?? constant(self::class . "::" . $ucName . "_MAX"))) {
                    $requiredCostText = $this->getCostText($currentEnchantLevel, $data);
                    $this->addButton(TF::GOLD . ucwords($enchantName) . TF::EOL . TF::DARK_GRAY . $requiredCostText, constant(self::class . "::" . $ucName));
                } elseif ($currentEnchantLevel >= ($data["max-level"] ?? constant(self::class . "::" . $ucName . "_MAX"))) {
                    $this->addButton(TF::GOLD . ucwords($enchantName) . TF::EOL . TF::RED . "MAX LEVEL", constant(self::class . "::" . $ucName));
                }
            }
		}
	}

	/**
	 * @param Player $player
	 * @param mixed $data
	 */
	public function onResponse(Player $player, mixed $data): void {
		foreach($this->plugin->getConfig()->getNested("enchants.{$this->type}") as $enchantName => $configData){
			$enchantName = strtolower($enchantName);
			switch ($data){
				case constant(self::class . "::" . strtoupper($enchantName)):
					$item = $player->getInventory()->getItemInHand();

					$enchantment = StringToEnchantmentParser::getInstance()->parse($enchantName);
                    if($enchantment !== null) {
                        $currentLevel = $item->getEnchantmentLevel($enchantment);
                        if ($currentLevel >= ($configData["max-level"] ?? constant(self::class . "::" . strtoupper($enchantName) . "_MAX"))) {
                            $player->sendMessage(TF::RED . "You already have the max level of " . ucfirst($enchantName) . "!");
                            return;
                        }
                        $this->plugin->getEconomyProvider()->getMoney($player, function (float|int $amount) use ($player, $currentLevel, $item, $enchantment, $configData) {
                            $cost = $this->getCost($currentLevel, $configData);
                            if ($amount < $cost) {
                                $player->sendMessage(TF::RED . "You cannot afford this enchantment!");
                                return;
                            }

                            $levelToSet = $currentLevel + 1;
                            $item->addEnchantment(new EnchantmentInstance($enchantment, $levelToSet));
                            $player->getInventory()->setItemInHand($item);

                            $this->plugin->getEconomyProvider()->takeMoney($player, $cost);
                        });
                        break;
                    }
			}
		}
	}

    /**
     * @param int $currentEnchantLevel
     * @param array<string, int> $data
     * @return string
     */
	public function getCostText(int $currentEnchantLevel, array $data): string{
	    switch($this->plugin->getConfig()->getNested("economy.provider")){
            case "bedrockeconomy":
            case "economyapi":
                $monUnit = $this->plugin->getEconomyProvider()->getMonetaryUnit();
                return "Cost: {$monUnit}{$this->getCost($currentEnchantLevel, $data)}";
            case "xp":
                return "Required Levels: {$this->getCost($currentEnchantLevel, $data)}";
        }
        // Shouldn't be returned.
        return "Cost: N/A";
    }

    /**
     * @param int $currentEnchantLevel
     * @param array<string, int> $data
     * @return float|int
     */
    public function getCost(int $currentEnchantLevel, array $data): float|int{
        return match ($this->plugin->getConfig()->getNested("economy.provider")) {
            "bedrockeconomy", "economyapi" => $currentEnchantLevel * ($data["cost"] ?? 10000) + 10000,
            "xp" => $currentEnchantLevel * ($data["cost"] ?? 5) + 5,
            default => 0,
        };
    }
}