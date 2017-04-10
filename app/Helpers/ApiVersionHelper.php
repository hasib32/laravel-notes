<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Request;

class ApiVersionHelper
{
    /**
     * Get default version
     *
     * @return string
     */
    public static function getDefault()
    {
        return 'v1';
    }

    /**
     * Get API version
     *
     * @return string
     */
    public static function getVersion()
    {
        $acceptHeader = Request::header('Accept');

        $pos = strpos($acceptHeader, "version=");
        if ($pos !== false) {
            $versionNumber = substr($acceptHeader, $pos + strlen('version='), strlen($acceptHeader));
            $version = $versionNumber !== false ? "v" . (int) $versionNumber : self::getDefault();

            return $version;
        } else {
            return self::getDefault();
        }
    }

    /**
     * Validate API version
     *
     * @param string $version
     * @return mixed
     */
    public static function validate($version)
    {
        //list of valid versions
        $validVersions = ['v1'];

        if (!in_array($version, $validVersions)) {
            abort(400, 'invalid version given');
        }
    }
}
