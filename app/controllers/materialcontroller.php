<?php
use Intervention\Image\ImageManager;
class materialcontroller extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct(User $user, Material $material,Categorie $categorie,Accessorie $accessorie)
	{
		$this->user = $user;
		$this->material = $material;
		$this->categorie = $categorie;
		$this->accessorie = $accessorie;

	}

	public function index()
	{
		if(Auth::check())
		{
			$categories = $this->categorie->getCategoriesWhitMaterials();
			return View::make('users.index',['categories' => $categories]);
		}
		else
		{
			return Redirect::to('/');
		}
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		if(Auth::check())
		{
			$categories = Categorie::getAllCategories();
			$accessories = Accessorie::getAllAccessories();
			return View::make('users.admin.addMaterial',['categories' => $categories,'accessories' => $accessories]);
		}
		else
		{
			return Redirect::to('/');
		}
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		if(Auth::check())
		{	
			if( $this->material->fill(Input::all())->isValid('add'))
			{
				$filename = 'nofile.png';
				if(Input::hasFile('image'))
				{
				
					$filename = substr_replace(Input::file('image')->getClientOriginalName() ,"",-4).Input::get('name').'.png';
					$image = Image::make(Input::file('image')->getRealPath())->heighten(500);
					$image->crop(500,500);
					$destenation = 'images/'.$filename;
					$image->save($destenation);		
				}
				$this->material->status = 'ok';
				$this->material->image = $filename;
				$this->material->save();
				$this->categorie->saveMaterialToCategorie(Input::get('categorie'),$this->material->id);
				$this->accessorie->saveAccessories(Input::get('accessories'),$this->material->id);
				return Redirect::to('/materials/create')->with('message', 'u hebt succesvol '.Input::get('name').' toegevoegd aan de lijst van materiaal');
			}
			else
			{
				return Redirect::back()->withInput()->withErrors($this->material->errors);
			}
		}
		else{
			return Redirect::to('/');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		if(Auth::check())
		{
			$material = $this->material->getMaterialById($id);
			return View::make('materials.detail',['material' => $material]);
		}
		else
		{
			return Redirect::to('/');
		}
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		if(Auth::check())
		{
			$categories = Categorie::getAllCategories();
			$accessories = Accessorie::getAllAccessories();
			$material = Material::find($id);
			$accessoriesOfMaterial = $this->material->getMaterialAccessoriesArray($id);
			return View::make('users.admin.materialEdit',['material' => $material,'categories' => $categories,'accessories' => $accessories,'accessoriesOfMaterial' => $accessoriesOfMaterial]);
		}
		else
		{
			return Redirect::to('/');
		}
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		if(Auth::check())
		{
			$this->material = Material::find($id);
			if( $this->material->fill(Input::all())->isValid('edit'))
			{
				if(Input::hasFile('image'))
				{
					$filename = substr_replace(Input::file('image')->getClientOriginalName() ,"",-4).Input::get('name').'.png';
					$image = Image::make(Input::file('image')->getRealPath())->heighten(500);
					$image->crop(500,500);
					$destenation = 'images/'.$filename;
					$image->save($destenation);		
				}
				else
				{
					$material = Material::select('image')->find($id);
					$filename = $material->image;
				}
				$this->material->image = $filename;
				$this->material->save();
				$this->categorie->updateMaterialCategorie(Input::get('categorie'),$id);
				$this->accessorie->updateAccessories(Input::get('accessories'),$this->material->id);
				return Redirect::to('/beheer/materiaal')->with('message', 'u hebt succesvol '.Input::get('name').' Aangepast');
				
			}
			else
			{
				return Redirect::back()->withInput()->withErrors($this->material->errors);
			}
		}
		else
		{
			return Redirect::to('/');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		if(Auth::check())
		{
			$name = Material::find($id)->name;
			$this->material->deleteMaterial($id);
			return Redirect::to('/beheer/materiaal')->with('message', 'u hebt succesvol '.$name.' Verwijderd');
		}
		else
		{
			return Redirect::to('/');
		}
	}


}
