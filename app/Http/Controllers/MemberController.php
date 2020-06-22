<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Member;

use Validator;

class MemberController extends Controller
{
    public function index() {
        $users = Member::all();

        return response()->json([
            'data' => $users,
            'succes' => 'true',
           // 'total' => $users->nama
            
            ]);
    }

    public function index2() {
        //$users = Member::all();

       // return $users;


        $users = Member::with(['debt'])->get();
        //$total = 
        return response()->json([
            'data' => $users,
            'succes' => 'true',
           // 'total' => $users->nama
            
            ]);
    }



    public function DetailDebt($id) {
        $tes = Member::find($id);
        if (is_null($tes)) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'Member not found.'
            ];
            return response()->json($response, 404);
        }

        $users = Member::find($id)->debt()->paginate(10);
        $cektotal = Member::find($id)->debt;
        $debit = $cektotal->sum('debit');
        $credit = $cektotal->sum('credit');
        $total = $debit - $credit;


        $response = [
            'succes' => 'true',
            'total' => $total,
            'data' => $users,
            
        ];

        return response()->json($response, 200);
        
    }

    public function store(request $request) 
    {
        $validator = Validator::make($request->all(),[
            'nama' => 'required',
            'alamat' => 'required',
        ]);

        if($validator->fails()) 
        {
            $response = [
                        'success' => false,
                        'data' => 'Validator Error',
                        'message' => $validator->errors()
            ];
            return response()->json($response, 401);
        }


        $input = $request->all();
        $book = Member::create($input);
        $data = $book->toArray();

        $response = [
            'success' => true,
            'data' => $book,
            'message' => 'Member stored successfully.'
        ];

        return response()->json($response, 200);


    }
    
    public function update($id, request $request ) 
    {
        $input = $request->all();


        $validator = Validator::make($input,[
            'nama' => 'required',
            'alamat' => 'required',
        ]);

        if($validator->fails()) 
        {
            $response = [
                        'success' => false,
                        'data' => 'Validator Error',
                        'message' => $validator->errors()
            ];
            return response()->json($response, 401);
        }

        $member = Member::find($id);
        $member->nama = $input['nama'];
        $member->alamat = $input['alamat'];
        $member->telp = $input['alamat'];
        $member->save();

        $response = [
            'success' => true,
            'data' => $member,
            'message' => 'data updated'
        ];

        return response()->json($response, 200);
    }


    public function destroy($id)
    {
        $member = Member::find($id)->delete();
        $response = [
            'success' => true,
            'message' => 'Book deleted successfully.',
        ];
        return response()->json($response, 200);
    }

}
