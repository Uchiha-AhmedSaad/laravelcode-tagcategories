<?php 
namespace larvelcode\tagcategories\Categoriestags;

use Illuminate\Support\Facades\DB;
use larvelcode\tagcategories\Categoriestags\otherhelperfunction;

class updatecategories
{
   public static function update_category_tag($data_array)
   {
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
		extract($data_array);
		foreach ($linked_list as $keydetach => $valuedetach) {

				$data_detach = array('linked_table' 				=> $linked_table,
									 'in_link_other_column_name' 	=> $in_link_other_column_name,
									 'classified_table_id'			=> $classified_table_id,
									 'in_linked_table_column_name' 	=> $in_linked_table_column_name,
									 'valuedetach_id' 				=> $valuedetach['id']);
				otherhelperfunction::detach($data_detach);
		}
		if (count($list) != 0) {
			foreach ($list as $key_list => $value_list) {
				$second_table = DB::table($classification_table_name)->where($column_name,'=',$value_list)->first();
				if ($second_table == true) {
					$data_array = array('linked_table'   				=> $linked_table,
										'in_linked_table_column_name'   => $in_linked_table_column_name,
										'second_table'   				=> $second_table->id,
										'in_link_other_column_name'    	=> $in_link_other_column_name,
										'classified_table_id'   		=> $classified_table_id);

					otherhelperfunction::linked_category_tag($data_array);
				}					
				else{
					$data_array = array('classification_table_name'   		=> $classification_table_name,
										'value_list'   						=> $value_list,
										'column_name'   					=> $column_name,
										'linked_table'  					=> $linked_table,
										'in_linked_table_column_name'   	=> $in_linked_table_column_name,
										'in_link_other_column_name'   		=> $in_link_other_column_name,
										'classified_table_id'   			=> $classified_table_id);
					otherhelperfunction::no_link_category_tag($data_array);
				}
			}
		}
   }
}