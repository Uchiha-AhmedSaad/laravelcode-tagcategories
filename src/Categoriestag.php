<?php 
namespace larvelcode\tagcategories;

use Illuminate\Support\Facades\DB;
use larvelcode\tagcategories\Categoriestags\createcategories;
use larvelcode\tagcategories\Categoriestags\updatecategories;

class Categoriestag
{
	public static function creation($data_array)
	{
		createcategories::create_category_tag($data_array);
	}
	public static function update($data_array)
	{	
		updatecategories::update_category_tag($data_array);
	}
}