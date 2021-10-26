<?php

namespace App\Traits;

trait baseRepositoryTrait
{
    /**
     * Get number of records
     *
     * @return array
     */
    public function getNumber()
    {
        return $this->model->count();
    }

    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function updateColumn($id, $input)
    {
        $this->model = $this->getById($id);

        foreach ($input as $key => $value) {
            $this->model->{$key} = $value;
        }

        return $this->model->save();
    }

    /**
     * Destroy a model.
     *
     * @param $model
     * @return mixed
     * @internal param $id
     */
    public function destroy($id)
    {
        return $this->model->where('id', $id)->delete();
    }

    /**
     * Destroy a model.
     *
     * @param $model
     * @return mixed
     * @internal param $id
     */
    public function forceDestroy($id)
    {
        return $this->model->where('id', $id)->forceDelete();
    }

    /**
     * Get model by id.
     *
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->model->where('id', $id)->firstOrFail();
    }

    public function getByIdWith($id, array $relations)
    {
        return $this->model->where('id', $id)->with($relations)->first();
    }

    /**
     * Get all the records
     *
     * @return array User
     */
    public function all()
    {
        return $this->model->get();
    }

    public function allActiveOnly()
    {
        return $this->model->where('hapus', '0')->get();
    }

    /**
     * Store a new record.
     *
     * @param  $input
     * @return mixed
     */
    public function store($input)
    {
        return $this->model->create($input);
    }

    /**
     * Insert Multiple Data
     *
     * @param $data
     * @return mixed
     */
    public function insert($data)
    {
        return $this->model->insert($data);
    }

    /**
     * Update a record by id.
     *
     * @param  $id
     * @param  $input
     * @return mixed
     */
    public function update($id, $input)
    {
        $this->model = $this->getById($id);

        return $this->model->update($input);
    }
}
