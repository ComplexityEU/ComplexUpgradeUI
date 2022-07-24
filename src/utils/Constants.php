<?php

namespace DuoIncure\ComplexUpgradeUI\utils;

use pocketmine\item\ItemIds;

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
		ItemIds::WOODEN_PICKAXE,
        ItemIds::STONE_PICKAXE,
        ItemIds::IRON_PICKAXE,
        ItemIds::GOLD_PICKAXE,
        ItemIds::DIAMOND_PICKAXE
	];
	const AXE = [
        ItemIds::WOODEN_AXE,
        ItemIds::STONE_AXE,
        ItemIds::IRON_AXE,
        ItemIds::GOLD_AXE,
        ItemIds::DIAMOND_AXE
	];
	const SHOVEL = [
        ItemIds::WOODEN_SHOVEL,
        ItemIds::STONE_SHOVEL,
        ItemIds::IRON_SHOVEL,
        ItemIds::GOLD_SHOVEL,
        ItemIds::DIAMOND_SHOVEL
    ];
	const SWORD = [
        ItemIds::WOODEN_SWORD,
        ItemIds::STONE_SWORD,
        ItemIds::IRON_SWORD,
        ItemIds::GOLD_SWORD,
        ItemIds::DIAMOND_SWORD
	];
	const BOW = ItemIds::BOW;

	const HELMET = [
        ItemIds::LEATHER_HELMET,
        ItemIds::CHAIN_HELMET,
        ItemIds::IRON_HELMET,
		ItemIds::GOLD_HELMET,
		ItemIds::DIAMOND_HELMET
	];
	const CHESTPLATE = [
		ItemIds::LEATHER_TUNIC,
		ItemIds::CHAINMAIL_CHESTPLATE,
		ItemIds::IRON_CHESTPLATE,
		ItemIds::GOLD_CHESTPLATE,
		ItemIds::DIAMOND_CHESTPLATE
	];
	const LEGGINGS = [
		ItemIds::LEATHER_PANTS,
		ItemIds::CHAIN_LEGGINGS,
		ItemIds::IRON_LEGGINGS,
		ItemIds::GOLD_LEGGINGS,
		ItemIds::DIAMOND_LEGGINGS
	];

	const BOOTS = [
		ItemIds::LEATHER_BOOTS,
		ItemIds::CHAIN_BOOTS,
		ItemIds::IRON_BOOTS,
		ItemIds::GOLD_BOOTS,
		ItemIds::DIAMOND_BOOTS
	];
}
