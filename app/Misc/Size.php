<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 28-Nov-16
 * Time: 14:16
 */

namespace App\Misc;


use InvalidArgumentException;

class Size
{
    const SMALL = 20;

    const NAVIGATION = self::SMALL;

    /** @var int $height */
    private $height;
    /** @var int $width */
    private $width;

    public function __construct($size, $height = null)
    {
        $this->width($size);
        $this->height($height ?: $this->width);
    }

    /**
     * Gets or sets the width.
     *
     * @param int $pixels
     *
     * @return int
     */
    public function width($pixels = null)
    {
        if (!is_null($pixels) && is_numeric($pixels)) {
            $this->width = intval($pixels);
        } else {
            throw new InvalidArgumentException("The width must be numeric. {$pixels} was given.");
        }

        return $this->width;
    }

    /**
     * Gets or sets the height.
     *
     * @param int $pixels
     *
     * @return int
     */
    public function height($pixels = null)
    {
        if (!is_null($pixels) && is_numeric($pixels)) {
            $this->height = intval($pixels);
        } else {
            throw new InvalidArgumentException("The height must be numeric. {$pixels} was given.");
        }

        return $this->height;
    }
}
