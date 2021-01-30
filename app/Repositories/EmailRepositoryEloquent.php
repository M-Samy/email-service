<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use App\Models\Email;

/**
 * Class EmailRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class EmailRepositoryEloquent extends BaseRepository implements EmailRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Email::class;
    }

    public function createEmail(array $emailData)
    {
        dd($emailData);
        $createdEmail = $this->create($emailData);
        return $createdEmail;
    }
}
