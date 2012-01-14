<?php
session_start();
require_once('../models/database/Database.php');
require_once('../models/database/MySqlDb.php');
require_once('../models/tables/TableGateway.php');
require_once('../models/tables/blogs.php');
require_once('../models/tables/users.php');
require_once('../models/tables/tags.php');
require_once('../models/tables/posts.php');
require_once('../models/tables/posts_tags.php');
require_once('../models/config/ConfigDb.php');

$db = new MySqlDb(array(DB_HOST, DB_USER, DB_PASS, DB_NAME));
$db->connectDb();
$blogs = new Blogs($db);
$users = new Users($db);
$posts = new Posts($db);
$tags = new Tags($db);
$posts_tags = new Posts_tags($db);
require_once('../views/View_blog.php');
?>