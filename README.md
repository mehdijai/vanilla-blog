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
create table rss_provider (
    ID INT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug
    rss_url VARCHAR(255) NOT NULL,
    frequency INT NOT NULL DEFAULT(1),
);
```