<?php

use Fintrack\Storage\Services\CategoryService;

// category_id	name	name_short	order_pos	descr
// el	Electronics	Electr	3	TV, computers, cameras
// fd	Food	Food	1	It's about eating
// hh	Houshold	Houshold	2	Houshold related expenses

class CategoryServiceTest extends TestCase {
    public function setUp() {
        parent::setUp();

        $this->service = new CategoryService();
    }

    public function testGetAll() {
        $categories = $this->service->all();
        $this->assertNotNull($categories);
        $this->assertEquals(3, count($categories));
    }

    public function testFind() {
        $category = $this->service->find('fd');
        $this->assertNotNull($category);
        $this->assertEquals('Food', $category->name);
    }
}