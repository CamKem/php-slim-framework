<?php

namespace app\Controllers\Notes;

use app\Core\App;
use app\Core\Controller;
use app\Core\Database;
use app\Core\Validator;

class NotesController extends Controller
{

    protected Database $db;

    public function __construct()
    {
        parent::__construct();
        $this->db = App::resolve(Database::class);
    }

    public function index(): string
    {
        $notes = $this->db->query('select * from Notes where user_id = 1')->get();
        return view("notes.index", [
            'heading' => 'My Notes',
            'notes' => $notes
        ]);
    }

    public function create(): string
    {
        return view("notes.create", [
            'heading' => 'Create Note',
            'errors' => []
        ]);
    }

    public function store(): null
    {
        $errors = [];

        if (! Validator::string($_POST['body'], 1, 1000)) {
            $errors['body'] = 'A body of no more than 1,000 characters is required.';
        }

        if (! empty($errors)) {
            return view("notes.create", [
                'heading' => 'Create Note',
                'errors' => $errors
            ]);
        }

        $this->db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
            'body' => $_POST['body'],
            'user_id' => 1
        ]);

        return redirect('/notes');

    }

    public function show(): string
    {
        $currentUserId = 1;

        $note = $this->db->query('select * from notes where id = :id', [
            'id' => $_GET['id']
        ])->findOrFail();

        authorize($note['user_id'] === $currentUserId);

        return view("notes.show", [
            'heading' => 'Note',
            'note' => $note
        ]);

    }

    public function destroy(): null
    {
        $db = App::resolve(Database::class);

        $currentUserId = 1;

        $note = $db->query('select * from notes where id = :id', [
            'id' => $_POST['id']
        ])->findOrFail();

        authorize($note['user_id'] === $currentUserId);

        $db->query('delete from notes where id = :id', [
            'id' => $_POST['id']
        ]);

        return redirect('/notes');
    }

}

