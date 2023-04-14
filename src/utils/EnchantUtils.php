<?php
declare(strict_types=1);

namespace DuoIncure\ComplexUpgradeUI\utils;

use pocketmine\block\BlockTypeIds;

class EnchantUtils{

    // TODO: Implement other blocks.
    public const SUPPORTED_FORTUNE_BLOCKS = [
        BlockTypeIds::COAL_ORE,
        BlockTypeIds::DEEPSLATE_COAL_ORE,
        BlockTypeIds::REDSTONE_ORE,
        BlockTypeIds::DEEPSLATE_REDSTONE_ORE,
        BlockTypeIds::LAPIS_LAZULI_ORE,
        BlockTypeIds::DEEPSLATE_LAPIS_LAZULI_ORE,
        BlockTypeIds::DIAMOND_ORE,
        BlockTypeIds::DEEPSLATE_DIAMOND_ORE,
        BlockTypeIds::EMERALD_ORE,
        BlockTypeIds::DEEPSLATE_EMERALD_ORE,
        BlockTypeIds::NETHER_QUARTZ_ORE,
        BlockTypeIds::GLOWSTONE,
        BlockTypeIds::SEA_LANTERN,
    ];

    /**
     * @param int $id
     * @param int $fortuneLevel
     * @return int
     */
    public static function getMaxFortuneDrops(int $id, int $fortuneLevel): int{
        return match ($fortuneLevel) {
            1 => match ($id) {
                BlockTypeIds::COAL_ORE, BlockTypeIds::DEEPSLATE_COAL_ORE, BlockTypeIds::NETHER_QUARTZ_ORE, BlockTypeIds::DIAMOND_ORE, BlockTypeIds::DEEPSLATE_DIAMOND_ORE, BlockTypeIds::EMERALD_ORE, BlockTypeIds::DEEPSLATE_EMERALD_ORE => 2,
                BlockTypeIds::GLOWSTONE, BlockTypeIds::SEA_LANTERN => 4,
                BlockTypeIds::NETHER_WART_BLOCK => 5,
                BlockTypeIds::REDSTONE_ORE, BlockTypeIds::DEEPSLATE_REDSTONE_ORE => 6,
                BlockTypeIds::MELON => 8,
                BlockTypeIds::LAPIS_LAZULI_ORE, BlockTypeIds::DEEPSLATE_LAPIS_LAZULI_ORE => 18,
                default => 1
            },
            2 => match ($id) {
                BlockTypeIds::COAL_ORE, BlockTypeIds::DEEPSLATE_COAL_ORE, BlockTypeIds::NETHER_QUARTZ_ORE, BlockTypeIds::DIAMOND_ORE, BlockTypeIds::DEEPSLATE_DIAMOND_ORE, BlockTypeIds::EMERALD_ORE, BlockTypeIds::DEEPSLATE_EMERALD_ORE => 3,
                BlockTypeIds::GLOWSTONE => 4,
                BlockTypeIds::SEA_LANTERN => 5,
                BlockTypeIds::NETHER_WART_BLOCK => 6,
                BlockTypeIds::REDSTONE_ORE => 7,
                BlockTypeIds::MELON => 9,
                BlockTypeIds::LAPIS_LAZULI_ORE, BlockTypeIds::DEEPSLATE_LAPIS_LAZULI_ORE => 27,
                default => 1
            },
            3 => match ($id) {
                BlockTypeIds::COAL_ORE, BlockTypeIds::DEEPSLATE_COAL_ORE, BlockTypeIds::NETHER_QUARTZ_ORE, BlockTypeIds::DIAMOND_ORE, BlockTypeIds::DEEPSLATE_DIAMOND_ORE, BlockTypeIds::EMERALD_ORE, BlockTypeIds::DEEPSLATE_EMERALD_ORE, BlockTypeIds::GLOWSTONE => 4,
                BlockTypeIds::SEA_LANTERN => 5,
                BlockTypeIds::NETHER_WART_BLOCK => 7,
                BlockTypeIds::REDSTONE_ORE => 8,
                BlockTypeIds::MELON => 9,
                BlockTypeIds::LAPIS_LAZULI_ORE, BlockTypeIds::DEEPSLATE_LAPIS_LAZULI_ORE => 36,
                default => 1
            },
            default => 1,
        };
    }
}