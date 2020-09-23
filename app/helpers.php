<?php

if (! function_exists('getBreadcrumb'))
{
    function getBreadcrumb($key)
    {
        if(is_numeric($key))
        {
            return $key;

        }else
        {
            $breadcrumbs = config('app.breadcrumbs');

            if (array_key_exists($key, $breadcrumbs))
                
                return $breadcrumbs[$key];

            else return null;
        }

    }
}
