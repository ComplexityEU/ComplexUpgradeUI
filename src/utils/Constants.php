<?php

namespace DuoIncure\ComplexUpgradeUI\utils;

use pocketmine\item\ItemTypeIds;

interface Constants{

	//Tools
	const EFFICIENCY = "efficiency";
	const UNBREAKING = "unbreaking";
	const FORTUNE = "fortune";
	const SILK_TOUCH = "silk_touch";

	//Weapons
	const SHARPNESS = "sharpness";
	const KNOCKBACK = "knockback";
	const FIRE_ASPECT = "fire_aspect";

	const LOOTING = "looting";
	const SMITE = "smite";
	const BANE_OF_ANTHROPODS = "bane_of_anthropods";
	//These 3 (looting, smite, bane of anthropods) don't need to be added yet as mobs don't exist.

	//Bows
	const POWER = "power";
	const PUNCH = "punch";
	const FLAME = "flame";
	const INFINITY = "infinity";

	//Armour
	const PROTECTION = "protection";
	const FIRE_PROTECTION = "fire_protection";
	const BLAST_PROTECTION = "blast_protection";
	const PROJECTILE_PROTECTION = "projectile_protection";
	const FEATHER_FALLING = "feather_falling";
	const RESPIRATION = "respiration";
	const THORNS = "thorns";
	const DEPTH_STRIDER = "depth_strider";
	const AQUA_AFFINITY = "aqua_affinity";

	//Misc
	const MENDING = "mending";


	//Default Max Levels
	const EFFICIENCY_MAX = 5;
	const UNBREAKING_MAX = 3;
	const FORTUNE_MAX = 3;
	const SILK_TOUCH_MAX = 1;

	//Weapons
	const SHARPNESS_MAX = 5;
	const KNOCKBACK_MAX = 2;
	const FIRE_ASPECT_MAX = 2;
	const LOOTING_MAX = 3;
	const SMITE_MAX = 5;
	const BANE_OF_ANTHROPODS_MAX = 5;

	//Bows
	const POWER_MAX = 5;
	const PUNCH_MAX = 2;
	const FLAME_MAX = 2;
	const INFINITY_MAX = 1;

	//Armour
	const PROTECTION_MAX = 4;
	const FIRE_PROTECTION_MAX = 4;
	const BLAST_PROTECTION_MAX = 4;
	const PROJECTILE_PROTECTION_MAX = 4;
	const FEATHER_FALLING_MAX = 4;
	const RESPIRATION_MAX = 3;
	const THORNS_MAX = 3;
	const DEPTH_STRIDER_MAX = 3;
	const AQUA_AFFINITY_MAX = 1;

	//Misc
	const MENDING_MAX = 1;

	const PICKAXE = [
		ItemTypeIds::WOODEN_PICKAXE,
        ItemTypeIds::STONE_PICKAXE,
        ItemTypeIds::IRON_PICKAXE,
        ItemTypeIds::GOLDEN_PICKAXE,
        ItemTypeIds::DIAMOND_PICKAXE
	];
	const AXE = [
        ItemTypeIds::WOODEN_AXE,
        ItemTypeIds::STONE_AXE,
        ItemTypeIds::IRON_AXE,
        ItemTypeIds::GOLDEN_AXE,
        ItemTypeIds::DIAMOND_AXE
	];
	const SHOVEL = [
        ItemTypeIds::WOODEN_SHOVEL,
        ItemTypeIds::STONE_SHOVEL,
        ItemTypeIds::IRON_SHOVEL,
        ItemTypeIds::GOLDEN_SHOVEL,
        ItemTypeIds::DIAMOND_SHOVEL
    ];
	const SWORD = [
        ItemTypeIds::WOODEN_SWORD,
        ItemTypeIds::STONE_SWORD,
        ItemTypeIds::IRON_SWORD,
        ItemTypeIds::GOLDEN_SWORD,
        ItemTypeIds::DIAMOND_SWORD
	];
	const BOW = ItemTypeIds::BOW;

	const HELMET = [
        ItemTypeIds::LEATHER_CAP,
        ItemTypeIds::CHAINMAIL_HELMET,
        ItemTypeIds::IRON_HELMET,
        ItemTypeIds::GOLDEN_HELMET,
        ItemTypeIds::DIAMOND_HELMET
	];
	const CHESTPLATE = [
        ItemTypeIds::LEATHER_TUNIC,
        ItemTypeIds::CHAINMAIL_CHESTPLATE,
        ItemTypeIds::IRON_CHESTPLATE,
        ItemTypeIds::GOLDEN_CHESTPLATE,
        ItemTypeIds::DIAMOND_CHESTPLATE
	];
	const LEGGINGS = [
        ItemTypeIds::LEATHER_PANTS,
        ItemTypeIds::CHAINMAIL_LEGGINGS,
        ItemTypeIds::IRON_LEGGINGS,
        ItemTypeIds::GOLDEN_LEGGINGS,
        ItemTypeIds::DIAMOND_LEGGINGS
	];

	const BOOTS = [
        ItemTypeIds::LEATHER_BOOTS,
        ItemTypeIds::CHAINMAIL_BOOTS,
        ItemTypeIds::IRON_BOOTS,
        ItemTypeIds::GOLDEN_BOOTS,
        ItemTypeIds::DIAMOND_BOOTS
	];

	const TYPE_PICKAXE = "pickaxe";
	const TYPE_AXE = "axe";
	const TYPE_SHOVEL = "shovel";
	const TYPE_SWORD = "sword";
	const TYPE_HELMET = "helmet";
	const TYPE_CHESTPLATE = "chestplate";
	const TYPE_LEGGINGS = "leggings";
	const TYPE_BOOTS = "boots";
	const TYPE_BOW = "bow";
}
