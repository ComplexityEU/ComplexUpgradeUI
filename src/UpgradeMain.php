<?php

namespace DuoIncure\ComplexUpgradeUI;

use DaPigGuy\libPiggyEconomy\exceptions\MissingProviderDependencyException;
use DaPigGuy\libPiggyEconomy\exceptions\UnknownProviderException;
use DaPigGuy\libPiggyEconomy\libPiggyEconomy;
use DaPigGuy\libPiggyEconomy\providers\EconomyProvider;
use DuoIncure\ComplexUpgradeUI\commands\UpgradeCommand;
use JackMD\UpdateNotifier\UpdateNotifier;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\data\bedrock\EnchantmentIds;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\ItemFlags;
use pocketmine\item\enchantment\Rarity;
use pocketmine\item\enchantment\StringToEnchantmentParser;
use pocketmine\lang\KnownTranslationFactory;
use pocketmine\plugin\PluginBase;

class UpgradeMain extends PluginBase{

    private EconomyProvider $provider;

    /**
     * @throws UnknownProviderException
     * @throws MissingProviderDependencyException
     */
    protected function onEnable(): void {
        UpdateNotifier::checkUpdate($this->getDescription()->getName(), $this->getDescription()->getVersion());
        $this->saveDefaultConfig();

	    libPiggyEconomy::init();
	    $this->provider = libPiggyEconomy::getProvider($this->getConfig()->get("economy"));

		$this->getServer()->getCommandMap()->register("complexupgradeui", new UpgradeCommand($this));
        $this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);

		$this->registerEnchantments();
	}

	public function getEconomyProvider(): EconomyProvider{
        return $this->provider;
    }

    public function registerEnchantments(): void{
        $fortuneEnchantment = new Enchantment(KnownTranslationFactory::enchantment_lootBonusDigger(), Rarity::RARE, ItemFlags::TOOL, ItemFlags::NONE, 3);

        $eidMap = EnchantmentIdMap::getInstance();
        $steParser = StringToEnchantmentParser::getInstance();

        $eidMap->register(EnchantmentIds::FORTUNE, $fortuneEnchantment);
        $steParser->register("fortune", fn() => $fortuneEnchantment);
    }
}
