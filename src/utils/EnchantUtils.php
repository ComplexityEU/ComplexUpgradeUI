<?php
declare(strict_types=1);

namespace DuoIncure\ComplexUpgradeUI\utils;

use pocketmine\block\BlockLegacyIds;

class EnchantUtils{

    // TODO: Implement other blocks.
    public const SUPPORTED_FORTUNE_BLOCKS = [
        BlockLegacyIds::COAL_ORE,
        BlockLegacyIds::REDSTONE_ORE,
        BlockLegacyIds::LAPIS_ORE,
        BlockLegacyIds::DIAMOND_ORE,
        BlockLegacyIds::EMERALD_ORE,
        BlockLegacyIds::QUARTZ_ORE,
        BlockLegacyIds::GLOWSTONE,
        BlockLegacyIds::SEA_LANTERN,
    ];

    public static function getMaxFortuneDrops(int $id, int $fortuneLevel): int{
        return match ($fortuneLevel) {
            1 => match ($id) {
                BlockLegacyIds::COAL_ORE, BlockLegacyIds::NETHER_QUARTZ_ORE, BlockLegacyIds::DIAMOND_ORE, BlockLegacyIds::EMERALD_ORE => 2,
                BlockLegacyIds::GLOWSTONE, BlockLegacyIds::SEA_LANTERN => 4,
                BlockLegacyIds::NETHER_WART_BLOCK => 5,
                BlockLegacyIds::REDSTONE_ORE => 6,
                BlockLegacyIds::MELON_BLOCK => 8,
                BlockLegacyIds::LAPIS_ORE => 18,
            },
            2 => match ($id) {
                BlockLegacyIds::COAL_ORE, BlockLegacyIds::NETHER_QUARTZ_ORE, BlockLegacyIds::DIAMOND_ORE, BlockLegacyIds::EMERALD_ORE => 3,
                BlockLegacyIds::GLOWSTONE => 4,
                BlockLegacyIds::SEA_LANTERN => 5,
                BlockLegacyIds::NETHER_WART_BLOCK => 6,
                BlockLegacyIds::REDSTONE_ORE => 7,
                BlockLegacyIds::MELON_BLOCK => 9,
                BlockLegacyIds::LAPIS_ORE => 27,
            },
            3 => match ($id) {
                BlockLegacyIds::COAL_ORE, BlockLegacyIds::NETHER_QUARTZ_ORE, BlockLegacyIds::DIAMOND_ORE, BlockLegacyIds::EMERALD_ORE, BlockLegacyIds::GLOWSTONE => 4,
                BlockLegacyIds::SEA_LANTERN => 5,
                BlockLegacyIds::NETHER_WART_BLOCK => 7,
                BlockLegacyIds::REDSTONE_ORE => 8,
                BlockLegacyIds::MELON_BLOCK => 9,
                BlockLegacyIds::LAPIS_ORE => 36,
            },
            default => 1,
        };
    }
}