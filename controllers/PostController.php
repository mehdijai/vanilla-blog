<?php

class PostController extends Controller
{
    public function index()
    {
        extract($this->data);
        $db = new Database();

        $posts = PostsRepository::all($db);

        require("views/posts.view.php");
    }
    public function view()
    {
        extract($this->data);
        $db = new Database();

        $post = PostsRepository::get($db, $params['slug']);
        require("views/post.view.php");

    }
    public function create()
    {
        extract($this->data);
        require("views/create-post.view.php");
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

        require("views/create-post.view.php");
    }
}
