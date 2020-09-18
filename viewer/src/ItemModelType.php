<?php
namespace PowerBook;

/**
 * @author Iltar van der Berg <kjarli@gmail.com>
 */
final class ItemModelType
{
    const WEAPON_MAIN_HAND = 'main_or_sub';
    const WEAPON_BOTH_HAND = 'main';
    const WEAPON_OFF_HAND  = 'sub';
    const ARMOR_TORSO      = 'torso';
    const ARMOR_GLOVE      = 'glove';
    const ARMOR_SHOULDER   = 'shoulder';
    const ARMOR_FOOT       = 'foot';
	const ARMOR_LEG	       = 'leg';
    const ARMOR_GENERIC    = 'torso glove foot shoulder leg';
    const ACCESSORY_HEAD   = 'head';
    const ACCESSORY_EARS   = 'right_or_left_ear';
    const ACCESSORY_WINGS  = 'wing';

    /**
     * Set of equipable items which have can have no Gender or Race variant.
     *
     * @return array
     */
    public static function getModelTypesWithoutSexOrRace()
    {
        return [
            self::WEAPON_1H,
            self::WEAPON_2H,
			self::WEAPON_OFF_HAND,
        ];
    }

    /**
     * Set of equipable items which have can have a Gender or Race variant.
     *
     * @return array
     */
    public static function getTypesWithSexOrRace()
    {
        return [
            
            self::ARMOR_TORSO,
            self::ARMOR_GLOVE,
            self::ARMOR_SHOULDER,
			self::ARMOR_LEG,
            self::ARMOR_FOOT,
            self::ARMOR_GENERIC,
            self::ACCESSORY_HEAD,
            self::ACCESSORY_EARS,
            self::ACCESSORY_WINGS,
        ];
    }

    private function __construct()
    {

    }
}
