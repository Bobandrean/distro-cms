<?php

namespace App\Traits;

use Obs\ObsClient;
use Obs\ObsException;

trait fileUploadTrait
{
    /**
     * Get number of records
     *
     * @return array
     */
    public function initializeObsClient() {
        $obsClient = new ObsClient([
            'key' => config('obs.key'),
            'secret' => config('obs.secret'),
            'endpoint' => config('obs.endpoint'),
            'ssl_verify' => config('obs.ssl_verify')
        ]);

        return $obsClient;
    }

    public function uploadFile($file, $folder, $key){
        $obsClient = $this->initializeObsClient();

        try {
            $resp = $obsClient->putObject([
                'Bucket' => config('obs.bucket'),
                'SourceFile' => $file,
                'Key' => config('obs.app').'/'.config('obs.staging').'/'.$folder.'/'.$key,
                'LocationConstraint' => config('obs.location_constraint')
            ]);
        } catch (ObsException $obsException) {
            throw $obsException;
        }

        return $resp;
    }

    public function deleteFile($folder, $key){
        $obsClient = $this->initializeObsClient();

        try {
            $resp = $obsClient->deleteObject([
                'Bucket' => config('obs.bucket'),
                'Key' => config('obs.app').'/'.config('obs.staging').'/'.$folder.'/'.$key,
                'LocationConstraint' => config('obs.location_constraint')
            ]);
        } catch (ObsException $obsException) {
            throw $obsException;
        }

        return $resp;
    }
}
