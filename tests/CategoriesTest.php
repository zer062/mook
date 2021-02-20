<?php

use \PHPUnit\Framework\TestCase;

class CategoriesTest extends TestCase
{
    private $faker;

    private $mook;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = \Faker\Factory::create();
        $this->mook = new Mook\Mook('http://moodle38.test', 'f19ec28d814e6f0296c453b818bd0952');
    }

    public function categoriesProvider()
    {
        yield[[
            new \Mook\Categories\Models\Category('Cat 01'),
            new \Mook\Categories\Models\Category('Cat 02'),
            new \Mook\Categories\Models\Category('Cat 03'),
            new \Mook\Categories\Models\Category('Cat 04'),
        ]];
    }

    /**
     * @dataProvider categoriesProvider
     */
    public function test_create_categories($categoriesList)
    {

        $categories = $this->mook->categories()->create($categoriesList);

        $this->assertIsArray($categories);
        $this->assertCount(count($categoriesList), $categories);
        $this->assertInstanceOf(\Mook\Categories\Models\Category::class, reset($categories));
        $this->assertEquals($categoriesList[0]->name(), $categories[0]->name());
    }

    public function test_get_categories()
    {
        $categories = $this->mook->categories()->findByName('Cat 01')->get();
        $this->assertIsArray($categories);
        $this->assertInstanceOf(\Mook\Categories\Models\Category::class, reset($categories));
    }
}