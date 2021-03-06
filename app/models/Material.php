<?php

class Material extends Eloquent {

	protected $fillable =['name','details','status','barcode','image'];

    public static $materialRules=[
        'image' => 'image|max:1000|mimes:jpg,jpeg,bmp,png,gif',
        'barcode' => 'unique:materials,barcode',
    ];
    public static $materialEditRules=[
        'image' => 'image|max:1000|mimes:jpg,jpeg,bmp,png,gif',
    ];
    protected $appends = ['title'];
     /**
     * The attributes that should be visible in json.
     *
     * @var array
     */
    protected $visible = ['id', 'title'];
    
    public function getTitleAttribute()
    {
        return $this->attributes['name'];
    }
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
    public function reservations()
    {
        return $this->belongsToMany('Reservation','reservationmaterials','fk_materialsid','fk_reservationsid');
    }

    public function getMaterialById($id)
    {
    	return Material::with('accessories')->where('id','=',$id)->first();
    }

    public function isValid($action)
    {
        if($action == 'edit')
        {
            $validation =Validator::make($this->attributes,static::$materialEditRules);
        }
        else if($action == 'add')
        {
         $validation =Validator::make($this->attributes,static::$materialRules);   
        }
        
        if($validation->passes()) return true;
        
        $this->errors =$validation->messages();
        return false;
    }
    //accesoires voor bepaal materiaal opvragen en in array terugeven 
    public function getMaterialAccessoriesArray($id)
    {
        $results = Material::find($id);
        $allAccessories = array();
        foreach($results->accessories as $result)
        {
            $allAccessories[] = $result->id;
        }
        return $allAccessories;
    }

    public function deleteMaterial($id)
    {
        DB::table('materialcategories')->where('fk_materialsid','=',$id)
                                        ->delete();
        Accessorie::where('fk_mastermaterial' , '=', $id)
                    ->orwhere('fk_slavematerial' , '=', $id) 
                    ->delete();
        Material::where('id','=',$id)->delete(); 
    }
    public function searchMaterial($name,$status,$availability,$categorie)
    {
        $qeury = Material::select('*');
        if($name != '')
        {
            $qeury = $qeury->where('name','LIKE','%'.$name.'%');
        }
        if($status != 'all')
        {
            $qeury = $qeury->where('status','=',$status);
        }
        if($availability != 'all')
        {
            $qeury = $qeury->where('availability','=',$availability);
        }
        if($categorie != 'all')
        {
            $qeury = $qeury->whereHas('categories', function($q) use($categorie)
        {
            $q->where('categories.id', '=', $categorie);

        });
        }
        $result = $qeury->get();
        return $result;
    }    
}