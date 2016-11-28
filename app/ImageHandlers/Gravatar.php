<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 28-Nov-16
 * Time: 14:02
 */

namespace App\ImageHandlers;


use App\Contracts\ImageHandler;

/**
 * Controls Gravatar image manipulation.
 *
 * The property $email is not provided by the Trait itself. This is to allow for implementation via a
 * Model.
 * @property string $email
 */
class Gravatar
{
    use ImageHandler;

    const NOT_FOUND = '404';
    const MYSTERY = 'mm';
    const IDENTICON = 'identicon';
    const MONSTER = 'monsterid';
    const CARTOON = 'wavatar';
    const RETRO = 'retro';
    const BLANK = 'blank';

    /** @var string $base_url */
    private $base_url = 'https://www.gravatar.com/avatar/';
    /** @var string $default */
    private $default = self::MYSTERY;

    public function __construct($size, $default = self::MYSTERY)
    {
        $this->setSize($size);
        $this->default = $default;
    }

    /**
     * Returns a URL for the resource.
     *
     * @return string
     */
    function url()
    {
        $hash = $this->hash();

        $query = http_build_query([
            's' => $this->size->width(),
            'd' => $this->default,
        ]);

        return "{$this->base_url}{$hash}{$query}";
    }

    /**
     * Provides the hash used to identify the Gravatar request.
     *
     * @return string
     */
    private function hash()
    {
        return md5(strtolower(trim($this->email)));
    }
}
