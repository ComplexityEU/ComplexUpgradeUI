<?php

namespace DuoIncure\ComplexUpgradeUI;

use DaPigGuy\libPiggyEconomy\exceptions\MissingProviderDependencyException;
use DaPigGuy\libPiggyEconomy\exceptions\UnknownProviderException;
use DaPigGuy\libPiggyEconomy\libPiggyEconomy;
use DaPigGuy\libPiggyEconomy\providers\EconomyProvider;
use DuoIncure\ComplexUpgradeUI\commands\UpgradeCommand;
use DuoIncure\ComplexUpgradeUI\task\UpdateNotifierTask;
use pocketmine\plugin\PluginBase;

class UpgradeMain extends PluginBase{

    private EconomyProvider $provider;

    /**
     * @throws UnknownProviderException
     * @throws MissingProviderDependencyException
     */
    protected function onEnable(): void {
        $this->getServer()->getAsyncPool()->submitTask(new UpdateNotifierTask($this->getDescription()->getName(), $this->getDescription()->getVersion()));

        $this->saveDefaultConfig();

	    libPiggyEconomy::init();
	    $this->provider = libPiggyEconomy::getProvider((array)$this->getConfig()->get("economy", []));

		$this->getServer()->getCommandMap()->register("complexupgradeui", new UpgradeCommand($this));
	}

    /**
     * @return EconomyProvider
     */
	public function getEconomyProvider(): EconomyProvider{
        return $this->provider;
    }
}
