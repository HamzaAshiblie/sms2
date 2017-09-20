<?php
namespace App\Http\Controllers;

use App\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function getClient(Request $request)
    {
        $clients = Client::paginate();
        if($request['message']!=null){
            return view('client',['clients'=> $clients])->with('message');
        }else{
            return view('client',['clients'=>$clients]);
        }
    }

    public function getClientSingle(Request $request)
    {
        $clients = Client::find($request['client_id']);
        return response()->json($clients);
    }
    public function clientCreateClient(Request $request)
    {
        $this->validate($request, [
            'client_name'=> 'required:clients',
            'client_company'=>'required|max:120',
            'client_email'=>'required|unique:clients|email',
            'client_phone'=>'required|min:10'
        ]);
        $client = new Client();
        $client->client_name = $request['client_name'];
        $client->client_company = $request['client_company'];
        $client->client_email = $request['client_email'];
        $client->client_phone = $request['client_phone'];
        $message= 'حدث خطأ، لم يتم إضافة العميل';
        if ($client->save())
        {
            $message='تمت إضافة العميل بنجاح';
        }

        return redirect()->route('client')->with(['message'=>$message]);
    }
    public function editClientSingle( Request $request)
    {
        $this->validate($request, [
            'client_name'=> 'required:clients',
            'client_company'=>'required|max:120',
            'client_email'=>'required|email',
            'client_phone'=>'required|min:10'
        ]);
        $client = Client::where('id',$request['id'])->first();
        $client->client_name = $request['client_name'];
        $client->client_company = $request['client_company'];
        $client->client_email = $request['client_email'];
        $client->client_phone = $request['client_phone'];
        $message= 'حدث خطأ، لم يتم إضافة العميل';
        if ($client->update())
        {
            $message='تمت إضافة العميل بنجاح';
            return response()->json($client,200);
        }

        return redirect()->route('client')->with(['message'=>$message]);

    }
    public function deleteClientSingle( Request $request)
    {
        $client = Client::where('id',$request['id'])->first();
        $message= 'حدث خطأ، لم يتم حذف العميل';
        if ($client->delete())
        {
            $message='تمت حذف العميل بنجاح';
            return response()->json($client,200);
        }

        return redirect()->route('client')->with(['message'=>$message]);

    }
}