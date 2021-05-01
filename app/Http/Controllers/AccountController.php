<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Animals;
use App\Models\images;
use App\Models\adoptionRequests;
use App\Models\User;
use Gate;

class AccountController extends Controller
{
    public function show($id)
    {
        $account = Account::find($id);
        return view('/show', array('account' => $account));
    }
    public function list()
    {
        return view('/list', array('accounts' => Account::all()));
    }

    public function display()
    {
        $accountsQuery = Account::all();
        if (Gate::denies('displayall')) {
            $accountsQuery = $accountsQuery->where('userid', auth()->user()->id);
        }
        return view('/display', array('accounts' => $accountsQuery));
    }


    public function uploadAnimalForm(){
        
        
        return view('/uploadAnimal');

    }

    public function uploadAnimalData(Request $request){

        


        /* Store animal into DATABASE */
        $animalModel = new Animals;

        $animalModel->userid = 1;   //set default user owner to the admin which is id 1.
        $animalModel->name = $request->name;
        $animalModel->DOB = $request->DOB;
        $animalModel->description = $request->animaldescription;
        $animalModel->pendingUsers = "";
        $animalModel->deniedUsers = "";
        $animalModel->save();


        return back()
            ->with('success', 'You have sucessfuly uploaded a new animal')
            ->with('animalid', $animalModel->id);
    }

    public function displayAnimal()
    {
        $animalsQuery = Animals::all();
        $adoptionQuery = adoptionRequests::all();
        $images = images::all();
        // if (Gate::denies('displayall')) {
        //     $animalsQuery = $animalsQuery->where('userid', auth()->user()->id);
        $adoptionQuery = $adoptionQuery->where('userid', auth()->user()->id);
       
        // }
        return view('/displayAnimal', array('animals' => $animalsQuery, 'images' => $images, 'user' => auth()->user()->id, 'adoptionData' => $adoptionQuery));
        
    }

    public function uploadImage(Request $request)
    {
        /* Store image name in DATABASE and store image file in SERVER */
        $fileModel = new images;
    
        $fileName = time() . '' . $request->file->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('images', $fileName, 'public');

        $fileModel->name = basename($filePath); // $fileName; //time() . '' . $request->file->getClientOriginalName()
        //$fileModel->file_path = '/storage/' . $filePath;
        $fileModel->animalid = $request->animalid;
        $fileModel->save();


        return back()
            ->with('success', 'You have successfully uploaded an image.')
            ->with('file', $fileName);

  
    }

    public function uploadImageForm()
    {
        $animalsQuery = Animals::all();
        // if (Gate::denies('displayall')) {
        //     $animalsQuery = $animalsQuery->where('userid', auth()->user()->id);
        // }
        return view('/uploadImage', array('animals' => $animalsQuery));
    }

    public function adoptionData(Request $request)
    {
        
     
       $adoptionRequest = new adoptionRequests;

       $adoptionRequest->userid = $request->userid;   //set default user owner to the admin which is id 1.
       $adoptionRequest->animalid = $request->animalid;
       $adoptionRequest->pendingUsers = "1";
       $adoptionRequest->deniedUsers = "0";
       $adoptionRequest->save();


       return back()
           ->with('success', 'You have sucessfuly made a request!');
           
    }

    public function managePendingRequestsform()
    {
        

        $requestsQuery  =  adoptionRequests::all();
        $animalQuery  =  Animals::all();
        $userQuery  =  User::all();

        $requestsQuery = $requestsQuery->where("pendingUsers","1");

        return view('/showPendingRequest', array(
            'animals'=>$animalQuery ,
            'pendingRequests'=>$requestsQuery,
            'users'=>$userQuery));



    }

    public function approveView()
    {
        

        $requestsQuery  =  adoptionRequests::all();
        $animalQuery  =  Animals::all();
        $userQuery  =  User::all();

        // $animalQuery = $animalQuery->whereNotIn("userid","1");

        $requestsQuery = $requestsQuery->where("pendingUsers","0");
        $requestsQuery = $requestsQuery->where("deniedUsers","0");

        return view('/approve', array(
            'animals'=>$animalQuery ,
            'pendingRequests'=>$requestsQuery,
            'users'=>$userQuery));



    }

    public function denyView()
    {
        

        $requestsQuery  =  adoptionRequests::all();
        $animalQuery  =  Animals::all();
        $userQuery  =  User::all();

        $requestsQuery = $requestsQuery->where("deniedUsers","1");

        return view('/deny', array(
            'animals'=>$animalQuery ,
            'pendingRequests'=>$requestsQuery,
            'users'=>$userQuery));



    }

    public function modifyRequest(Request $request)
    {
    
        $animalid=$request->animalid;
        $userid=$request->userid;

        $message = "";

        if($request->myRequest === "true")
        {
            
  
                adoptionRequests::where("userid",$userid)->where("animalid",$animalid)->update(array(
                    'pendingUsers'=> 0,
                ));

                Animals::where("id",$animalid)->update(array(
                    'userid'=>$userid,
                ));

                $message="Request Approved";

        }
        elseif ($request->myRequest === "false")
        {
            adoptionRequests::where("userid",$userid)->where("animalid",$animalid)->update(array(
                'pendingUsers'=> 0,'deniedUsers'=> 1,
            ));
            $message="Request Denied!";


        }

        return back()->with('message',$message);

    }

  
}
