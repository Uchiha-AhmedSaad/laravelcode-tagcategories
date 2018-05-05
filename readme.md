

## Install

Using Composer

```
composer require larvelcode/cagcategories:dev-master
```

Add the service provider to `config/app.php`

```php
larvelcode\tagcategories\CattagServiceProvider::class,
```



## Usage


### Basic

i'll give you example to make our categories in My real project.

you need to be understand the relationship manytomany

1-first you neet to make 3 tables to use category

the first table is products.
the second one is categories.
the thried is the intermdite between them category_product.

```php
php artisan make:migration create_products_table --create=products
php artisan make:migration create_categories_table --create=categories
php artisan make:migration create_category_product_table --create=category_product
```
in the table of products

```php
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('product_name');
        });
    }
```

in the table of categories

```php
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('category_name');
            $table->timestamps();
        });
    }
```
in the table of category_product
```php
    public function up()
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->integer('category_id')->unsigned()->index();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }
```
Now you need to make 2 model:-
1-for categories and you will name it category.
2-for products and you will name it product.

and you will use php artisan command:-

```php
php artisan make:model category
php artisan make:model product
```
-After that open category model in app/category.php

and edit it like this:-
```php

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable = ['category_name','slug'];
	public function products()
	{
	 return $this->belongsToMany('App\product')->withTimestamps();
	}
}
```
-Open product model in app/product.php
and edit it like this:-
```php
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable = ['slug','product_name'];

        public function categories()
        {
            return $this->belongsToMany('App\category')->withTimestamps();
        }
        // uses to get the categories list that associated with the product
        
        public function getCategoryListAttribute()
        {
            return $this->categories->pluck('category_name')->toArray();
        }
}

```

From your application,  in your controller.

```php
use larvelcode\tagcategories\Categoriestag;

```

To Create categories or tags

```php
        /*
            *list :- this is the list of category or Tag.
            *Classified_table:- the table that category make to splite it in this situation product table id.
            *classification_table_name:- the table of category or tag.
            *column_name:-the column that contain category or tag name.
            *linked_table:- the Intermediate table category_product or product_tag.
            *in_linked_table_column_name:- column in Intermediate table (category_product or product_tag) category_id or tag_id.
            *in_link_other_column_name:- column in the Intermediate table (product_id).
        */
        $data_array_categories = array( 
            'list'                          => $request->categories,
            'classified_table_id'           => $product->id,
            'classification_table_name'     => 'categories',
            'column_name'                   => 'category_name',
            'linked_table'                  => 'category_product', 
            'in_linked_table_column_name'   => 'category_id',
            'in_link_other_column_name'     => 'product_id'
        );
        $categories = Categoriestag::creation($data_array_categories);
```
To update categories or tag


```php
            /*
                *list :- this is the list of category or Tag.
                *linked_list :- the list of categories or tags that associated with classified_table (product).
                *classified_table_id:- the table that category make to splite it in this situation product table id.
                *classification_table_name:- the table of category or tag.
                *column_name:-the column that contain category or tag name.
                *linked_table:- the Intermediate table category_product or product_tag.
                *in_linked_table_column_name:- column in Intermediate table (category_product or product_tag) category_id or tag_id.
                *in_link_other_column_name:- column in the Intermediate table (product_id).
            */

            $data_array_categories = array( 
                'list'                              => $request->category_list,
                'linked_list'                       => $product->categories,
                'classified_table_id'               => $product->id,
                'classification_table_name'         => 'categories',
                'column_name'                       => 'category_name',
                'linked_table'                      => 'category_product', 
                'in_linked_table_column_name'       => 'category_id',
                'in_link_other_column_name'         => 'product_id'
            );
            $categories = Categoriestag::update($data_array_categories);
```
end
