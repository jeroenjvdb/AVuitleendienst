<?php

class Categorie extends Eloquent {

	protected $fillable =['name'];

	public function materials()
    {
        return $this->belongsToMany('Material','materialcategories','fk_categoriesid','fk_materialsid');
    }

    public function getCategoriesWhitMaterials()
    {
    	return Categorie::has('materials')->get();
    }
}