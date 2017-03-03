<?php
/**
 * File: Controller.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 03/03/17
 * Time: 13:36
 * Project: lacc_laravel_acl
 * Copyright: 2017
 */
namespace LaccUser\Annotations\Mapping;

/**
 * Class Controller
 * @package LaccUser\Annotations\Mapping
 * @Annotation
 * @Target("CLASS")
 */
class Controller
{
    public $name;
    public $description;
}