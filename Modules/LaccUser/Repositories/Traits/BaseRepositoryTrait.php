<?php
/**
 * File: BaseRepositoryTrait.php
 * Created by: Luis Alberto Concha Curay.
 * Email: luisconchacuray@gmail.com
 * Language: PHP
 * Date: 05/02/17
 * Time: 23:52
 * Project: lacc_editora
 * Copyright: 2017
 */
namespace LaccUser\Repositories\Traits;

trait BaseRepositoryTrait
{
    /**
     * @param      $column
     * @param null $key
     *
     * @return array
     */
    public function lists( $column, $key = null )
    {
        $this->applyCriteria();
        $result = [ '0' => '-- select --' ];
        $result += $this->model->pluck( $column, $key )->all();

        return $result;
    }
}