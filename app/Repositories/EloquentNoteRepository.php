<?php

namespace App\Repositories;

use App\Models\Note;
use App\Repositories\Contracts\NoteRepository;
use App\Repositories\Contracts\UserRepository;
use App\Models\User;

class EloquentNoteRepository extends AbstractEloquentRepository implements NoteRepository
{
    /**
     * Model Name
     *
     * @var string
     */
    protected $modelName = Note::class;

    /**
     * Instance of UserRepository
     *
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        parent::__construct();
    }

    /**
     * @inheritdoc
     */
    public function save(array $data)
    {
        if (!isset($data['userId'])) {
            $data['userId'] = $this->loggedInUser->id;
        }

        $note = parent::save($data);

        return $this->model->find($note->id);
    }

    /**
     * @inheritdoc
     */
    public function findBy(array $searchCriteria = [])
    {
        // Only admin user can see all users
        if ($this->loggedInUser->role !== User::ADMIN_ROLE) {
            $searchCriteria['userId'] = $this->loggedInUser->id;
        }

        return parent::findBy($searchCriteria);
    }
}