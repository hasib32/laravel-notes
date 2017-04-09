<?php

namespace App\Http\Controllers\V1;

use App\Http\Requests\Note\StoreRequest;
use App\Http\Requests\Note\UpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\NoteRepository;
use App\Models\Note;

class NoteController extends Controller
{
    /**
     * Instance of NoteRepository
     *
     * @var NoteRepository
     */
    private $noteRepository;

    /**
     * @param NoteRepository $noteRepository
     */
    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $notes = $this->noteRepository->findBy($request->all());

        return $notes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $note = $this->noteRepository->save($request->all());

        if (!$note instanceof Note) {
            return $this->sendCustomResponse(404, 'Error occurred on creating Note');
        }

        return $note;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = $this->noteRepository->findOne($id);

        if (!$note instanceof Note) {
            return $this->sendNotFoundResponse("The note with id {$id} doesn't exist");
        }

        return $note;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $note = $this->noteRepository->findOne($id);

        if (!$note instanceof Note) {
            return $this->sendNotFoundResponse("The note with id {$id} doesn't exist");
        }

        $note = $this->noteRepository->update($note, $request->all());

        return $note;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = $this->noteRepository->findOne($id);

        if (!$note instanceof Note) {
            return $this->sendNotFoundResponse("The note with id {$id} doesn't exist");
        }

        $this->noteRepository->delete($note);

        return response()->json(null, 204);
    }
}
