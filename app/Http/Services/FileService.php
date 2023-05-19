<?php

namespace App\Http\Services;


class FileService {

    public static function getFile($page = 10) {

        try {
            $files = \App\Models\File::join('users', 'users.id', '=', 'files.user_id')
                            ->orderBy('files.created_at', 'desc')
                            ->select(
                                'users.name as user_name',
                                'files.*' 
                            )
                            ->paginate($page);
            return $files;     
        } catch (\Throwable $th) {
            return false;
        }

    }

}