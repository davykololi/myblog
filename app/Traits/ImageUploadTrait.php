<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

trait ImageUploadTrait{
    /**
    * @param Request $request
    * @return $this|false|string
    */
    public function verifyAndUpload(Request $request,$fieldname='image',$directory='/storage')
    {
                if($request->hasFile($fieldname)){
                        if(!$request->file($fieldname)->isValid()){
                   flash('Invalid Image')->error()->important();

            return redirect()->back()->withInput();
        }
            if($request->hasfile($fieldname)){
            //Get filename with extention
                $originalImage = $request->file($fieldname);
                $filenameWithExt = $originalImage->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $originalImage->getClientOriginalExtension();

                $manager = new ImageManager(new Driver());
                $featuredImage = $manager->read($originalImage->getRealPath());
                $featuredImage->scale(760, 421);

                $featuredImagePath = public_path().$directory;
                $featuredImage->save($featuredImagePath.$filename.'_'.time().'.'.$extension);
                $fileNameToStore = $filename.'_'.time().'.'.$extension;
            
                return $fileNameToStore;
               }
        }

                return null;
    }
}
