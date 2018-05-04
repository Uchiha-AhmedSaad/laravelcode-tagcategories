<?php 
namespace TagCategories;

use Illuminate\Support\Facades\DB;
use TagCategories\Categoriestags\createcategories;
use TagCategories\Categoriestags\updatecategories;

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