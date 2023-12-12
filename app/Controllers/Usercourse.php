<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserCourseModel;

class UserCourse extends ResourceController
{
    use ResponseTrait;
    // all UserCourse
    public function index()
    {
        $model = new UserCourseModel();
        $data['userCourse'] = $model->findAll();
        return $this->respond($data);
    }
    // create
    public function create()
    {
        $model = new UserCourseModel();
        $data = [
            'iduser' => $this->request->getVar('iduser'),
            'idcourse'  => $this->request->getVar('idcourse'),
        ];
        $model->insert($data);
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data UserCourse berhasil ditambahkan.'
            ]
        ];
        return $this->respondCreated($response);
    }
    // single user
    public function show($id = null, $idb = null)
    {
        $model = new UserCourseModel();

        $data = $model->where('id_user', $id)->where('id_course', $idb)->findAll();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Data tidak ditemukan.');
        }
    }
    // update
    public function update($id = null)
    {
        $model = new UserCourseModel();
        $id = $this->request->getVar('id');
        $data = [
            'iduser' => $this->request->getVar('iduser'),
            'idcourse'  => $this->request->getVar('idcourse'),
            'password'  => $this->request->getVar('password'),
        ];
        $model->update($id, $data);
        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data UserCourse berhasil diubah.'
            ]
        ];
        return $this->respond($response);
    }
    // delete
    public function delete($id = null)
    {
        $model = new UserCourseModel();
        $data = $model->where('id', $id)->delete($id);
        if ($data) {
            $model->delete($id);
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data produk berhasil dihapus.'
                ]
            ];
            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('UserCourse tidak ditemukan.');
        }
    }
}
