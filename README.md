# RSS Reader

Stylish RSS Reader Made with vanilla PHP & TailwindCSS for styling.
This projet focuses heavily on the PHP and the Backend.

## How to use
- Prepare a LAMP environment (I use Laragon, you can use whatever you are comfortable with. `XAMPP`, `MAMP`, `WAMP`...),
- Clone the project to the route folder of your server,
- Create a MySQL database, named `rss-reader`,
```sql
create database rss_reader;
```
4- Create `rss_provider` table,
```sql
CREATE TABLE `rss_providers` (
  `id` int NOT NULL,
  `title` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `frequency` int NOT NULL DEFAULT '1',
  `logo` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`)
)
```