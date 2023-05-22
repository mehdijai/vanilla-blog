# MSBlog mini

Blog Made with vanilla PHP & TailwindCSS for styling.
This projet focuses heavily on the PHP and the Backend.

## How to use
- Prepare a LAMP environment (I use Laragon, you can use whatever you are comfortable with. `XAMPP`, `MAMP`, `WAMP`...),
- Clone the project to the route folder of your server,
- Create a MySQL database, named `msblog_mini`,
```sql
create database msblog_mini;
```
4- Create `posts` table,
```sql
CREATE TABLE `posts` (
  `id` int NOT NULL,
  `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `body` int NOT NULL DEFAULT '1',
  `author` int 
  `thumbnail` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
)
```