<?php

namespace Rastventure\Core\Repositories;

use Webkul\Core\Eloquent\Repository;
use Illuminate\Support\Arr;

class ThemeBannersRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'Rastventure\Core\Contracts\ThemeBanners';
    }

    public function saveBanners()
    {
        $this->processRecord('1');
        $this->processRecord('2');
        $this->processRecord('3');
        $this->processRecord('4');
    }

    public function processRecord($recordNumber)
    {
        $data = request()->all();
        $imageArrayIndex = array_keys($data['image' . $recordNumber]);
        $record = array();
        $record['content'] = $data['content' . $recordNumber];
        $record['link'] = $data['link' . $recordNumber];
        if (isset($data['image' . $recordNumber][$imageArrayIndex[0]]) && !empty($data['image' . $recordNumber][$imageArrayIndex[0]])) {
            $imageUrl =
                $this->processImage($data['image' . $recordNumber], $data, $recordNumber);
            if (isset($imageUrl) && !empty($imageUrl)) {
                $record['image_url'] = $imageUrl;
            }
        }
        $record['banner_number'] = $recordNumber;
        $recordExist = $this->model->where('banner_number', '=', $recordNumber)->count();
        if ($recordExist) {
            $row = $this->model->where('banner_number', '=', $recordNumber)->first();
            $themeBanner = $this->model->find($row->id);
            $themeBanner->update($record);
        } else {
            $this->model->create($record);
        }
    }

    public function processImage($imageToProcess, $data, $number)
    {
        $dir = 'theme_banners';

        $uploaded = $image = false;
        if (isset($imageToProcess)) {
            $image = $first = Arr::first($imageToProcess, function ($value, $key) {
                if ($value) {
                    return $value;
                } else {
                    return false;
                }
            });
        }

        if ($image != false) {
            $uploaded = $image->store($dir);

            unset($data['image'], $data['_token']);
        }

        if ($uploaded) {
            $data['image_url'] = $uploaded;
        } else {
            unset($data['image']);
        }

        return $data['image_url'];
    }
}
