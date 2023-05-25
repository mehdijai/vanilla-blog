<?php

namespace Controllers;

use App\Core\Str;
use App\Core\Database;
use App\Core\Validator;
use App\Core\FileSystem;
use Controllers\Controller;
use App\Repositories\PostsRepository;
use Exception;

class PostController extends Controller
{
    public function index()
    {
        $db = new Database();

        $posts = PostsRepository::all($db);

        view("posts", compact('posts'));
    }
    public function view()
    {
        extract($this->data);
        $db = new Database();

        $post = PostsRepository::get($db, $params['slug']);
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
            $data["author_id"] = 1;
            $data["module_id"] = null;

            $thumbnail_file = null;

            try {
                $thumbnail_file = FileSystem::uploadImage($_FILES['thumbnail'], base64_encode($data['slug']));
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
            $db = new Database();
            PostsRepository::store($db, $data);
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

    public function destroy()
    {
        try {
            $db = new Database();
            PostsRepository::delete($db, ['id' => $_POST['id']]);
            header("location: /posts");
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }

    public function updateDraftState()
    {
        try {
            $db = new Database();
            PostsRepository::updateDraftState($db, [
                'id' => $_POST['id'],
                'draft' => !$_POST['draft']
            ]);
            header("location: /posts");
        } catch (Exception $ex) {
            dd($ex->getMessage());
        }
    }
}
