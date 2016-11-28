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

    /**
     * Returns a URL for the resource.
     *
     * @param string $email
     *
     * @return string
     */
    public function url($email)
    {
        $hash = $this->hash($email);

        $query = http_build_query([
            's' => $this->size->width(),
            'd' => $this->default,
        ]);

        return "{$this->base_url}{$hash}{$query}";
    }

    /**
     * Provides the hash used to identify the Gravatar request.
     *
     * @param string $email
     *
     * @return string
     */
    private function hash($email)
    {
        return md5(strtolower(trim($email)));
    }
}
