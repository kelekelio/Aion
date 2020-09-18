<?php
namespace PowerBook;

/**
 * @author Iltar van der Berg <kjarli@gmail.com>
 */
class ItemModel
{
    /**
     * @var string
     */
    const FEMALE = 'female';

    /**
     * @var string
     */
    const MALE = 'male';

    /**
     * @var string
     */
    const ASMODIAN = 'asmodian';

    /**
     * @var string
     */
    const ELYOS = 'elyos';

    /**
     * @var string
     */
    private $scene_url;

    /**
     * @var bool
     */
    private $has_variants;
    /**
     * @param string $scene_url
     * @param bool   $has_variants
     */
    public function __construct($scene_url, $has_variants)
    {
        $this->scene_url    = $scene_url;
        $this->has_variants = $has_variants;
    }

    /**
     * @return bool
     */
    public function hasVariants()
    {
        return $this->has_variants;
    }


    /**
     * @param string $gender
     * @param string $faction
     * @return string
     */
    public function getSceneUrl($gender, $faction)
    {
        $prefix = '';

        if ($this->hasVariants()) {
            $prefix .= $faction === self::ASMODIAN ? 'd' : 'l';
            $prefix .= $gender  === self::FEMALE   ? 'f' : 'm';
        }

		global $itemId;
		if (($itemId >= 102200006) && ($itemId <= 102299999)) {
			$sufix = 'c_r.obj';
		}else {
			$sufix = '.obj';
		}
		
        return strtolower(isset($prefix[0])
            ? $prefix . '' . $this->scene_url
            : $this->scene_url) . $sufix;
    }
}
