<?php


namespace Vanguard\Repositories;


abstract class BaseRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = app()->make(
            $this->model()
        );
    }

    /**
     * get model
     * @return string
     */
    abstract public function model();


    public function all($relations = [], $columns = ["*"])
    {
        return $this->model->with($relations)->get($columns);
    }

    public function lists($columns = 'name', $key = 'id')
    {
        return $this->model->pluck($columns, $key);
    }

    /**
     * Paginate all
     * @param integer $perPage
     * @param array $columns
     * @return \Illuminate\Pagination\Paginator
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * Create new model
     * @param array $data
     * @return mixed
     */
    public function create($data = [])
    {
        return $this->model->create($data);
    }

    /**
     * Update model by the given ID
     * @param array $data
     * @param integer $id
     * @return mixed
     */
    public function update($id, $data = [])
    {
        return $this->model->find($id)->update($data);
    }

    /**
     * Delete model by the given ID
     * @param integer $id
     * @return boolean
     */
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Find model by the given ID
     * @param integer $id
     * @param array $columns
     * @return mixed
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * Find model by a specific column
     * @param string $field
     * @param mixed $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($field, $value, $columns = ['*'])
    {
        return $this->model->where($field, $value)->first($columns);
    }
}
