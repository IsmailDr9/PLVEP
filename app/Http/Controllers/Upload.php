<?php
namespace App\Http\Controllers;

use App\File;
use Illuminate\Support\Facades\Storage;

class Upload extends Controller {

    /*
    'name',
    'size',
    'file',
    'path',
    'full_file',
    'mime_type',
    'file_type',
    'relation_id',
     */

    public function upload($data = []) {

        if (in_array('new_name', $data)) {
            $new_name = $data['new_name'] === null?time():$data['new_name'];
        }

        if (request()->hasFile($data['file']) && $data['upload_type'] == 'single') {

            Storage::has($data['delete_file'])?Storage::delete($data['delete_file']):'';

            return request()->file($data['file'])->store($data['path']);

        }elseif (request()->hasFile($data['file']) && 'files' == $data['upload_type']){

            $file = request()->file($data['file']);

            $size = $file->getSize();
            $mimType = $file->getMimeType();
            $name = $file->getClientOriginalName();
            $hashName = $file->hashName();

            $file->store($data['path']);
            $add = File::create([
                'name' => $name,
                'size' => $size,
                'file' => $hashName,
                'path' => $data['path'],
                'full_file' => $data['path'] . '/' . $hashName,
                'mime_type' => $mimType,
                'file_type' => $data['file_type'],
                'relation_id' => $data['relation_id'],
            ]);
            return $add->id ;
        }
    }

    public function moveImage($data = []) {

        if (in_array('new_name', $data)) {
            $new_name = $data['new_name'] === null?time():$data['new_name'];
        }

        if (request()->hasFile($data['file']) && $data['upload_type'] == 'single') {

            Storage::has($data['delete_file'])?Storage::delete($data['delete_file']):'';

            return request()->file($data['file'])->store($data['path']);

        }
        $add = File::create([
            'name' => $data['name'],
            'size' => $data['size'],
            'file' => $data['file'],
            'path' => $data['path'],
            'full_file' => $data['full_file'],
            'mime_type' => $data['mineType'],
            'file_type' => $data['file_type'],
            'relation_id' => $data['relation_id'],
        ]);
        return $add->id ;
    }

    public function delete($id)
    {
        $file = File::findOrFail($id);
        if (!empty($file)){
            Storage::delete($file->full_file);
            $file->delete();
        }
    }

}