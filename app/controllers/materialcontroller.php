<?php
use Intervention\Image\ImageManager;
class materialcontroller extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function __construct(User $user, Material $material,Categorie $categorie,Accessorie $accessorie, Reservation $reservation)
	{
		$this->user = $user;
		$this->material = $material;
		$this->categorie = $categorie;
		$this->accessorie = $accessorie;
		$this->reservation = $reservation;

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
			return Redirect::to('/')->with('error','Je bent niet ingelogd');
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
			$accesoriesCategorie = $this->categorie->getCategoriesWhitMaterials(); // alle accessories an de hand van categorie
			return View::make('users.admin.addMaterial',['categories' => $categories,'accesoriesCategorie' => $accesoriesCategorie]);
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
				if(!empty(Input::get('accessories')))
				{
					$this->accessorie->saveAccessories(Input::get('accessories'),$this->material->id);
				}
				return Redirect::to('/beheer/materiaal')->with('message', 'U heeft succesvol '.Input::get('name').' toegevoegd aan de lijst van materiaal');
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
			/*return $this->reservation->getMaterialStatus($id);*/
			$material = $this->material->getMaterialById($id);
			$cal = $this->configCal(date("Y-m-d H:i:s"),$id);
			return View::make('materials.detail',['material' => $material,'cal' => $cal]);
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
			$accesoriesCategorie = $this->categorie->getCategoriesWhitMaterials();
			$material = Material::find($id);
			$accessoriesOfMaterial = $this->material->getMaterialAccessoriesArray($id);
			return View::make('users.admin.materialEdit',['material' => $material,'categories' => $categories,'accesoriesCategorie' => $accesoriesCategorie,'accessoriesOfMaterial' => $accessoriesOfMaterial]);
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
				if(!empty(Input::get('accessories')))
				{
					$this->accessorie->updateAccessories(Input::get('accessories'),$this->material->id);
				}
				return Redirect::to('/beheer/materiaal')->with('message', 'u hebt succesvol '.Input::get('name').' aangepast');
				
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
			return Redirect::to('/beheer/materiaal')->with('message', 'u hebt succesvol '.$name.' verwijderd');
		}
		else
		{
			return Redirect::to('/');
		}
	}

	public function calNext($id)
	{
		$material = $this->material->getMaterialById($id);
		$cal = $this->configCal($_GET["cdate"],$id);	
		return View::make('materials.detail',['material' => $material,'cal' => $cal]);
	}

	public function configCal($date,$id)
	{
		$events = $this->reservation->getMaterialStatus($id);
	    $cal = Calendar::make();
	    $cal->setDate($date); //Set starting date
	    $cal->setBasePath('/materials/'.$id.'/cal'); // Base path for navigation URLs
	    $cal->showNav(true); // Show or hide navigation
	    $cal->setView('week'); //'day' or 'week' or null
	    $cal->setStartEndHours(8,22); // Set the hour range for day and week view
	    $cal->setTimeClass('ctime'); //Class Name for times column on day and week views
	    $cal->setEventsWrap(array("<div class='reserved'><p>", '</p></div>')); // Set the event's content wrapper
	    $cal->setDayWrap(array('<div>','</div>')); //Set the day's number wrapper
	    $cal->setNextIcon('Volgende Week'); //Can also be html: <i class='fa fa-chevron-right'></i>
	    $cal->setPrevIcon('Vorige Week'); // Same as above
	    $cal->setDayLabels(array('Zon', 'Man', 'Din', 'Woe', 'Don', 'Vrij', 'Zat')); //Label names for week days
	    $cal->setMonthLabels(array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December')); //Month names
	    $cal->setDateWrap(array('<div data-id="' . $id . '">','</div>')); //Set cell inner content wrapper
	    $cal->setTableClass('table calendar ' . $id); //Set the table's class name
	    $cal->setHeadClass('table-header'); //Set top header's class name
	    $cal->setNextClass('btn'); // Set next btn class name
	    $cal->setPrevClass('btn'); // Set Prev btn class name
	    $cal->setEvents($events);

	    

	    return $cal;
	}

	public function getLogbook()
	{
		Session::forget('input');
		$categories['all'] ='alle';
		$categories['categorieën'] = Categorie::getAllCategories();
		$logbook = Material::paginate(8);	
		return View::make('materials.logbook',['logbook' =>$logbook,'paginate' => true,'categories' =>$categories]);
	}

	public function getReservations($id)
	{
		$reservations = $this->reservation->getLastReservations($id);
		return View::make('materials.lastReservation',['reservations' => $reservations]);
	}

	public function filterLogbook()
	{
		Session::forget('input');
		if((Input::get('search') == '') && (Input::get('status') == 'all') && (Input::get('availability') == 'all') && (Input::get('categorie') == 'all'))
		{
			return Redirect::to('/logbook');
		}
		else
		{
			$categories['all'] ='alle';
			$categories['categorieën'] = Categorie::getAllCategories();
			$result = $this->material->searchMaterial(Input::get('search'),Input::get('status'),Input::get('availability'),Input::get('categorie'));
			Session::put('input',Input::all());
			return View::make('materials.logbook',['logbook' => $result,'paginate' => false,'categories' =>$categories]);	
		}
		
	}

	public function checkIn()
	{
		if (Auth::check()) {
			return View::make("materials.checkin");
		}
		else {
			return Redirect::to("/");
		}
	}

	public function checkInMaterial()
	{
		if(Auth::check())
		{
			$errorMessagetype = "1";
			$barcodeExists = $this->material->where("barcode", "=", Input::get('barcode'))->first();
			if( $barcodeExists )
			{
				$errorMessagetype = "2";
				//Get all reservationsid's with that materialid(from barcode)
				$reservationids = $this->reservation->getReservationsids($barcodeExists->id);
				//If there is one reservation, it may continue
				if (!empty($reservationids)) {
					//Compare these reservationids with reservations and check if the dates are correct
					foreach ($reservationids as $key) {
						$checkedReservation = $this->reservation->find($key->fk_reservationsid);
						$currentDate = date("Y-m-d H:i:s");
						if($currentDate > $checkedReservation->begin && $currentDate < $checkedReservation->end) {

							//fill in date checkedout
							$resmat = Reservationmaterial::where("fk_reservationsid", "=", $checkedReservation->id)->where("fk_materialsid", "=", $barcodeExists->id)->first();
							$resmat->datecheckedin = $currentDate;
							$resmat->save();
							//fill in usercheckedout
							$resuse = Reservationuser::where("fk_reservationsid", "=", $checkedReservation->id)->get();
							foreach ($resuse as $keyresuse) {
								$keyresuse->usercheckedin = Auth::user()->id;
								$keyresuse->save();
							}							
							//return succes-page WITH date
							return View::make('materials.succes',['enddate' => '', 'matid' => $barcodeExists->id]);

							///////////////////////////////////////////////////////
							//////// FIX NEEDED FOR CHECKIN AFTER DEADLINE ////////
							///////////////////////////////////////////////////////
							
						}
					}
				}
			}
			//If something went wrong, give the right feedback to the error page.
			$errorMessage = "Er liep iets mis.";
			switch ($errorMessagetype) {
				case '1':
					$errorMessage = "U gaf een barcode op die niet bestaat in de database.";
					break;

				case '2':
					$errorMessage = "Er zijn geen lopende reservaties met die barcode.";
					break;

				default:
					$errorMessage = "Er liep iets mis tijdens het inchecken van uw materiaal.";
					break;
			
			}
			return View::make('errors.message',['message' => $errorMessage,'url' => '/inchecken']);
		}
		else{
			return Redirect::to('/');
		}
	}

	public function checkOut()
	{
		if (Auth::check()) {
			return View::make("materials.checkout");
		}
		else {
			return Redirect::to("/");
		}
	}

	public function checkOutMaterial()
	{
		if(Auth::check())
		{
			$errorMessagetype = "1";
			$barcodeExists = $this->material->where("barcode", "=", Input::get('barcode'))->first();
			if( $barcodeExists )
			{
				$errorMessagetype = "2";
				//Get all reservationsid's with that materialid(from barcode)
				$reservationids = $this->reservation->getReservationsids($barcodeExists->id);
				//If there is one reservation, it may continue
				if (!empty($reservationids)) {
					$errorMessagetype = "3";
					//Compare these reservationids with reservationsusers and check if this user is allowed to checkout
					$dateIsGood = false;
					$userHasPermission = false;
					foreach ($reservationids as $key) {
						//getallreservationusers
						$reservationusers = $this->reservation->getAllReservationUsers();
						
						foreach ($reservationusers as $key2) {
							if ($key->fk_reservationsid == $key2->fk_reservationsid) {
								if($key2->fk_usersid == Auth::user()->id) {

									//This user is one of the users who can check the item out
									$userHasPermission = true;
									//Remember this reservation id to use later for datechecking (the right one)
									$theReservationId = $key2->fk_reservationsid;

									//Immediatly get the reservation and check dates
									//get the current datetime
									$currentDate = date("Y-m-d H:i:s");
									//find the matching reservation
									$matchingReservation = $this->reservation->find($theReservationId);
									//Check if the current date, is between begin and end date of the reservation
									if ($currentDate >= $matchingReservation->begin && $currentDate <= $matchingReservation->end) {
										//Date is between values so it can be checkedout, this variable is used later, so the message on the error page can be correct
										$dateIsGood = true;
										//Variables used later for changing usercheckedout & datecheckedout
										$ultimateResMatId = $key->id;
										$ultimateResUseId = $key2->id;
										$enddate = $matchingReservation->end;
									}

								}
							}
						}						
					}
					if ($userHasPermission) {
						$errorMessagetype = "4";
						//Checked if date was good earlier
						if ($dateIsGood) {
							//fill in date checkedout
							$resmat = Reservationmaterial::find($ultimateResMatId);
							$resmat->datecheckedout = $currentDate;
							$resmat->save();
							//fill in usercheckedout
							$resuse = Reservationuser::find($ultimateResUseId);
							$resuse->usercheckedout = Auth::user()->id;
							$resuse->save();
							//return succes-page WITH date
							return View::make('materials.succes',['enddate' => $enddate, 'matid' => $barcodeExists->id]);
						}
					}
				}
			}
			//If something went wrong, give the right feedback to the error page.
			$errorMessage = "Er liep iets mis.";
			switch ($errorMessagetype) {
				case '1':
					$errorMessage = "U gaf een barcode op die niet bestaat in de database.";
					break;

				case '2':
					$errorMessage = "Er zijn geen reservaties met die barcode.";
					break;

				case '3':
					$errorMessage = "U heeft geen toegang om dit item uit te checken.";
					break;

				case '4':
					$errorMessage = "U probeert een item uit te checken buiten uw reservatietijd, gelieve uw item pas uit te checken na het begin tijdstip van de reservatie.";
					break;

				default:
					$errorMessage = "Er liep iets mis tijdens het uitchecken van uw materiaal.";
					break;
			
			}
			return View::make('errors.message',['message' => $errorMessage,'url' => '/uitchecken']);
		}
		else{
			return Redirect::to('/');
		}
	}

	public function storeMessage()
	{
		if (Auth::check()) {

			//Check if a message/title was typed
			if(Input::get('message') && Input::get('title')) {
				//Insert message into DB
				$newMessage = new Message;
				$newMessage->title = Input::get('title');
				$newMessage->message = Input::get('message');
				$newMessage->status = "unsolved";
				$newMessage->fk_usersid = Auth::user()->id;
				$newMessage->fk_materialsid = Input::get('materialid');
				$newMessage->save();
			}
			return Redirect::to("/materials");
		}
		else {
			return Redirect::to("/");
		}
	}

}
