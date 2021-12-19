<?php 
namespace App\Repositories;
    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\AdAttributeInterface;
use App\Http\Requests\AdAttributeRequest;
use App\Models\AdAttribute;
use App\Models\Kind;
use App\Models\AdAttributeOption;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AdAttributeRepository implements AdAttributeInterface
{ 

    public function listAttributes(){
        // $data['result'] = Kind::where('status','=',1)
        //                             ->with('kindAdAttributes', function($query) {
        //                                 $query->where('status','=',1);
        //                             } )
        //                             ->with('kindAdAttributes.ad_attributeAdAttributeOptions', function($query) {
        //                                 $query->where('status','=',1);
        //                             } )
        //                             ->get();
        $data['result'] = Kind::where('status','=',1)
                            ->with(['kindAdAttributes' => function($q) {
                                $q->where('status','=',1);
                                //$q->where('ad_attributeAdAttributeOptions.status','=',1);
                            }, 'kindAdAttributes.ad_attributeAdAttributeOptions' => function($q) {
                                $q->where('status','=',1);
                             // $q->where('status','=',1);
                            }] )->paginate(REC_PER_PAGE);                               
        // $data['result'] = AdAttribute::where('status', '=', 1)
        //                 ->with('ad_attributeKind' , function($query) {
        //                     $query->where('status','=',1);
        //                 })
        //                 ->with('ad_attributeAdAttributeOptions' , function($query) {
        //                     $query->where('status','=',1);
        //                 })
        //                 ->get();
        $data['kinds'] = Kind::where('status', '=', 1)->orderBy('title', 'ASC')->get();
        $data['code'] = 200;  
        return $data;
    }

    public function searchAttributes(Request $request)
    {
        $query = $request->get('query');
        $sortBy = $request->get('sortby');
        $sortType = $request->get('sorttype');
        if($request->ajax())
        {
            $output = "";
            // $data['result'] = Kind::where('status','=',1)
            //                     ->with('kindAdAttributes' , function($q) {
            //                         $q->where('status','=',1);
            //                     } )
            //                     ->with('kindAdAttributes.ad_attributeAdAttributeOptions' , function($q) {
            //                         $q->where('status','=',1);
            //                     });

            $data['result'] = Kind::where('status','=',1)
                                ->with(['kindAdAttributes' => function($q) {
                                    $q->where('status','=',1);
                                    //$q->where('ad_attributeAdAttributeOptions.status','=',1);
                                }, 'kindAdAttributes.ad_attributeAdAttributeOptions' => function($q) {
                                    $q->where('status','=',1);
                                    //$q->where('ad_attributeAdAttributeOptions.status','=',1);
                                } ]);                    

            if( $query != '' ){
                $data['result'] = $data['result']->where('title','like', '%'.$query.'%' );
            }
            $data['sql'] = $data['result']->toSql();
            $data['result'] = $data['result']->paginate(REC_PER_PAGE); 
            // $data['result'] = AdAttribute::where('status', '=', 1)
            //                                 ->where('title', 'like', '%'.$query.'%')
            //                                 ->with(['ad_attributeKind' => function($query) {
            //                                     $query->where('status','=',1);
            //                                 } ,'ad_attributeAdAttributeOptions'  => function($query) {
            //                                     $query->where('status','=',1);
            //                                 } ])
            //                                 ->paginate(REC_PER_PAGE);
            
            $data['code'] = 200; 
            return $data;
        }
    }

    public function createAdAttribute( AdAttributeRequest $request ){
        
        DB::beginTransaction();   
        try {
                $titleSlug = Str::slug($request->title);
                $kindObj = AdAttribute::where( 'title_slug', '=', $titleSlug );
                if( $kindObj->count() > 0 ){
                    $counter = 1;
                    do {  
                        $testSlug = $titleSlug . '-'.$counter;
                        $kindObj = AdAttribute::where( 'title_slug', '=', $testSlug );
                    } while( $kindObj->count() > 0 );
                    $titleSlug = $testSlug;
                }

                $newAdAttribute = new AdAttribute;
                $newAdAttribute->title = trim( $request->title );
                $newAdAttribute->title_slug = $titleSlug;
                $newAdAttribute->status = 1;
                $newAdAttribute->kind_id = $request->kind_id;
                $newAdAttribute->save();

                $attributesArray = explode(",", trim($request->options)); 
                for( $cnt = 0 ; $cnt < count( $attributesArray ) ; $cnt++ ){
                    if( AdAttributeOption::where('ad_attribute_id', '=', $newAdAttribute->id)
                            ->where('title', '=', trim($attributesArray[ $cnt ]) )->exists() ) {
                        // don't insert just update the status if exists
                        AdAttributeOption::where('ad_attribute_id', '=', $newAdAttribute->id)
                            ->where('title', '=', trim($attributesArray[ $cnt ]) )->update([ 'status' => 1 ]);
                    } else {
                        $consignment_data[] = ['ad_attribute_id'=> $newAdAttribute->id,
                                                'title'=> trim($attributesArray[ $cnt ]),
                                                'title_slug' => Str::slug(trim($attributesArray[ $cnt ])),
                                                'status'=>1];
                    }
                }
                AdAttributeOption::insert( $consignment_data );

                DB::commit();

                $data['code'] = 201;
                $data['insertId'] = $newAdAttribute->id;
                $data['error'] = false;
                $data['msg'] = 'Ad attribute with options created Successfully';
                return $data;

        } catch(\Exception $e) {
            DB::rollBack();
            $this->error($e->getMessage(), $e->getCode());
        }
    } 

    public function add_options( Request $req ){
        $data = array();

        $validator = Validator::make($req->all(), 
                [ 
                    'optid' => 'required', 
                    'title' => 'required'
                ]); 
        if ($validator->fails()) { 
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $validator->errors();
            return $data;
        }

        $attributesArray = explode(",", trim($req->title)); 
        for( $cnt = 0 ; $cnt < count( $attributesArray ) ; $cnt++ ){

            if( AdAttributeOption::where('ad_attribute_id', '=', $req->optid)
                    ->where('title', '=', trim($attributesArray[ $cnt ]) )->exists() ) {
                // don't insert just update the status if exists
                AdAttributeOption::where('ad_attribute_id', '=', $req->optid)
                    ->where('title', '=', trim($attributesArray[ $cnt ]) )->update([ 'status' => 1 ]);
             } else {
                $consignment_data[] = ['ad_attribute_id'=> $req->optid,
                                        'title'=> trim($attributesArray[ $cnt ]),
                                        'title_slug' => Str::slug( trim($attributesArray[ $cnt ]) ),
                                        'status'=>1];
             }
        }
        AdAttributeOption::insert( $consignment_data );

        $data['code'] = 201;
        $data['error'] = false;
        $data['msg'] = 'Attribute option Saved Successfully';
        return $data;
    }   

    // delete options will simply disable the option from showing in the website 
    public function delete_options( Request $req ){
        $data = array();

        $validator = Validator::make($req->all(), 
                [ 
                    'optionid' => 'required:numeric', 
                    'attributeid' => 'required:numeric'
                ]); 
        if ($validator->fails()) { 
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $validator->errors();
            return $data;
        }

        
        if( AdAttributeOption::where('ad_attribute_id', '=', $req->attributeid)
                ->where('id', '=', $req->optionid )->exists() ) {
            // set the status to 0 if exists
            AdAttributeOption::where('ad_attribute_id', '=', $req->attributeid)
                            ->where('id', '=', $req->optionid )->update([ 'status' => 0 ]);
        } else {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = 'Record does not exists';
            return $data;
        }

        $data['code'] = 201;
        $data['error'] = false;
        $data['msg'] = 'Attribute option Saved Successfully';
        return $data;
    }  

    // delete options will simply disable the option from showing in the website 
    public function update_option( Request $req ){
        $data = array();

        $validator = Validator::make($req->all(), 
                [ 
                    'optionid' => 'required:numeric', 
                    'attributeid' => 'required:numeric',
                    'title' => 'required'
                ]); 
        if ($validator->fails()) {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $validator->errors();
            return $data;
        }

        
        if( AdAttributeOption::where('ad_attribute_id', '=', $req->attributeid)
                ->where('id', '=', $req->optionid )->exists() ) {
            // set the status to 0 if exists
            AdAttributeOption::where('ad_attribute_id', '=', $req->attributeid)
                            ->where('id', '=', $req->optionid )->update([ 
                                'title' => $req->title ,
                                'title_slug' => Str::slug( trim($req->title) )
                            ]);
        } else {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = 'Record does not exists';
            return $data;
        }

        $data['code'] = 201;
        $data['error'] = false;
        $data['msg'] = 'Option Saved Successfully';
        return $data;
    }  

    // delete options will simply disable the option from showing in the website 
    public function delete_attribute( Request $req ){
        $data = array();

        $validator = Validator::make($req->all(), 
                [ 
                    'attributeid' => 'required:numeric'
                ]); 
        if ($validator->fails()) { 
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $validator->errors();
            return $data;
        }

        
        if( AdAttribute::where('id', '=', $req->attributeid )->exists() ) {
            // set the status to 0 if exists
            AdAttribute::where('id', '=', $req->attributeid )->update([ 'status' => 0 ]);
        } else {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = 'Attribute does not exists';
            return $data;
        }

        $data['code'] = 201;
        $data['error'] = false;
        $data['msg'] = 'Attribute deleted Successfully';
        return $data;
    }  

    public function update_attribute( Request $req ){
        $data = array();

        $validator = Validator::make($req->all(), 
                [ 
                    'attributeid' => 'required:numeric',
                    'title' => 'required'
                ]); 
                
        if ($validator->fails()) { 
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = $validator->errors();
            return $data;
        }

        
        if( AdAttribute::where('id', '=', $req->attributeid )->exists() ) {
            // set the status to 0 if exists
            AdAttribute::where('id', '=', $req->attributeid )->update(
                    [ 
                        'title' => $req->title ,
                        'title_slug' => Str::slug( trim( $req->title) ) ,
                    ]
                );
        } else {
            $data['code'] = 422;
            $data['error'] = true;
            $data['msg'] = 'Attribute does not exists';
            return $data;
        }

        $data['code'] = 201;
        $data['error'] = false;
        $data['msg'] = 'Attribute updated Successfully';
        return $data;
    }  

}

