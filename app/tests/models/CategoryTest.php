<?php

class CategoryTest extends TestCase {

    public function testCreateNoName() {
        $category = new Category();
        $this->assertFalse($category->save());
    }

    public function testCreateOk() {
        $category = new Category();
        $category->category_id = 'aa';
        $category->name = 'aaaaaaaa';
        $category->name_short = 'aaaaa';
        $category->descr = 'aaa blah blah blah';
        $this->assertTrue($category->save());
    }

    public function testGetCategory() {
        $category = Category::find('fd');
        $this->assertNotEmpty($category);
        $this->assertEquals('fd', $category->category_id);
    }

    public function testSearchCategory() {
        $category = Category::where('name', 'Food')->first();
        $this->assertNotEmpty($category);
        $this->assertEquals('fd', $category->category_id);
    }

    public function testRelations() {
        $category = Category::where('name', 'Food')->first();
        $this->assertNotEmpty($category);
        $this->assertNotEmpty($category->expenses);
        $this->assertEquals(2, count($category->expenses));
    }

    public function testFindAll() {
        $categories = Category::all();
        $this->assertNotEmpty($categories);
        $this->assertEquals(3, count($categories));
    }
}