<?php
namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Maknz\Slack\Laravel\Facade as Slack;

class ApiController extends Controller
{
    public function __construct() {
        $this->curr_timestamp = date("Y-m-d H:i:s");
    }

    /**
     * Get Api list.
     */
    public function getListDetails($type= "") {
        if($type == "recent")
            $response = DB::table('api_transactions')->orderBy('id', 'desc')->take(5)->get();
        else
            $response = DB::table('api_transactions')->where('api_zone',$type)->orderBy('id', 'desc')->get();
        return $response;
    }

    /**
     * Create an Api.
     *
     * @return \Illuminate\Http\Response
     */
    public function createApi(Request $request) {
        if(empty($request['is_active']))
        $request['is_active'] = false;
        $id = DB::table('api_transactions')->insertGetId(
          ['api_zone' => $request['api_zone'],'api_name' => $request['api_name'], 'is_active' => $request['is_active'], 'description' => $request['description'], 'api_uri' => $request['api_uri'],'method' => $request['method'], 'parameters' => $request['parameters'],'response_type' => $request['response_type'],'success_response' => $request['success_response'],'error_response' => $request['error_response'],'validations' => $request['validations'],'created_at' => $this->curr_timestamp,'updated_at' => $this->curr_timestamp,'created_by' => $request['created_by'],'updated_by' => $request['created_by']]);
        if(!empty($id))
        Slack::send('A new Response(API/Hook) has been posted. Check that out on API Documentor!');
        return $id;
    }

    /**
     * Delete an API.
     */
    public function deleteApi($id) {
        $response = DB::table('api_transactions')->where('id', '=', $id)->delete();
        if($response)
        Slack::send('An existing response(API/Hook) has been removed. Know more on API Documentor!');
        return $response;
    }

    /**
     * Update an API
     *
     * @return \Illuminate\Http\Response
    */
    public function updateApi(Request $request,$id) {
        if(empty($request['is_active']))
        $request['is_active'] = false;
        $response = DB::table('api_transactions') ->where('id', $id)->update(['api_zone' => $request['api_zone'],'api_name' => $request['api_name'], 'is_active' => $request['is_active'], 'description' => $request['description'], 'api_uri' => $request['api_uri'],'method' => $request['method'], 'parameters' => $request['parameters'],'response_type' => $request['response_type'],'success_response' => $request['success_response'],'error_response' => $request['error_response'],'validations' => $request['validations'],'created_at' => $this->curr_timestamp,'updated_at' => $this->curr_timestamp]);
        Slack::send('An existing response(API/Hook) has been updated. Review the changes on API Documentor!');
        return $response;
    }
}