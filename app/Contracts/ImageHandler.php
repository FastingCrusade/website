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
     * Sets the Size for the image.
     *
     * @param      $size
     * @param null $height
     *
     * @return $this
     */
    protected function setSize($size, $height = null)
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
