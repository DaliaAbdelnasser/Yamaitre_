<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Model\Article;
use App\Model\ArticlesImage;
use Illuminate\Support\Facades\DB;
use Hash;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $articles = array(
            array('id' => '1', 'title' => 'المدونة الاولى', 'author_name' => 'Lawyer', 'image_feature' => '1664467110_article1.jpg', 'description' => 'المدونة الاولى', 'created_at' => '2022-11-08T16:59:19.000000Z', 'status' => '0'),
            array('id' => '2', 'title' => 'المدونة الثانية', 'author_name' => 'Lawyer', 'image_feature' => '1664706229_article2.jpg', 'description' => 'المدونة الثانية', 'created_at' => '2022-11-08T16:59:19.000000Z', 'status' => '0'),
            array('id' => '3', 'title' => 'المدونة الثالثة', 'author_name' => 'Lawyer2', 'image_feature' => '1664467110_article1.jpg', 'description' => 'المدونة الثالثة', 'created_at' => '2022-11-08T16:59:19.000000Z', 'status' => '0'),
            array('id' => '4', 'title' => 'المدونة الرابعة', 'author_name' => 'admin', 'image_feature' => '1664467110_article1.jpg', 'description' => 'المدونة الرابعة', 'created_at' => '2022-11-08T16:59:19.000000Z', 'status' => '1'),
            array('id' => '5', 'title' => 'المدونة الخامسة', 'author_name' => 'admin', 'image_feature' => '1664706229_article2.jpg', 'description' => 'المدونة الخامسة', 'created_at' => '2022-11-08T16:59:19.000000Z', 'status' => '1'),
            array('id' => '6', 'title' => 'المدونة السادسة', 'author_name' => 'admin', 'image_feature' => '1664467110_article1.jpg', 'description' => 'المدونة السادسة', 'created_at' => '2022-11-08T16:59:19.000000Z', 'status' => '1'),
            // array('id' => '7', 'title' => 'المدونة الاولى', 'author_name' => 'Lawyer', 'image_feature' => '1664467110_article1.jpg', 'description' => 'المدونة الاولى'),
            // array('id' => '8', 'title' => 'المدونة الثانية', 'author_name' => 'Lawyer', 'image_feature' => '1664706229_article2.jpg', 'description' => 'المدونة الثانية'),
            // array('id' => '9', 'title' => 'المدونة الثالثة', 'author_name' => 'Lawyer2', 'image_feature' => '1664467110_article1.jpg', 'description' => 'المدونة الثالثة'),
            // array('id' => '10', 'title' => 'المدونة الاولى', 'author_name' => 'Lawyer', 'image_feature' => '1664467110_article1.jpg', 'description' => 'المدونة الاولى'),
            // array('id' => '11', 'title' => 'المدونة الثانية', 'author_name' => 'Lawyer', 'image_feature' => '1664706229_article2.jpg', 'description' => 'المدونة الثانية'),
            // array('id' => '12', 'title' => 'المدونة الثالثة', 'author_name' => 'Lawyer2', 'image_feature' => '1664467110_article1.jpg', 'description' => 'المدونة الثالثة'),
            // array('id' => '13', 'title' => 'المدونة الثالثة', 'author_name' => 'Lawyer2', 'image_feature' => '1664467110_article1.jpg', 'description' => 'المدونة الثالثة'),
            // array('id' => '14', 'title' => 'المدونة الثالثة', 'author_name' => 'Lawyer2', 'image_feature' => '1664467110_article1.jpg', 'description' => 'المدونة الثالثة'),
            // array('id' => '15', 'title' => 'المدونة الثالثة', 'author_name' => 'Lawyer2', 'image_feature' => '1664467110_article1.jpg', 'description' => 'المدونة الثالثة'),
            // array('id' => '16', 'title' => 'المدونة الثالثة', 'author_name' => 'Lawyer2', 'image_feature' => '1664467110_article1.jpg', 'description' => 'المدونة الثالثة'),
            // array('id' => '17', 'title' => 'المدونة الثالثة', 'author_name' => 'Lawyer2', 'image_feature' => '1664467110_article1.jpg', 'description' => 'المدونة الثالثة'),
        );

        $images = array(
            array('article_id' => '1', 'image' => '1664467110_article1.jpg'),
            array('article_id' => '1', 'image' => '1664467110_article1.jpg'),
            array('article_id' => '2', 'image' => '1664706229_article2.jpg'),
            array('article_id' => '2', 'image' => '1664467110_article1.jpg'),
            array('article_id' => '2', 'image' => '1664467110_article1.jpg'),
            array('article_id' => '3', 'image' => '1664467110_article1.jpg'),
            array('article_id' => '4', 'image' => '1664467110_article1.jpg'),
            array('article_id' => '5', 'image' => '1664467110_article1.jpg'),
            array('article_id' => '6', 'image' => '1664706229_article2.jpg'),
            // array('article_id' => '7', 'image' => '1664467110_article1.jpg'),
            // array('article_id' => '8', 'image' => '1664467110_article1.jpg'),
            // array('article_id' => '9', 'image' => '1664467110_article1.jpg'),
            // array('article_id' => '10', 'image' => '1664467110_article1.jpg'),
            // array('article_id' => '11', 'image' => '1664467110_article1.jpg'),
            // array('article_id' => '12', 'image' => '1664706229_article2.jpg'),
            // array('article_id' => '13', 'image' => '1664467110_article1.jpg'),
            // array('article_id' => '14', 'image' => '1664467110_article1.jpg'),
            // array('article_id' => '15', 'image' => '1664467110_article1.jpg'),
            // array('article_id' => '16', 'image' => '1664467110_article1.jpg'),
            // array('article_id' => '17', 'image' => '1664467110_article1.jpg'),
        );

        $users = array(
            array('article_id' => '1', 'user_id' => '2'),
            array('article_id' => '2', 'user_id' => '3'),
            array('article_id' => '3', 'user_id' => '3'),
            // array('article_id' => '4', 'user_id' => '2'),
            // array('article_id' => '5', 'user_id' => '3'),
            // array('article_id' => '6', 'user_id' => '3'),
            // array('article_id' => '7', 'user_id' => '2'),
            // array('article_id' => '8', 'user_id' => '3'),
            // array('article_id' => '9', 'user_id' => '3'),
            // array('article_id' => '10', 'user_id' => '2'),
            // array('article_id' => '11', 'user_id' => '3'),
            // array('article_id' => '12', 'user_id' => '3'),
            // array('article_id' => '13', 'user_id' => '2'),
            // array('article_id' => '14', 'user_id' => '3'),
            // array('article_id' => '15', 'user_id' => '3'),
            // array('article_id' => '16', 'user_id' => '2'),
            // array('article_id' => '17', 'user_id' => '3'),
        );

        DB::table('articles')->insert($articles);
        DB::table('articles_images')->insert($images);
        DB::table('article_user')->insert($users);

    }
}
