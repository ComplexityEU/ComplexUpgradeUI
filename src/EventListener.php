<?php
declare(strict_types=1);

namespace DuoIncure\ComplexUpgradeUI;

use DuoIncure\ComplexUpgradeUI\utils\EnchantUtils;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\StringToEnchantmentParser;
use pocketmine\item\Item;
use pocketmine\item\TieredTool;
use function in_array;
use function mt_rand;

class EventListener implements Listener{

    public function onBreak(BlockBreakEvent $event){
        $item = $event->getItem();
        $block = $event->getBlock();
        $drops = $event->getDrops();

        $fortuneEnchantment = $item->getEnchantment(StringToEnchantmentParser::getInstance()->parse("fortune"));

        if(!$fortuneEnchantment instanceof EnchantmentInstance) return;
        if(!in_array($block->getId(), EnchantUtils::SUPPORTED_FORTUNE_BLOCKS)) return;

        $increase = mt_rand(0, $fortuneEnchantment->getLevel() + 2) - 1;
        if($increase < 0) $increase = 0;

        if($item instanceof TieredTool && $item->getBlockToolType() === $block->getBreakInfo()->getToolType() && $item->getBlockToolHarvestLevel() >= $block->getBreakInfo()->getToolHarvestLevel()) {
            $maxPoss = EnchantUtils::getMaxFortuneDrops($block->getId(), $fortuneEnchantment->getLevel());
            $event->setDrops($this->increaseDrops($drops, $maxPoss, $increase));
        }
    }

    /**
     * @param Item[] $drops
     * @param int $max
     * @param int $amount
     * @return array
     * @credit CortexPE/TeaSpoon
     */
    private function increaseDrops(array $drops, int $max, int $amount): array{
        $newDrops = [];
        foreach($drops as $drop){
            $newCount = $drop->getCount() * ($amount + 1);
            if($newCount > $max) $newCount = $max;
            $newDrops[] = $drop->setCount($newCount);
        }
        return $newDrops;
    }
}