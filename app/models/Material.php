<?php

class Material extends Eloquent {

	protected $fillable =['name','details','status','barcode','image'];

    public static $materialRules=[
        'image' => 'image|max:1000|mimes:jpg,jpeg,bmp,png,gif',
        'barcode' => 'unique:materials,barcode',
    ];

	public function messages()
    {
        return $this->hasMany('Message');
    }
    public function categories()
    {
        return $this->belongsToMany('Categorie','materialcategories','fk_materialsid','fk_categoriesid');
    }
    public function accessories()
    {
        return $this->belongsToMany('Material','accessories','fk_mastermaterial','fk_slavematerial');
    }

    public function getMaterialById($id)
    {
    	return Material::with('accessories')->where('id','=',$id)->first();
    }

    public function isValid()
    {
        $validation =Validator::make($this->attributes,static::$materialRules);
        
        if($validation->passes()) return true;
        
        $this->errors =$validation->messages();
        return false;
    }
}