<?php

/**
  * @Author: sdc-studio
  * @Date: 2020-02-22 20:56:37
  * @Desc: The return config admin's route prefix
  * @Return: string 
*/
function admin_route_prefix($path = '') : string{
  $prefix = '/'.trim(config('admin.route.prefix'), '/');

  $prefix = ($prefix == '/') ? '' : $prefix;

  $path = trim($path, '/');

  if (is_null($path) || strlen($path) == 0) {
      return $prefix ?: '/';
  }

  return $prefix.'/'.$path;
}

