

## Install

Using Composer

```
composer require TagCategories
```

Add the service provider to `config/app.php`

```php
larvelcode\tagcategories\CattagServiceProvider::class,
```



## Usage

### Basic

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

