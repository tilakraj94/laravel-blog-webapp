<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAViewForSearch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement(" 
        CREATE VIEW search_post
        AS
        select `posts`.*, `blog_users`.`name`, `blog_users`.`username`, `post_tag`.`tag_id`, `post_tag`.`post_id`, `tags`.`name` as `tag_name`, `categories`.`name` AS `category_name`  from `posts` inner join `categories` on `posts`.`category_id` = `categories`.`id` inner join `blog_users` on `blog_users`.`id` = `posts`.`author_id` inner join `post_tag` on `posts`.`id` = `post_tag`.`post_id` inner join `tags` on `tags`.`id` = `post_tag`.`tag_id`
         ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS search_post");
    }
}
