<?php
namespace LaccUser\Repositories;

use LaccUser\Models\Role;
use LaccUser\Repositories\Traits\BaseRepositoryTrait;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class RoleRepositoryEloquent
 * @package namespace LACC\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    use BaseRepositoryTrait;

    protected $fieldSearchable = [];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    /**
     * @param      $column
     * @param null $key
     *
     * @return \Illuminate\Support\Collection
     */
    public function listsWithMutators($column, $key = null)
    {
        /** @var  Collection $collection */
        $collection = $this->all();
        return $collection->pluck( $column, $key );
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria( app( RequestCriteria::class ) );
    }
}
