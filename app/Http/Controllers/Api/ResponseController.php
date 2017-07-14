<?php
namespace App\Http\Controllers\Api;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use Input;
use Image;


use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

use Maknz\Slack\Laravel\Facade as Slack;

class ResponseController extends Controller
{
    //
    public function __construct() {
        $this->curr_timestamp = date("Y-m-d H:i:s");
    }

    /**
     * Show the list of responses.
     *
     * @return \Illuminate\Http\Response
     */
    public function getResponseList($id) {
        if(!empty($id) && $id > 0) {
            $response = DB::table('response_codes')->where('id',$id)->get();
        }
        else {
            $response = DB::table('response_codes')->orderBy('id', 'desc')->get();
        }
        return $response;
    }

    /**
     * Delete a particular response.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleteResponse($id) {
        $response = DB::table('response_codes')->where('id', '=', $id)->delete();
        if($response)
            Slack::send('An existing response(API/Hook) has been removed. Know more on API Documentor!');
        return $response;
    }

    /**
     * Create a new response.
     *
     * @return \Illuminate\Http\Response
     */
    public function createResponse(Request $request) {
        // set form validation rules
        
        $this->validate($request, [
            'code' => 'required',
            'category'  => 'required'
        ]);
        $encoded_string = $request->get('image');
		foreach($encoded_string as $value) {
	        $extension = explode('/', explode(':', substr($value, 0, strpos($value, ';')))[1])[1];
	        $fileName = $this->curr_timestamp . '_' . uniqid() . '.' . $extension;
	        $destination_path = "uploads/";
	        $ifp = fopen( $destination_path.$fileName, 'wb'); 
	        $data = explode( ',', $value);
	        // we could add validation here with ensuring count( $data ) > 1
	        fwrite( $ifp, base64_decode( $data[ 1 ] ) );
	        fclose( $ifp );
        }
    }

    /**
     * Update specific response.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateResponse(Request $request,$id) {

        if(empty($request['is_active']))
            $request['is_active'] = false;
        $response = DB::table('response_codes') ->where('id', $id)->update(['category' => $request['category'], 'code' => $request['code'], 'response_message' => $request['response_message'], 'is_active' => $request['is_active'],'description' => $request['description'],'updated_at' => $this->curr_timestamp]);
        Slack::send('An existing response(API/Hook) has been updated. Review the changes on API Documentor!');
        return $response;
    }
}
