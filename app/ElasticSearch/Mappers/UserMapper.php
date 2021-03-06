<?php

namespace Hedonist\ElasticSearch\Mappers;

use Hedonist\Entities\User\User;
use Illuminate\Database\Eloquent\Model;

class UserMapper implements MapperInterface
{
    private function assertCanMap(Model $model): void
    {
        if (!$model instanceof User) {
            throw new \RuntimeException('Incorrect type for mapping');
        }
    }

    public function map(Model $model): array
    {
        $this->assertCanMap($model);
        $result = [
            'id' => $model->id,
            'email' => $model->email
        ];
        return array_merge($result, $model->info->toArray());
    }
}