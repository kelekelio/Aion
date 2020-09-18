<?php
namespace PowerBook;

/**
 * @author Iltar van der Berg <kjarli@gmail.com>
 */
class Item
{
    /**
     * @var string
     */
    private $mesh;

    /**
     * @var string
     */
    private $type;

    /**
     * @param string $mesh
     * @param string $type
     */
    public function __construct($mesh, $type)
    {
        $this->mesh = $mesh;
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getMesh()
    {
        return $this->mesh;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
}
