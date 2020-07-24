<?php

namespace DuoIncure\ComplexUpgradeUI\utils;

use pocketmine\item\Item;

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
	//These 3 (looting, smite, bane of anthropods) don't need to be added yet as mobs do not exist.

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
		Item::WOODEN_PICKAXE,
		Item::STONE_PICKAXE,
		Item::IRON_PICKAXE,
		Item::GOLD_PICKAXE,
		Item::DIAMOND_PICKAXE
	];
	const AXE = [
		Item::WOODEN_AXE,
		Item::STONE_AXE,
		Item::IRON_AXE,
		Item::GOLD_AXE,
		Item::DIAMOND_AXE
	];
	const SHOVEL = [
		Item::WOODEN_SHOVEL,
		Item::STONE_SHOVEL,
		Item::IRON_SHOVEL,
		Item::GOLD_SHOVEL,
		Item::DIAMOND_SHOVEL
		];
	const SWORD = [
		Item::WOODEN_SWORD,
		Item::STONE_SWORD,
		Item::IRON_SWORD,
		Item::GOLD_SWORD,
		Item::DIAMOND_SWORD
	];
	const BOW = Item::BOW;

	const HELMET = [
		Item::LEATHER_HELMET,
		Item::CHAIN_HELMET,
		Item::IRON_HELMET,
		Item::GOLD_HELMET,
		Item::DIAMOND_HELMET
	];
	const CHESTPLATE = [
		Item::LEATHER_TUNIC,
		Item::CHAINMAIL_CHESTPLATE,
		Item::IRON_CHESTPLATE,
		Item::GOLD_CHESTPLATE,
		Item::DIAMOND_CHESTPLATE
	];
	const LEGGINGS = [
		Item::LEATHER_PANTS,
		Item::CHAIN_LEGGINGS,
		Item::IRON_LEGGINGS,
		Item::GOLD_LEGGINGS,
		Item::DIAMOND_LEGGINGS
	];

	const BOOTS = [
		Item::LEATHER_BOOTS,
		Item::CHAIN_BOOTS,
		Item::IRON_BOOTS,
		Item::GOLD_BOOTS,
		Item::DIAMOND_BOOTS
	];
}
