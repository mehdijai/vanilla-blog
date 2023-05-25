# Vanilla Blog

Blog Made with vanilla PHP & TailwindCSS for styling.
This projet focuses heavily on the PHP and the Backend.

## How to use
- Prepare a LAMP environment (I use Laragon, you can use whatever you are comfortable with. `XAMPP`, `MAMP`, `WAMP`...),
- Clone the project to the route folder of your server,
- Create a MySQL database, named `vanilla_blog`,
- Update your database environment from the config file,
```sql
create database vanilla_blog;
```
4- Execute the sql scripts in `create-db.sql`,

## Updates

- Autoload & Namespaces

- to isolate the logic code, we serve the project from `public` folder. With this structure, we can't access the other files with GET requests like [GET: /app/configs/database.php].

- This update will require a lot of changes in the code. So I created some helper functions:
    - `view()`: to load a view file with its name, and pass the required data,
    - `component()`: to load a component,
    - `config()`: to get a config file with its name,
    - `base_path()`: to get the base path of a path,

- I used the namespace with php autoload function to load the class files.