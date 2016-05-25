<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Complain;

use Illuminate\Support\Facades\Auth;

use Validator;

use App\Http\Requests\ComplainRequest;

use App\User;


class ComplainController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $complains= Complain::orderBy('TKH_ADUAN','desc')->paginate(15);


        return view('complains/index', compact('complains'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $users = User::where('id', '!=',Auth::user()->id)->lists('name','id');
        $users = array(''=>'Pilih Pengguna') + $users->all();

        return view('complains/create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplainRequest $request)
    {
//        dd($request->all());

            $EMP_ID_ADUAN = Auth::user()->id;
            $ADUAN = $request->ADUAN;
        
            $LOGIN_DAFTAR = $request->LOGIN_DAFTAR;

            if (empty($LOGIN_DAFTAR)){
                $LOGIN_DAFTAR = Auth::user()->id;
            }

            $complain = new Complain;
            $complain->EMP_ID_ADUAN = $EMP_ID_ADUAN;
            $complain->ADUAN = $ADUAN;
            $complain->LOGIN_DAFTAR =$LOGIN_DAFTAR;

            $complain->save();

            return redirect(route('complain.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('complains/show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $complain = Complain::find($id);


        return view('complains/edit', compact('complain'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ComplainRequest $request, $id)
    {
        $ADUAN = $request->ADUAN;
        $complain = Complain::find($id);
        $complain->ADUAN = $ADUAN;

        $complain->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $complain = Complain::find($id);
        $complain->delete();

        return back();
    }
}
