<?php

namespace App\Controllers;

use App\Models\CoursesModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserCourseModel;
use App\Models\UsersModel;

class Sekolahku extends ResourceController
{
    use ResponseTrait;
    // all UserCourse
    public function index()
    {
        $ucmodel = new UserCourseModel();
        $umodel = new UsersModel();
        $cmodel = new CoursesModel();

        $datas = [
            'fungsi' => $this->request->getVar('fungsi'),
        ];
        // if($datas["fungsi"] == null){


        // }
        $querry = $umodel->select("users.id as id,users.username as username , course,mentor,title")->join("usercourse", "users.id = usercourse.id_user")->join("courses", "courses.id = usercourse.id_course")->findAll();

        if ($datas["fungsi"] == "sarjana") {
            $querry = $umodel->select("users.id as id,users.username as username , course,mentor,title")->join("usercourse", "users.id = usercourse.id_user")->join("courses", "courses.id = usercourse.id_course")->where("title LIKE 'S%'")->findAll();
        }
        if ($datas["fungsi"] == "notsarjana") {
            $querry = $umodel->select("users.id as id,users.username as username , course,mentor,title")->join("usercourse", "users.id = usercourse.id_user")->join("courses", "courses.id = usercourse.id_course")->where("title NOT LIKE 'S%'")->findAll();
        }
        // jumlah murid
        if ($datas["fungsi"] == "jumlahmurid") {
            $querry = $ucmodel->select("course,mentor,title,count(*) AS jumlah_peserta")->join("courses", "courses.id = usercourse.id_course")->where("usercourse.id_course = courses.id")->groupBy("courses.course")->findAll();
        }
        // jumlah fee
        if ($datas["fungsi"] == "fee") {
            $querry = $ucmodel->select("mentor,count(*) AS jumlah_peserta, sum(2000000) AS total_fee")->join("courses", "courses.id = usercourse.id_course")->where("usercourse.id_course = courses.id")->groupBy("courses.mentor")->findAll();
        }

        // dd($datas, $datas["fungsi"], $querry);
        // dd($querry);


        $data['data'] = $querry;
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
