<?php

class Material extends Eloquent {

	protected $fillable =['title','message','status','fk_usersid','fk_materialsid'];

	public function messages()
    {
        return $this->hasMany('Message');
    }
    public function categories()
    {
        return $this->belongsToMany('Categorie','materialcategories','fk_materialsid','fk_categoriesid');
    }
}