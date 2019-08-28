<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Porfolio;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DB;
class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    
    public function index()
    {
        function addBasicAuth($header, $username, $password) {
            $header['Authorization'] = 'Basic '.base64_encode("$username:$password");
            return $header;
        }
        /*
        $test2 = new Porfolio;
        $test2 ->ticker  = "MSFT" ;
        $test2 ->value = 5;
        $test2 ->save();
        $test = Porfolio::all();

        
        $url = 'http://127.0.0.1:4555/price_high/MSFT';
        $params = array('skip' => 0, 'top' => 5000);
        $header = array('Content-Type' => 'application/json');
        $header = addBasicAuth($header, getenv('Michiel'), getenv('python'));
        $response = request("GET", $url, $header, $params);
        print($response);
        //$obj = json_decode($response);

        // SOURCE https://stackoverflow.com/questions/15617512/get-json-object-from-url
            */
        // HTTP authentication 
        /*
        $url = 'http://13.95.133.190:5000/price_high/MSFT';
        $ch = curl_init();     
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_USERPWD, "Michiel:Python");  
        $result = curl_exec($ch);  
        $test = json_decode($result, true);
        //print($test->access_token);
        print("hallo");
        curl_close($ch);  
        echo $result;
        echo 'hallo';
        //$obj = json_decode($result);
        //echo $obj->access_token;
        */
        /*
        $users = DB::select('select * from Porfolio');
        echo $users;
        */
        
        //$flight = Porfolio::firstOrNew(['ticker' => 'GOOG']);
        /*
        $flight1 = Porfolio::find(1);
        echo $flight1;
        */
        /*
        $flight = Porfolio::firstOrCreate(
            ['ticker' => 'GOOG'],
            ['user' => 'Michiel004'],
            ['value' => 'Michiel004'],
            ['quantity' => 'Michiel004']
            ['quantity' => 'Michiel004']
        );
        
        $flight ->save();
        */

        // source https://laravel.com/docs/5.8/eloquent
        /*
        $Waarde = Porfolio::where('ticker', 'MSFT')
               ->orderBy('updated_at','DESC')
               ->take(1)
               ->get();
        */
        
       
            
        
        /*
        Porfolio::where('ticker', 'GOOG')
          ->update(['value' => 1]);
        */
        
        $waarde = Porfolio::where('user', Auth::user()->username)
        ->orderBy('value','DESC')
        ->take(1)
        ->get();
        
        echo $waarde;
        
       // $waarde1 = 10;

        // python API in PHP.
        $url = 'http://pythonstock.westeurope.cloudapp.azure.com:5000/price_high/MSFT';
        $ch = curl_init();     
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_USERPWD, "Michiel:Python");  
        $result = curl_exec($ch);  
        $test = json_decode($result, true);
        //print($test->access_token);
        //print("hallo");
        curl_close($ch);  
        echo $result;
        //echo 'hallo';
        //$obj = json_decode($result);
        //echo $obj;
        
         // Erlang rest API in PHP.
        $url = 'http://pythonstock.westeurope.cloudapp.azure.com:8080/sun';
        $ch = curl_init();     
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($ch, CURLOPT_URL, $url);  
        curl_setopt($ch, CURLOPT_USERPWD, "Michiel:Erlang");  
        $result = curl_exec($ch);  
        $test = json_decode($result, true);
        //print($test->access_token);
        //print("hallo");
        curl_close($ch);  
        echo $result;

        /*
        $url = 'https://bitcionpricev220190827100215.azurewebsites.net/WebService1.asmx/BTCPrice';
        $ch = curl_init();     
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  
        curl_setopt($ch, CURLOPT_URL, $url);  
        $result = curl_exec($ch);  
        $test = json_decode($result, true);
        //print($test->access_token);
        //print("hallo");
        curl_close($ch);  
        echo $result;
        */
         
        // SOURCE https://stackoverflow.com/questions/18572550/php-xml-how-to-generate-a-soap-request-in-php-from-this-xml
        /*
        $soapUrl = "https://bitcionpricev220190827100215.azurewebsites.net/WebService1.asmx/BTCPrice";

        $xml_post_string = '<?xml version="1.0" encoding="utf-8"?><soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope"><soap12:Body><SearchCollectionPoint xmlns="http://privpakservices.schenker.nu/"><customerID>XXX</customerID><key>XXXXXX-XXXXXX</key><serviceID></serviceID><paramID>0</paramID><address>RiksvŠgen 5</address><postcode>59018</postcode><city>Mantorp</city><maxhits>10</maxhits></SearchCollectionPoint></soap12:Body></soap12:Envelope>';

        $headers = array(
        "POST /package/package_1.3/packageservices.asmx HTTP/1.1",
        "Host: privpakservices.schenker.nu",
        "Content-Type: application/soap+xml; charset=utf-8",
        "Content-Length: ".strlen($xml_post_string)
        ); 

        $url = $soapUrl;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_post_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $response = curl_exec($ch); 
        curl_close($ch);

        echo $response ;
        */

     
        // code from postman.
        // C# soup API in PHP.
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://bitcionpricev220190827100215.azurewebsites.net/WebService1.asmx?wsdl",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>"<soapenv:Envelope xmlns:soapenv=\"http://schemas.xmlsoap.org/soap/envelope/\" xmlns:tem=\"http://tempuri.org/\">\r\n   <soapenv:Header/>\r\n   <soapenv:Body>\r\n      <tem:BTCPrice/>\r\n   </soapenv:Body>\r\n</soapenv:Envelope>",
        CURLOPT_HTTPHEADER => array("Content-Type: text/xml"),));


        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
        echo "cURL Error #:" . $err;
        } else {
        echo $response;
        }
        

          return view('Portfolio.index',compact('waarde'));
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $test2 = new Porfolio;
        $test2 ->ticker  =  $request['share_name'];
        $test2 ->value =  $request['share_price'];
        $test2 ->quantity =  $request['share_qty'];
        $test2 ->user =  Auth::user()->username  ;
        // print(Auth::user() );
        $test2 ->save();


        $waarde = Porfolio::where('user', Auth::user()->username)
        ->orderBy('value','DESC')
        ->take(1)
        ->get();
     
        $waarde1 = 10;
         
        return view('Portfolio.index',compact('waarde'));
    }

    

     /**
     * Entryticker a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function entryticker(Request $request)
    {
        print("hallo");
        return view('Portfolio.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**PieChartController
     * Update the specified resourcePieChartController in storage.
     *PieChartController
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
