<?php

class PostController extends Controller
{
    public function view()
    {
        extract($this->data);
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
        $data['title'] = trim(htmlspecialchars($data['title'], ENT_COMPAT, 'UTF-8'));
        $data['description'] = trim(htmlspecialchars($data['description'], ENT_COMPAT, 'UTF-8'));
        $data['body'] = trim(htmlspecialchars($data['body'], ENT_COMPAT, 'UTF-8'));
        
        if (!$this->validateStore($data)) {
            exit();
        }
        
        $data["slug"] = trim(Str::toKebabCase($data['title']));
        $data['thumbnail'] = FileSystem::uploadImage($_FILES['thumbnail'], base64_encode($data['slug']));
        
        if (!$this->validateStore($data, true)) {
            exit();
        }

        $data["author_id"] = 1;
        $data["module_id"] = null;

        $db = new Database();
        PostsRepository::store($db, $data);

        echo ("Success\n");
    }
    private function validateStore($data, $checkFile = false): bool
    {
        if (!$checkFile) {

            if (!is_string($data['title'])) {
                echo ("Title must be string\n");
                return false;
            }
            if (strlen($data['title']) < 8) {
                echo ("Title must be have at least 8 characters\n");
                return false;
            }

            if (!is_string($data['description'])) {
                echo ("Description must be string\n");

                return false;
            }
            if (strlen($data['description']) < 8) {
                echo ("Description must be have at least 8 characters\n");

                return false;
            }

            if (!is_string($data['body'])) {
                echo ("Body must be string\n");

                return false;
            }
            if (strlen($data['body']) < 8) {
                echo ("Body must be have at least 8 characters\n");

                return false;
            }
        } else {
            if (!is_string($data['thumbnail'])) {
                echo ("Thumbnail must be string\n");

                return false;
            }
            if (!is_file($data['thumbnail'])) {
                echo ("Thumbnail must be a file\n");

                return false;
            }
        }


        return true;
    }
}
