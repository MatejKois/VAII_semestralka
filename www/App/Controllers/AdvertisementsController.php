<?php

namespace App\Controllers;

use App\Core\AControllerBase;
use App\Core\Responses\Response;
use App\Models\Advertisement;

class AdvertisementsController extends AControllerBase
{
    public function authorize(string $action)
    {
        switch ($action) {
            case "create":
            case "store":
            case "edit":
            case "delete":
            return $this->app->getAuth()->isLogged();
        }
        return true;
    }

    public function index(): Response
    {
        $advertisements = Advertisement::getAll();
        return $this->html($advertisements);
    }

    public function delete()
    {
        $id = $this->request()->getValue('id');
        $adToDelete = Advertisement::getOne($id);

        if ($adToDelete) {
            if ($adToDelete->getImg()) {
                unlink($adToDelete->getImg());
            }
            $adToDelete->delete();
        }

        return $this->redirect("?c=advertisements");
    }

    public function store()
    {
        $id = $this->request()->getValue('id');
        $ad = ($id ? Advertisement::getOne($id) : new Advertisement());
        $ad->setTitle($this->request()->getValue('title') ? $this->request()->getValue('title') : "-");
        $ad->setPrice($this->request()->getValue('price') ? $this->request()->getValue('price') : 0);
        $ad->setText($this->request()->getValue('text') ? $this->request()->getValue('text') : "-");

        if ($this->request()->getFiles()['img'] && $this->request()->getFiles()['img']['error'] == UPLOAD_ERR_OK) {
            $filename = "public" . DIRECTORY_SEPARATOR
                . "images" . DIRECTORY_SEPARATOR
                . "advertisements" . DIRECTORY_SEPARATOR
                . time() . "_" . $this->request()->getFiles()['img']['name'];

            if (move_uploaded_file($this->request()->getFiles()['img']['tmp_name'], $filename)) {
                $ad->setImg($filename);
            }
        }

        $ad->save();
        return $this->redirect("?c=advertisements");
    }

    public function create()
    {
        return $this->html(viewName: 'create.form');
    }

    public function edit()
    {
        $id = $this->request()->getValue('id');
        $adToEdit = Advertisement::getOne($id);
        return $this->html($adToEdit,  viewName: 'create.form');
    }
}
