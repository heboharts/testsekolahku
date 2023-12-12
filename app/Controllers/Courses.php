<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\CoursesModel;

class Courses extends ResourceController
{
    use ResponseTrait;
    // all Courses
    public function index()
    {
        $model = new CoursesModel();
        $data['courses'] = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }
    // create
    public function create()
    {
        $model = new CoursesModel();
        $data = [
            'course' => $this->request->getVar('course'),
            'mentor'  => $this->request->getVar('mentor'),
            'title'  => $this->request->getVar('title'),
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Courses berhasil ditambahkan.'
            ]
        ];
        return $this->respondCreated($response);
    }
    // single user
    public function show($id = null)
    {
        $model = new CoursesModel();
        $data = $model->where('id', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
    // update
    public function update($id = null)
    {
        $model = new CoursesModel();
        $id = $this->request->getVar('id');
        $data = [
            'course' => $this->request->getVar('course'),
            'mentor'  => $this->request->getVar('mentor'),
            'title'  => $this->request->getVar('title'),
        ];
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Courses berhasil diubah.'
            ]
        ];
        return $this->respond($response);
    }
    // delete
    public function delete($id = null)
    {
        $model = new CoursesModel();
        $data = $model->where('id', $id)->delete($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data courses berhasil dihapus.'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('Courses tidak ditemukan.');
        }
    }
}
