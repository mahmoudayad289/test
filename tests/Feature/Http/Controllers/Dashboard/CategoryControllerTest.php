<?php

namespace Tests\Feature\Http\Controllers\Dashboard;

use App\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\Dashboard\CategoryController
 */
class CategoryControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $categories = factory(Category::class, 3)->create();

        $response = $this->get(route('category.index'));

        $response->assertOk();
        $response->assertViewIs('categories.index');
        $response->assertViewHas('categories');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('category.create'));

        $response->assertOk();
        $response->assertViewIs('categories.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Dashboard\CategoryController::class,
            'store',
            \App\Http\Requests\Dashboard\CategoryStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $name = $this->faker->name;

        $response = $this->post(route('category.store'), [
            'name' => $name,
        ]);

        $categories = Category::query()
            ->where('name', $name)
            ->get();
        $this->assertCount(1, $categories);
        $category = $categories->first();

        $response->assertRedirect(route('categories.index'));
        $response->assertSessionHas('category.id', $category->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $category = factory(Category::class)->create();

        $response = $this->get(route('category.show', $category));

        $response->assertOk();
        $response->assertViewIs('categories.show');
        $response->assertViewHas('category');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $category = factory(Category::class)->create();

        $response = $this->get(route('category.edit', $category));

        $response->assertOk();
        $response->assertViewIs('category.edit');
        $response->assertViewHas('category');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\Dashboard\CategoryController::class,
            'update',
            \App\Http\Requests\Dashboard\CategoryUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $category = factory(Category::class)->create();
        $name = $this->faker->name;

        $response = $this->put(route('category.update', $category), [
            'name' => $name,
        ]);

        $response->assertRedirect(route('categories.index'));
        $response->assertSessionHas('category.id', $category->id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $category = factory(Category::class)->create();

        $response = $this->delete(route('category.destroy', $category));

        $response->assertRedirect(route('categories.index'));

        $this->assertDeleted($category);
    }
}
