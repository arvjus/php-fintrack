<?php namespace Fintrack\Storage\Services;

use Category;

class CategoryService
{
    public function all() {
        return Category::all();
    }

    public function find($id) {
        return Category::find($id);
    }
}