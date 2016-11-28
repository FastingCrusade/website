<?php
/**
 * Created by PhpStorm.
 * User: ToothlessRebel
 * Date: 28-Nov-16
 * Time: 14:04
 */

namespace App\Contracts;


use App\Exceptions\MethodNotImplemented;
use App\Misc\Size;
use Illuminate\Support\Facades\App;

trait ImageHandler
{
    /** @var Size $size */
    protected $size;
    /** @var string $default */
    protected $default;

    /**
     * Returns a file handle for the resource.
     *
     * @return mixed
     */
    public function fetch()
    {
        $this->notImplemented(__METHOD__);

        return;
    }

    /**
     * Stores the resource at the given location.
     *
     * @param $location
     *
     * @return boolean
     */
    public function store($location)
    {
        $this->notImplemented(__METHOD__);

        return false;
    }

    /**
     * Returns a URL for the resource.
     *
     * @return string
     */
    public function url()
    {
        $this->notImplemented(__METHOD__);

        return null;
    }

    /**
     * Sets the default image to use.
     *
     * @param string $default
     *
     * @return $this
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Sets the Size for the image.
     *
     * @param      $size
     * @param null $height
     *
     * @return $this
     */
    public function setSize($size, $height = null)
    {
        if ($size instanceof Size) {
            $this->size = $size;
        } else {
            $this->size = App::make('App\Misc\Size', [$size, $height]);
        }

        return $this;
    }

    /**
     * @param $method
     *
     * @throws MethodNotImplemented
     */
    protected function notImplemented($method)
    {
        throw new MethodNotImplemented("Method {$method}() is not available for this resource.");
    }
}
