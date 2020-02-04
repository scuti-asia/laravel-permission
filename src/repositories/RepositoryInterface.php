<?php

namespace Scuti\DeepPermission\Repositories;

interface RepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function show($id);

    public function paginate($perPage = 15, $columns = array('*'));
}