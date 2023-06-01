<?php

namespace App\Controllers;

use App\Core\Str;
use App\Core\Validator;
use App\Core\FileSystem;
use App\Core\Session;
use App\Repositories\PostsRepository;
use Exception;

class PostController extends Controller
{
    public function index()
    {
        $posts = PostsRepository::all();

        view("posts", compact('posts'));
    }
    public function view()
    {
        extract($this->data);
        $post = PostsRepository::get($params['slug']);
        view("post", compact('post'));
    }

    public function create()
    {
        view("create-post", $this->data);
    }
    public function store()
    {
        extract($this->data);
        $data = $_POST;

        if (isset($data['draft'])) {
            $data['draft'] = true;
        } else {
            $data['draft'] = false;
        }

        $data['thumbnail'] = $_FILES['thumbnail'] ?? null;

        $errors = [];

        $requirements = [
            'title' => ['string', 'max:200', 'min:8'],
            'description' => ['string', 'max:200', 'min:8'],
            'body' => ['string', 'max:1000', 'min:8'],
            'draft' => ['bool'],
            'thumbnail' => ['file']
        ];

        $validator = new Validator($requirements);
        $validator->validate($data);
        if (!$validator->isValid()) {
            $errors = $validator->getMessages();
        } else {
            $data = $validator->validated();
            $data['title'] = trim(htmlspecialchars($data['title']));
            $data['description'] = trim(htmlspecialchars($data['description']));
            $data['body'] = trim(htmlspecialchars($data['body']));
            $data["slug"] = trim(Str::toKebabCase($data['title']));
            $data["author_id"] = Session::get("user_id");
            $data["module_id"] = null;

            $thumbnail_file = null;

            try {
                $thumbnail_file = FileSystem::uploadImage($_FILES['thumbnail'], Str::randomString($data['slug']));
                $data['thumbnail'] = $thumbnail_file;
                if (!$validator->file_path($thumbnail_file) || $thumbnail_file == null) {
                    $errors['thumbnail'] = "Thumbnail was not uploaded successfully!";
                }
            } catch (\Exception $ex) {
                $errors['thumbnail'] = $ex->getMessage();
                $thumbnail_file = null;
            }
        }

        if (empty($errors)) {

            PostsRepository::store($data);
            $data = [];
            $errors = [];
            unset($_POST);
            header("Location: /posts");
        }

        view("create-post", [
            'data' => $data,
            'errors' => $errors,
            ...$this->data,
        ]);
    }

    public function update()
    {
        extract($this->data);
        $post = PostsRepository::get($params['slug']);
        view("update-post", compact('post'));
    }

    public function edit()
    {
        extract($this->data);
        $data = $_POST;

        if (isset($data['draft'])) {
            $data['draft'] = true;
        } else {
            $data['draft'] = false;
        }

        $data['id'] = (int)$data['id'];
        $data['thumbnail'] = isset($_FILES['thumbnail']) && $_FILES['thumbnail']['tmp_name'] != null ? $_FILES['thumbnail'] : null;

        $errors = [];

        $requirements = [
            'title' => ['string', 'max:200', 'min:8'],
            'description' => ['string', 'max:200', 'min:8'],
            'body' => ['string', 'max:1000', 'min:8'],
            'draft' => ['bool'],
            'id' => ['int'],
            'thumbnail' => ['nullable', 'file']
        ];

        $validator = new Validator($requirements);
        $validator->validate($data);
        if (!$validator->isValid()) {
            $errors = $validator->getMessages();
        }

        if (empty($errors)) {
            $data = $validator->validated();
            $data['title'] = trim(htmlspecialchars($data['title']));
            $data['description'] = trim(htmlspecialchars($data['description']));
            $data['body'] = trim(htmlspecialchars($data['body']));
            $data["slug"] = trim(Str::toKebabCase($data['title']));
            $data["author_id"] = Session::get("user_id");
            $data["module_id"] = null;

            if ($data['thumbnail'] != null) {
                $thumbnail_file = null;

                try {
                    $thumbnail_file = FileSystem::uploadImage($_FILES['thumbnail'], Str::randomString($data['slug']));
                    $data['thumbnail'] = $thumbnail_file;
                    if (!$validator->file_path($thumbnail_file) || $thumbnail_file == null) {
                        $errors['thumbnail'] = "Thumbnail was not uploaded successfully!";
                    }
                } catch (\Exception $ex) {
                    $errors['thumbnail'] = $ex->getMessage();
                    $thumbnail_file = null;
                }
            }
        }

        if (empty($errors)) {
            PostsRepository::update($data);
            $data = [];
            $errors = [];
            unset($_POST);
            header("Location: /posts");
        }

        view("update-post", [
            'data' => $data,
            'errors' => $errors,
            ...$this->data,
        ]);
    }

    public function destroy()
    {
        try {
            PostsRepository::delete(['id' => $_POST['id']]);
            header("location: /posts");
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function updateDraftState()
    {
        try {
            PostsRepository::updateDraftState([
                'id' => $_POST['id'],
                'draft' => !$_POST['draft']
            ]);
            header("location: /posts");
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }
}
