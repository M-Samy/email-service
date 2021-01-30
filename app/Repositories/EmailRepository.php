<?php

namespace App\Repositories;

use App\Models\Email;
use Prettus\Repository\Eloquent\BaseRepository;

class EmailRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return Email::class;
    }

    public function createEmail(array $fields)
    {
        return $this->create($fields);
    }
}
