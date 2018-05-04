<?php 
namespace TagCategories\Categoriestags;

use Illuminate\Support\Facades\DB;
use larvelcode\tagcategories\Categoriestags\otherhelperfunction;


class otherhelperfunction
{

   public static function linked_category_tag($data_array)
   {
   		extract($data_array);

		$insert_data_list = DB::table($linked_table)
		->insert([$in_linked_table_column_name       	=> $second_table, 
				  $in_link_other_column_name   			=> $classified_table_id,
				  'created_at'  						=> date('Y-m-d h-i-s'),
				  'updated_at'              			=> date('Y-m-d h-i-s')]);
   }
   public static function no_link_category_tag($data_array)
   {
		extract($data_array);

		$create_category = DB::table($classification_table_name)
								->insert([
								'slug'          => otherhelperfunction::slug($classification_table_name,$value_list),
								$column_name    => $value_list,
								'created_at'    => date('Y-m-d h-i-s'),
								'updated_at'    => date('Y-m-d h-i-s')]);
		$linked_table_insert = DB::table($classification_table_name)->where($column_name,'=',$value_list)->first();
		$insert_data_list = DB::table($linked_table)
							  ->insert([$in_linked_table_column_name 	=> $linked_table_insert->id, 
										$in_link_other_column_name  	=> $classified_table_id,
										'created_at'  					=> date('Y-m-d h-i-s'),
										'updated_at'  					=> date('Y-m-d h-i-s')]);
   }
   public static function detach($data_detach)
   {
   		extract($data_detach);
		$detach = DB::table($linked_table)->where($in_link_other_column_name,$classified_table_id)
		->where($in_linked_table_column_name,$valuedetach_id)->delete();
   }
   public static function slug($table_name,$request_slug)
   {
		$search_slug = DB::table($table_name)->where('slug', str_slug($request_slug))->count();
		if ($search_slug == 0) {
			$new_product_slug = str_slug($request_slug);
		}
		elseif($search_slug > 0){
			$rand_slug = str_slug($request_slug).'-'.rand(1,10);
			$search_slug_again = DB::table($table_name)->where('slug', $rand_slug)->count();
			if ($search_slug_again == 0) {
				$new_product_slug = $rand_slug;
			}
			elseif ($search_slug_again > 0) {
				$new_product_slug = uniqid(str_slug($rand_slug), true);
			}
		}
	    return $new_product_slug;
   }
}