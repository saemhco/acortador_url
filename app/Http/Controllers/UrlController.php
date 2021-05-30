<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Link;
use App\Estadistica;
class UrlController extends Controller
{
    static $HASH_LENGTH = 6;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $db = Link::where('url_real',$request->url)->first();
        if($db) return $db;
        
        $hash = $this->getUniqueHash();
        $db = new Link;
        $db->url_real = $request->url;
        $db->url_corto = $hash;
        $db->device = $this->getDevice();
        $db->save();
        // $statement = $db->prepare("INSERT INTO links(hash, title, real_link, instant_redirect) VALUES (?, ?, ?, ?)");
        // $statement->execute([$hash, $title, $realLink, $instantRedirect]);
        return $db;
    }

    
    private function getUniqueHash()
    {
        do {
            $hash = self::getRandomString(self::$HASH_LENGTH);
        } while (self::hashExists($hash));
        return $hash;
    }

    private function hashExists($hash)
    {
        $db = Link::find($hash);
        
        return $db != null;
    }

    private function getDevice(){
        $ip="{$_SERVER['REMOTE_ADDR']}";
        $pc1= gethostbyaddr($_SERVER['REMOTE_ADDR']);
        $pc2=php_uname();
        $date = date('Y-m-d h:i:s');
        $array = [$ip,$pc1,$pc2];
        return implode(";",$array);
        
    }

    private function getRandomString($length)
    {
        $source = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        return substr(str_shuffle($source), 0, $length);
    }

    
    public function show($url)
    {

        $link = Link::where('url_corto',$url)->first();
        if(!$link) return abort(404); 
        
        $estadistica = new Estadistica;
        $estadistica->link_id = $link->id;
        $estadistica->device = $this->getDevice();
        $estadistica->save();
        return view('redireccion.vista',compact('link'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
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
