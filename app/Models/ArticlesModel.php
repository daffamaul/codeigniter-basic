<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticlesModel extends Model
{
    protected $table = 'articles';
    protected $allowedFields = ['title', 'content', 'image', 'status', 'slug'];
}
