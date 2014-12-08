<?php

class Categorie extends Eloquent {

	protected $fillable =['name'];

	public static $rules=[
        'name' => 'unique:categories,name'
    ];

	public function materials()
    {
        return $this->belongsToMany('Material','materialcategories','fk_categoriesid','fk_materialsid');
    }

	public function isValid()
    {
        $validation =Validator::make($this->attributes,static::$rules);
        
        if($validation->passes()) return true;
        
        $this->errors =$validation->messages();
        return false;
    }

    public function getCategoriesWhitMaterials()
    {
    	return Categorie::with('materials')->get();
    }
    public static function getAllCategories()
	{
		$results = Categorie::select('name','id')->orderBy('name','asc')->get();
		$allCategories = array();
		foreach($results as $result)
		{
			$allCategories = array_add($allCategories , $result->id , $result->name);
		}
		return $allCategories;
	}
	//nieuw materiaal toevoegen aan een bepaalde categorie
	public function saveMaterialToCategorie($categorieId,$materialId)
	{
		DB::table('materialcategories')->insert(array(
				'fk_materialsid' => $materialId,
				'fk_categoriesid' => $categorieId
			));
	}
}