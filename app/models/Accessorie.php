<?php

class Accessorie extends Eloquent {

	protected $fillable =['fk_mastermaterial','fk_slavematerial'];

	public static function getAllAccessories()
	{
		$results = Material::get();
		return $results;
	}

	public function saveAccessories($accessories,$materialId)
	{
		$insertValues = array();
		foreach($accessories as $accessorie)
		{
			$insertValues[] = array('fk_mastermaterial' => $materialId,
									'fk_slavematerial' => $accessorie);
			$insertValues[] = array('fk_mastermaterial' => $accessorie,
									'fk_slavematerial' => $materialId);
		}

		Accessorie::insert($insertValues);
	}
	public function updateAccessories($accessories,$materialId)
	{
		Accessorie::where('fk_mastermaterial' , '=', $materialId)
								->orwhere('fk_slavematerial' , '=', $materialId)
								->delete();
		$insertValues = array();
		foreach($accessories as $accessorie)
		{
			$insertValues[] = array('fk_mastermaterial' => $materialId,
									'fk_slavematerial' => $accessorie);
			$insertValues[] = array('fk_mastermaterial' => $accessorie,
									'fk_slavematerial' => $materialId);
		}

		Accessorie::insert($insertValues);
	}
}